<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EnsembleLocaliserService extends CI_Model
{
    private $localiserDao = null;
    private $zoneDao     = null;
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * initialise l' EnsembleReserverService et le ReservationDAO du service
     * @param EnsembleReserverService $serviceEnsembleReserver
     * @param ReservationDAO $daoReservation
     * @return EnsembleReservationService
     */
    public function initConstruct($daoLocaliser, $daoZone){
        $this->localiserDao = $daoLocaliser;
        $this->zoneDao      = $daoZone;
        return $this;
    }
    
    /**
     * renvoie l'ensembleLocaliser correspondant à un idReservation
     * @param int $idReservation
     * @return EnsembleLocaliserDTO
     */
    public function getEnsembleLocaliserByIdReservation($idReservation){
        $ensembleLocaliserDto = new EnsembleLocaliserDTO();
        try{
            $localiserDto = $this->localiserDao->getLocaliserByIdReservation($idReservation);
            $ensembleLocaliserDto->setLocaliserDTO($localiserDto);
            
            $zoneDto      = $this->zoneDao->getZoneById($localiserDto->getIdZone());
            $ensembleLocaliserDto->setZoneDTO($zoneDto);
        }catch(Exception $e){
            
        }
        return $ensembleLocaliserDto;
    }
}