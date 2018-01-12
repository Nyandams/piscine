<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ZoneReserverService extends CI_Model
{
    
    public function __construct() {
        parent::__construct();
        $this->load->model("EnsembleReservation/EnsembleReserver/EnsembleReserverFactory");
        $this->load->model("Zone/ZoneFactory");
        $this->load->model("ZoneReserver/DTO/ZoneReserverCollection");
        $this->load->model("ZoneReserver/DTO/ZoneReserverDTO");
        $this->load->model("Editeur/EditeurFactory");
        $this->load->model("ZoneReserver/DTO/EnsembleJeuEditeurReserverDTO");
        $this->load->model("ZoneReserver/DTO/EnsembleJeuEditeurReserverCollection");
    }
    
    
    public function getZoneReserverService ($idFestival) {
        $zoneDAO = $this->ZoneFactory->getInstance();
        $zonesDTO = $zoneDAO->getZonesByIdFestival($idFestival);
        $zoneReserverCollection = new ZoneReserverCollection();
        
        $ensembleReserverDAO = $this->EnsembleReserverFactory->getInstance();
        foreach ($zonesDTO as $key => $zoneDTO) {
            $zoneReserverDTO = new ZoneReserverDTO();
            $ensembleJeuEditeur = new EnsembleJeuEditeurReserverDTO();
            $ensembleJeuEditeurCollection = new EnsembleJeuEditeurReserverCollection();
            try {
                // Récupération de ensembleReserver qui nous donne une bonne partie des infos
                $reserverZoneCollection = $ensembleReserverDAO->getEnsembleReserverByZone($idFestival, $zoneDTO->getIdZone());
 
               // Création des lignes pour chaque zone
                foreach ($reserverZoneCollection as $key => $reserverZoneCollection) {
                    $ensembleJeuEditeur = new EnsembleJeuEditeurReserverDTO();
                    
                    $ensembleJeuEditeur->setJeuDTO($reserverZoneCollection->getJeuDTO());
                    $ensembleJeuEditeur->setReserverDTO($reserverZoneCollection->getReserverDTO());
                    $ensembleJeuEditeur->setTypeJeuDTO($reserverZoneCollection->getTypeJeuDTO());
                    
                    // Récupération de l'éditeur
                    $jeuDTO = $reserverZoneCollection->getJeuDTO();
                    $idEditeur = $jeuDTO->getIdEditeur();
                    $editeurDAO = $this->EditeurFactory->getInstance();
                    $editeurDTO = $editeurDAO->getEditeurById($idEditeur);
                    $ensembleJeuEditeur->setEditeurDTO($editeurDTO);
                    
                    $ensembleJeuEditeurCollection->append($ensembleJeuEditeur);
                    
                }
                
                $zoneReserverDTO->setZoneDTO($zoneDTO);
                
                
                $zoneReserverDTO->setEnsembleJeuEditeur($ensembleJeuEditeurCollection);
                $zoneReserverCollection->append($zoneReserverDTO);
                
            } catch (Exception $e) {
                print($e);
            }
        }
        
        return $zoneReserverCollection;
    }
}