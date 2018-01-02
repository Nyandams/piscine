<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EnsembleReservationService extends CI_Model
{
    private $ensembleReserverService = null;    
    private $reservationDao = null;
    private $factureDao     = null;
    private $ensembleLocaliserService = null;
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * initialise l' EnsembleReserverService et le ReservationDAO du service
     * @param EnsembleReserverService $serviceEnsembleReserver
     * @param ReservationDAO $daoReservation
     * @return EnsembleReservationService
     */
    public function initConstruct($serviceEnsembleReserver, $daoReservation, $daoFacture, $serviceEnsembleLocaliser){
        $this->ensembleReserverService = $serviceEnsembleReserver;
        $this->reservationDao          = $daoReservation;
        $this->factureDao              = $daoFacture;
        $this->ensembleLocaliserService= $serviceEnsembleLocaliser;
        return $this;
    }
    
    /**
     * Prend en argument l'id d'un éditeur et renvoie ensembleReserverDTO
     * @param int $idEditeur
     */
    public function getReserverByIdEditeur($idEditeur){
        $idFestival = $this->session->userdata('idFestival');
        $reserverCollection = $this->ensembleReserverService->getEnsembleReserverByIdReservation($ensembleReservationDTO->getIdReservation());
        
        return $reserverCollection;
    }
    
    /**
     * sauvegarde un reserverDTO en bdd
     * @param ReserverDTO $reserverDTO
     */
    public function setReserver($reserverDTO, $idEditeur){
        $idFestival = $this->session->userdata('idFestival');
        try{
            $reservationDto = $this->reservationDao->getReservationByIdEditeurFestival($idEditeur, $idFestival);
            $reserverDTO->setIdReservation($reservationDto->getIdReservation());
            return True;
        }catch(Exception $e){
            $reservationDto = new ReservationDTO();
            $reservationDto->setIdEditeur($idEditeur);
            $reservationDto->setIdFestival($idFestival);
            $this->reservationDao->saveReservation($reservationDTO);
            try{
                $reservationDto = $this->reservationDao->getReservationByIdEditeurFestival($idEditeur, $idFestival);
                $reserverDTO->setIdReservation($reservationDto->getIdReservation());
                return True;
            }catch(Exception $e){
                return False;
            }
            
        }
    }
    
    /**
     * renvoie sous forme d'ensembleReservation toutes les information liées à la réservation d'un éditeur
     * @param int $idEditeur
     * @return EnsembleReservationDTO
     */
    public function getReservationActuelleByEditeur($idEditeur){
        $ensembleReservationDTO = new EnsembleReservationDTO();
        
        $idFestival = $this->session->userdata('idFestival');
        
        try{
            $reservationDto = $this->reservationDao->getReservationByIdEditeurFestival($idEditeur, $idFestival);
            $ensembleReservationDTO->setReservationDTO($reservationDto);
            
            $reserverCollection = $this->ensembleReserverService->getEnsembleReserverByIdReservation($ensembleReservationDTO->getIdReservation());
            $ensembleReservationDTO->setEnsembleReserverCollection($reserverCollection);
            
            $factureDto = $this->factureDao->getFactureByIdReservation($reservationDto->getIdReservation());
            $ensembleReservationDTO->setFactureDTO($factureDto);
            
            $ensembleLocaliserDto = $this->ensembleLocaliserService->getEnsembleLocaliserByIdReservation($reservationDto->getIdReservation());
            $ensembleReservationDTO->setEnsembleLocaliserDTO($ensembleLocaliserDto);
        } catch (Exception $e){
            //si la réservation n'est pas trouvé, un ensembleReservation remplie de dto vide est renvoyé, à modifier selon ce que tu veux récup si c'est vide
            $ensembleReservationDTO->setEnsembleLocaliserDTO(new EnsembleLocaliserDTO());
            $ensembleReservationDTO->getEnsembleLocaliserDTO()->setLocaliserDTO(new LocaliserDTO());
            $ensembleReservationDTO->getEnsembleLocaliserDTO()->setZoneDTO(new ZoneDTO());
            $ensembleReservationDTO->setEnsembleReserverCollection(new EnsembleReserverCollection());
            $ensembleReservationDTO->setFactureDTO(new FactureDTO());
            $ensembleReservationDTO->setReservationDTO(new ReservationDTO());
        }
        
        return $ensembleReservationDTO;
    }
}