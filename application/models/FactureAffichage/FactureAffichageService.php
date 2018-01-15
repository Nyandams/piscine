<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FactureAffichageService extends CI_Model
{
    private $reservationDao = null;
    private $factureDao     = null;
    private $festivalDao    = null;
    private $editeurDao     = null;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('FactureAffichage/DTO/FactureAffichageDTO');
        $this->load->model('FactureAffichage/DTO/FactureAffichageCollection');
    }
    
    /**
     * initialise l' EnsembleReserverService et le ReservationDAO du service
     * @param EnsembleReserverService $serviceEnsembleReserver
     * @param ReservationDAO $daoReservation
     * @return EnsembleReservationService
     */
    public function initConstruct($daoReservation, $daoFacture, $daoFestival, $daoEditeur){
        $this->reservationDao   = $daoReservation;
        $this->factureDao       = $daoFacture;
        $this->festivalDao      = $daoFestival;
        $this->editeurDao       = $daoEditeur;
        return $this;
    }
    
    /**
     * renvoie tout les factureAffichageCollection d'un festival
     * @param int $idFestival
     */
    public function getFactureByIdFestival($idFestival){
        $festivalDAO = $this->FestivalFactory->getInstance();
        $festivalDto = $festivalDAO->getFestivalById($idFestival);
        $reservationCollection = $this->reservationDao->getReservationByIdFestival($idFestival);
        
        $factureAffichageCollection = new FactureAffichageCollection();
        foreach ($reservationCollection as $reservationDto){
            try{
                $factureDto = $this->factureDao->getFactureByIdReservation($reservationDto->getIdReservation());
                $editeurDto = $this->editeurDao->getEditeurById($reservationDto->getIdEditeur());
                $factureAffichageDto = new FactureAffichageDTO();
                $factureAffichageDto->setIdEditeur($reservationDto->getIdEditeur());
                $factureAffichageDto->setLibelleEditeur($editeurDto->getLibelleEditeur());
                $factureAffichageDto->setIdFacture($factureDto->getIdFacture());
                $factureAffichageDto->setIdReservation($reservationDto->getIdReservation());
                $factureAffichageDto->setIdFestival($festivalDto->getIdFestival());
                $factureAffichageDto->setPrixNegociationReservation($reservationDto->getPrixNegociationReservation());
                $factureAffichageDto->setAnneeFestival($festivalDto->getAnneeFestival());
                $factureAffichageDto->setDateEmissionFacture($factureDto->getDateEmissionFacture());
                $factureAffichageDto->setDatePaiementFacture($factureDto->getDatePaiementFacture());
                
                $factureAffichageCollection->append($factureAffichageDto);
            }catch(Exception $e){
                
            }
        }
     
        return $factureAffichageCollection;        
    }
    
}