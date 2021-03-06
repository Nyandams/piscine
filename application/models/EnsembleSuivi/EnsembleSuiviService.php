<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EnsembleSuiviService extends CI_Model
{
    private $suiviDAO = null;
    private $editeurContactDAO = null;
    private $editeurDAO = null;
    private $jeuDAO = null;
    private $reservationDAO = null;
    private $reserverDAO = null;
    private $festivalDAO = null;
    
    
    public function __construct() {
        parent::__construct();
        $this->load->model("EnsembleSuivi/DTO/EnsembleSuiviDTO");
        $this->load->model("EnsembleSuivi/DTO/EnsembleSuiviCollection");
     
    }
    
    /**
     * permet d'initialiser les dao du service
     * @param ReservationDAO $daoReserver
     * @param JeuDAO $daoJeu
     * @param TypeJeuDAO $daoTypeJeu
     * @return EnsembleReserverService
     */
    public function initConstruct($editeurContactDAO, $suiviDAO,$editeurDAO, $jeuDAO, $reservationDAO, $reserverDAO, $festivalDAO){
        $this->suiviDAO         = $suiviDAO;
        $this->editeurContactDAO= $editeurContactDAO;
        $this->editeurDAO       = $editeurDAO;
        $this->jeuDAO           = $jeuDAO;
        $this->reservationDAO   = $reservationDAO;
        $this->reserverDAO      = $reserverDAO;
        $this->festivalDAO      = $festivalDAO;
        
        return $this;
    }
    
    /**
     * Retourne un EnsembleSuiviCollection contenant tous les ensembleSuiviDTO de chaque editeur
     * si le festival est vide, les suiviDTO des ensembleSuiviDTO seront instancié vide
     * @param int $idFestival
     * @return EnsembleSuiviCollection
     */
    public function getEnsembleSuiviDTOByIdFestival ($idFestival) {
        $ensembleSuiviCollection  = new EnsembleSuiviCollection();
        
        $editeurContactCollection = $this->editeurContactDAO->getEditeurContactPrincipal();
        
        foreach ($editeurContactCollection as $editeurContactDto){
            $ensembleSuiviTmp = new EnsembleSuiviDTO();
            
            try{
                $suiviDto = $this->suiviDAO->getSuiviByIdEditeurFestival($editeurContactDto->getIdEditeur(), $idFestival);  
            }catch (Exception $e){
                $suiviDto = new SuiviDTO();
            }
            $ensembleSuiviTmp->setSuiviDTO($suiviDto);
            $ensembleSuiviTmp->setEditeurContactDTO($editeurContactDto);
            
            $ensembleSuiviCollection->append($ensembleSuiviTmp);
        }
        return $ensembleSuiviCollection;
    }



    /**
     * supprime un éditeur en bdd et tous les suivis/jeux/reservation/reserver
     * @param int $idEditeur
     */
    public function supprimerEditeur($idEditeur){
        //suppression des suivis
        $suiviCollection = $this->suiviDAO->getSuiviByIdEditeur($idEditeur);
        foreach ($suiviCollection as $suiviDTO){
            $this->suiviDAO->deleteSuivi($suiviDTO);
        }
        
        //suppression des jeux
        $jeuCollection = $this->jeuDAO->getJeuByIdEditeur($idEditeur);
        foreach ($jeuCollection as $jeuDTO){
            $this->jeuDAO->deleteJeu($jeuDTO);
        }
        
        //suppression des réservation + reserver
        $reservationCollection = $this->reservationDAO->getReservationByIdEditeur($idEditeur);
        foreach ($reservationCollection as $reservationDTO){
            $reserverCollection = $this->reserverDAO->getReserverByIdReservation($reservationDTO->getIdReservation());
            foreach($reserverCollection as $reserverDTO){
                $this->reserverDAO->deleteReserver($reserverDTO);
            }
            $this->reservationDAO->deleteReservation($reservationDTO);
        }
        $editeurDTO = $this->editeurDAO->getEditeurById($idEditeur);
        $this->editeurDAO->deleteEditeur($editeurDTO);
    }
    
    /**
     * Ajoute un éditeur en BDD + les suivis correspondants
     * @param EditeurDTO $editeurDTO
     */
    public function ajouterEditeur($editeurDTO){
        $this->editeurDAO->saveEditeur($editeurDTO);
        
        try{
            $editeurDto = $this->editeurDAO->getLastIdEditeur();
            
            $suiviDto = new SuiviDTO();
            $suiviDto->setIdEditeur($editeurDto->getIdEditeur());
            $suiviDto->setPresenceEditeur(0);
            $suiviDto->setLogementSuivi(0);
            
            $festivalCollection = $this->festivalDAO->getFestivals();
            
            foreach ($festivalCollection as $festivalDto){
                $suiviDto->setIdFestival($festivalDto->getIdFestival());
                $this->suiviDAO->saveSuivi($suiviDto);
            }
        }catch(Exception $e){
            
        }
    }

/* renvoie que les suivis des éditeurs pas contacté */

   public function getSuiviNonContacteDTOByIdFestival ($idFestival) {
        $ensembleSuiviCollection = new EnsembleSuiviCollection();
        $suivisDTO = $this->suiviDAO->getSuiviByIdFestival($idFestival);

        foreach ($suivisDTO as $key => $suiviDTO) {
            $ensembleSuiviTmp = new EnsembleSuiviDTO();
            
            $premierContact = $suiviDTO->getPremierContact();

            if ($premierContact == null) {

                $editeurContactDTO = $this->editeurContactDAO->getEditeurContactByIdEditeur($suiviDTO->getIdEditeur());

                $ensembleSuiviTmp->setSuiviDTO($suiviDTO);
                $ensembleSuiviTmp->setEditeurContactDTO($editeurContactDTO);

                $ensembleSuiviCollection->append($ensembleSuiviTmp);

            }
        }

        return $ensembleSuiviCollection;
        
    }
    


/* renvoie que les suivis des éditeurs contactés 1 fois mais qui n'ont pas répondu */

   public function getSuivi1erContactSansReponseDTOByIdFestival ($idFestival) {
        $ensembleSuiviCollection = new EnsembleSuiviCollection();
        $suivisDTO = $this->suiviDAO->getSuiviByIdFestival($idFestival);

        foreach ($suivisDTO as $key => $suiviDTO) {
            $ensembleSuiviTmp = new EnsembleSuiviDTO();
            
            $premierContact = $suiviDTO->getPremierContact();
            $secondContact = $suiviDTO->getSecondContact();
            $reponseEditeur = $suiviDTO->getReponseEditeur();
            
            if (!is_null($premierContact) and is_null($secondContact) and ($reponseEditeur == -1 or is_null($reponseEditeur))) {
                
                $editeurContactDTO = $this->editeurContactDAO->getEditeurContactByIdEditeur($suiviDTO->getIdEditeur());
            
                $ensembleSuiviTmp->setSuiviDTO($suiviDTO);
                $ensembleSuiviTmp->setEditeurContactDTO($editeurContactDTO);
            
                $ensembleSuiviCollection->append($ensembleSuiviTmp);

            }
        }

        return $ensembleSuiviCollection;
        
    }


/* renvoie que les suivis des éditeurs contactés 2 fois mais qui n'ont pas répondu */

   public function getSuivi2emeContactSansReponseDTOByIdFestival ($idFestival) {
        $ensembleSuiviCollection = new EnsembleSuiviCollection();
        $suivisDTO = $this->suiviDAO->getSuiviByIdFestival($idFestival);

        foreach ($suivisDTO as $key => $suiviDTO) {
            $ensembleSuiviTmp = new EnsembleSuiviDTO();
            
            $secondContact = $suiviDTO->getSecondContact();
            $reponseEditeur = $suiviDTO->getReponseEditeur();

            if (!is_null($secondContact) and ($reponseEditeur== -1 or is_null($reponseEditeur))) {

                $editeurContactDTO = $this->editeurContactDAO->getEditeurContactByIdEditeur($suiviDTO->getIdEditeur());
            
                $ensembleSuiviTmp->setSuiviDTO($suiviDTO);
                $ensembleSuiviTmp->setEditeurContactDTO($editeurContactDTO);
            
                $ensembleSuiviCollection->append($ensembleSuiviTmp);

            }
        }

        return $ensembleSuiviCollection;
        
    }



/* renvoie que les suivis des éditeurs qui ont répondu OUI (au 1er ou 2eme contact) */

   public function getSuiviReponseOuiDTOByIdFestival ($idFestival) {
        $ensembleSuiviCollection = new EnsembleSuiviCollection();
        $suivisDTO = $this->suiviDAO->getSuiviByIdFestival($idFestival);

        foreach ($suivisDTO as $key => $suiviDTO) {
            $ensembleSuiviTmp = new EnsembleSuiviDTO();
            
            $reponseEditeur = $suiviDTO->getReponseEditeur();

            if ($reponseEditeur==3) {

                $editeurContactDTO = $this->editeurContactDAO->getEditeurContactByIdEditeur($suiviDTO->getIdEditeur());
            
                $ensembleSuiviTmp->setSuiviDTO($suiviDTO);
                $ensembleSuiviTmp->setEditeurContactDTO($editeurContactDTO);
            
                $ensembleSuiviCollection->append($ensembleSuiviTmp);

            }
        }

        return $ensembleSuiviCollection;
        
   }

/* renvoie que les suivis des éditeurs qui ont répondu NON (au 1er ou 2eme contact) */

   public function getSuiviReponseNonDTOByIdFestival ($idFestival) {
        $ensembleSuiviCollection = new EnsembleSuiviCollection();
        $suivisDTO = $this->suiviDAO->getSuiviByIdFestival($idFestival);

        foreach ($suivisDTO as $key => $suiviDTO) {
            $ensembleSuiviTmp = new EnsembleSuiviDTO();
            
            $reponseEditeur = $suiviDTO->getReponseEditeur();

            if ($reponseEditeur==1) {

                $editeurContactDTO = $this->editeurContactDAO->getEditeurContactByIdEditeur($suiviDTO->getIdEditeur());
            
                $ensembleSuiviTmp->setSuiviDTO($suiviDTO);
                $ensembleSuiviTmp->setEditeurContactDTO($editeurContactDTO);
            
                $ensembleSuiviCollection->append($ensembleSuiviTmp);

            }
        }

        return $ensembleSuiviCollection;
        
    }


/* renvoie que les suivis des éditeurs qui ont répondu PEUT ETRE (au 1er ou 2eme contact) */

   public function getSuiviReponsePeutEtreDTOByIdFestival ($idFestival) {
        $ensembleSuiviCollection = new EnsembleSuiviCollection();
        $suivisDTO = $this->suiviDAO->getSuiviByIdFestival($idFestival);

        foreach ($suivisDTO as $key => $suiviDTO) {
            $ensembleSuiviTmp = new EnsembleSuiviDTO();
            
            $reponseEditeur = $suiviDTO->getReponseEditeur();

            if ($reponseEditeur==2) {

                $editeurContactDTO = $this->editeurContactDAO->getEditeurContactByIdEditeur($suiviDTO->getIdEditeur());
            
                $ensembleSuiviTmp->setSuiviDTO($suiviDTO);
                $ensembleSuiviTmp->setEditeurContactDTO($editeurContactDTO);
            
                $ensembleSuiviCollection->append($ensembleSuiviTmp);

            }
        }

        return $ensembleSuiviCollection;
        
    }
}
