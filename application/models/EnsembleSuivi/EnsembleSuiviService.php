<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EnsembleSuiviService extends CI_Model
{
    private $suiviDAO = null;
    private $editeurDAO = null;
   
    
    
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
    public function initConstruct($editeurDAO, $suiviDAO){
        $this->suiviDAO = $suiviDAO;
        $this->editeurDAO = $editeurDAO;
        
        return $this;
    }
    
    public function getEnsembleSuiviDTOByIdFestival ($idFestival) {
        $ensembleSuiviCollection = new EnsembleSuiviCollection();
        $suivisDTO = $this->suiviDAO->getSuiviByIdFestival();
        
        foreach ($suivisDTO as $key => $suiviDTO) {
            $ensembleSuiviTmp = new EnsembleSuiviDTO();
            $editeurDTO = $this->editeurDAO->getEditeurById($suiviDTO->getIdEditeur());
            
            
            $ensembleSuiviTmp->setSuiviDTO($suiviDTO);
            $ensembleSuiviTmp->setEditeurDTO($editeurDTO);
            
            $ensembleSuiviCollection->append($ensembleSuiviTmp);
        }
        
        return $ensembleSuiviCollection;
        
    }
    
}