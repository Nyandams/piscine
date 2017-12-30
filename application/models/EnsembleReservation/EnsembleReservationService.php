<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EnsembleReservationService extends CI_Model
{
    private $ensembleReserverService = null;    
    private $reservationDao = null;
    
    public function __construct() {
        parent::__construct();
        $this->load->model("Reserver/DAO/ReserverDAO");
        $this->load->model("EnsembleReservation/DTO/EnsembleReservationDTO");
    }
    
    /**
     * initialise l' EnsembleReserverService et le ReservationDAO du service
     * @param EnsembleReserverService $serviceEnsembleReserver
     * @param ReservationDAO $daoReservation
     * @return EnsembleReservationService
     */
    public function initConstruct($serviceEnsembleReserver, $daoReservation){
        $this->ensembleReserverService = $serviceEnsembleReserver;
        $this->reservationDao          = $daoReservation;
        
        return $this;
    }
    
    public function getReservationActuelleByEditeur($idEditeur){
        $ensembleReservationDTO = new EnsembleReservationDTO();
        
        $idFestival = $this->session->userdata('idFestival');
        $ensembleReservationDTO->setIdFestival($idFestival);
        $ensembleReservationDTO->setIdEditeur($idEditeur);
        
        try{
            $reservationDto = $this->reservationDao->getReservationByIdEditeurFestival($idEditeur, $idFestival);
            $ensembleReservationDTO->setIdReservation($reservationDto->getIdReservation());
            $ensembleReservationDTO->setPrixNegociationReservation($reservationDto->getPrixNegociationReservation());
            
            $reserverCollection = $this->ensembleReserverService->getEnsembleReserverByIdReservation($ensembleReservationDTO->getIdReservation());
            $ensembleReservationDTO->setEnsembleReserverCollection($reserverCollection);
        } catch (Exception $e){

        }
        
        return $ensembleReservationDTO;
    }
}