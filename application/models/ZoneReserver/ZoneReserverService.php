<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ZoneReserverService extends CI_Model
{
    
    public function __construct() {
        parent::__construct();
        $this->load->model("EnsembleReservation/EnsembleReserver/EnsembleReserverFactory");
        $this->load->model("Zone/ZoneFactory");
        $this->load->model("ZoneReserver/DTO/ZoneReserverCollection");
        $this->load->model("ZoneReserver/DTO/ZoneReserverDTO");
    }
    
    
    public function getZoneReserverService ($idFestival) {
        $zoneDAO = $this->ZoneFactory->getInstance();
        $zonesDTO = $zoneDAO->getZonesByIdFestival($idFestival);
        $zoneReserverCollection = new ZoneReserverCollection();
        
        $ensembleReserverDAO = $this->EnsembleReserverFactory->getInstance();

        foreach ($zonesDTO as $key => $zoneDTO) {
            $zoneReserverDTO = new ZoneReserverDTO();
            
            try {
                // Récupère tout les jeux qui sont dans une zone
                $reserverZoneCollection = $ensembleReserverDAO->getEnsembleReserverByZone($idFestival, $zoneDTO->getIdZone());
                $zoneReserverDTO->setEnsembleReserverCollection($reserverZoneCollection);
                
                $zoneReserverDTO->setZoneDTO($zoneDTO);
                
                $zoneReserverCollection->append($zoneReserverDTO);
                
            } catch (Exception $e) {
                
            }
        }
        
        return $zoneReserverCollection;
    }
}