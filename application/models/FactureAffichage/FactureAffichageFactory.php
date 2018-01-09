<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FactureAffichageFactory extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->model('FactureAffichage/FactureAffichageService');
        $this->load->model('Reservation/ReservationFactory');
        $this->load->model('Facture/FactureFactory');
        $this->load->model('Festival/FestivalFactory');
        $this->load->model('Editeur/EditeurFactory');
    }
    
    
    static public function getInstance() {
        $reservationDao     = ReservationFactory::getInstance();
        $factureDao         = FactureFactory::getInstance();
        $festivalDao        = FestivalFactory::getInstance();
        $editeurDao         = EditeurFactory::getInstance();
        
        $dao = new FactureAffichageService();
        return $dao->initConstruct($reservationDao, $factureDao, $festivalDao, $editeurDao);
    }
}