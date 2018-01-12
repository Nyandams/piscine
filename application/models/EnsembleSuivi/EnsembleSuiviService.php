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
            
            $editeurContactDTO = $this->
            editeurContactDAO->
            getEditeurContactByIdEditeur($suiviDTO->getIdEditeur());
            
            
            $ensembleSuiviTmp->setSuiviDTO($suiviDTO);
            $ensembleSuiviTmp->setEditeurContactDTO($editeurContactDTO);
            
            $ensembleSuiviCollection->append($ensembleSuiviTmp);
        }
        
        return $ensembleSuiviCollection;
        
    }


### alia et hedvig :

    #renvoie que les suivis des éditeurs pas contacté

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
    
}