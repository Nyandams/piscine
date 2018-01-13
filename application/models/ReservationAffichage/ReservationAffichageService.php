<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ReservationAffichageService extends CI_Model
{
    private $reservationDao = null;
    private $jeuDao         = null;
    private $festivalDao    = null;
    private $editeurDao     = null;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('ReservationAffichage/DTO/ReservationAffichageDTO');
        $this->load->model('ReservationAffichage/DTO/ReservationAffichageCollection');
    }
    
    /**
     * initialise l' EnsembleReserverService et le ReservationDAO du service
     * @param EnsembleReserverService $serviceEnsembleReserver
     * @param ReservationDAO $daoReservation
     * @return EnsembleReservationService
     */

    public function initConstruct($daoReservation, $daoJeu, $daoFestival, $daoEditeur){
        $this->reservationDao   = $daoReservation;
        $this->jeuDao       	= $daoJeu;
        $this->festivalDao      = $daoFestival;
        $this->editeurDao       = $daoEditeur;
        return $this;
    }


    /**
     * renvoie tout les reservationAffichageCollection d'un festival
     * @param int $idFestival
     */

    public function getReservationByIdFestival($idFestival){
        try{
            $festivalDto = $this->festivalDao->getFestivalById($idFestival);
        }catch(Exception $e){
            $festivalDto = new FestivalDTO();
        }

        $reservationCollection = $this->reservationDao->getReservationByIdFestival($idFestival);
        $reservationAffichageCollection = new ReservationAffichageCollection();
        foreach ($reservationCollection as $reservationDto){
            try{

                $jeuDto = $this->jeuDao->getJeuById($reservationDto->getIdReservation());        
                $editeurDto = $this->editeurDao->getEditeurById($reservationDto->getIdReservation());

		$reservationAffichageDto = new ReservationAffichageDTO();
		$reservationAffichageDto->setIdEditeur($reservationDto->getIdEditeur());
		$reservationAffichageDto->setLibelleEditeur($editeurDto->getLibelleEditeur());
		$reservationAffichageDto->setIdFestival($festivalDto->getIdFestival());
		$reservationAffichageDto->setAnneeFestival($festivalDto->getAnneeFestival());
		$reservationAffichageDto->setPrixNegociationReservation($reservationDto->getPrixNegociationReservation());
		$reservationAffichageDto->setNbEmplacement($reservationDto->getNbEmplacement());
                $reservationAffichageDto->setIdJeu($jeuDto->getLibelleJeu());
		$reservationAffichageDto->setLibelleJeu($jeuDto->getLibelleJeu());
 
                $reservationAffichageCollection->append($reservationAffichageDto);

            }catch(Exception $e){
                
            }
        }
        
        return $reservationAffichageCollection;        
    }
    
}
