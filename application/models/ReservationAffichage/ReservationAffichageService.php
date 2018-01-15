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
        $this->load->model('Reserver/ReserverFactory');
        $this->load->model('Jeu/JeuFactory');
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
                $editeurDto = $this->editeurDao->getEditeurById($reservationDto->getIdEditeur());

        		$reservationAffichageDto = new ReservationAffichageDTO();
        		$reservationAffichageDto->setIdEditeur($reservationDto->getIdEditeur());
        		$reservationAffichageDto->setLibelleEditeur($editeurDto->getLibelleEditeur());
        		$reservationAffichageDto->setIdFestival($idFestival);
        		$reservationAffichageDto->setAnneeFestival($festivalDto->getAnneeFestival());
        		$reservationAffichageDto->setPrixNegociationReservation($reservationDto->getPrixNegociationReservation());
        		$reservationAffichageDto->setNbEmplacement($reservationDto->getNbEmplacement());
                
                $reserverDao = $this->ReserverFactory->getInstance();
                $jeuDao      = $this->JeuFactory->getInstance();
                $reserverCollection = $reserverDao->getReserverByIdReservation($reservationDto->getIdReservation());
                
                $listeJeu = "";
                $stringVide = "";
                foreach ($reserverCollection as $reserver){
                    if($listeJeu == $stringVide){
                        $listeJeu .= $jeuDao->getJeuById($reserver->getIdJeu())->getLibelleJeu();
                    }else{
                        $listeJeu .= ', ' .$jeuDao->getJeuById($reserver->getIdJeu())->getLibelleJeu();
                    }
                }
                
                
        		$reservationAffichageDto->setLibelleJeu($listeJeu);
        		
                $reservationAffichageCollection->append($reservationAffichageDto);

            }catch(Exception $e){
            }
        }
        
        return $reservationAffichageCollection;        
    }
    
}
