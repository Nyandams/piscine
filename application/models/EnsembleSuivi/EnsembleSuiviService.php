<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EnsembleSuiviService extends CI_Model
{
    private $suiviDAO = null;
    private $editeurContactDAO = null;
   
    
    
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
    public function initConstruct($editeurContactDAO, $suiviDAO){
        $this->suiviDAO = $suiviDAO;
        $this->editeurContactDAO = $editeurContactDAO;
        
        return $this;
    }
    
    public function getEnsembleSuiviDTOByIdFestival ($idFestival) {
        $ensembleSuiviCollection = new EnsembleSuiviCollection();
        $suivisDTO = $this->suiviDAO->getSuiviByIdFestival($idFestival);
        
        
        foreach ($suivisDTO as $key => $suiviDTO) {
            $ensembleSuiviTmp = new EnsembleSuiviDTO();
            
            $editeurContactDTO = $this->editeurContactDAO->getEditeurContactByIdEditeur($suiviDTO->getIdEditeur());
            
            
            $ensembleSuiviTmp->setSuiviDTO($suiviDTO);
            $ensembleSuiviTmp->setEditeurContactDTO($editeurContactDTO);
            
            $ensembleSuiviCollection->append($ensembleSuiviTmp);
        }
        
        return $ensembleSuiviCollection;
        
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

            if ($premierContact!=null and $secondContact==null and $reponseEditeur== -1) {

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

            if ($secondContact!=null and $reponseEditeur== -1) {

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
