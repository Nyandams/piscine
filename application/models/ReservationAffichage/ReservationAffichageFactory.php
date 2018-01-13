<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ReservationAffichageFactory extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->model('ReservationAffichage/ReservationAffichageService');
        $this->load->model('Reservation/ReservationFactory');
	$this->load->model('Jeu/JeuFactory');
        $this->load->model('Festival/FestivalFactory');
        $this->load->model('Editeur/EditeurFactory');
    }


    static public function getInstance() {
        $reservationDao     = ReservationFactory::getInstance();
        $jeuDao             = JeuFactory::getInstance();
        $festivalDao        = FestivalFactory::getInstance();
        $editeurDao         = EditeurFactory::getInstance();
        
        $dao = new ReservationAffichageService();
        return $dao->initConstruct($reservationDao, $jeuDao, $festivalDao, $editeurDao);
    }
}
