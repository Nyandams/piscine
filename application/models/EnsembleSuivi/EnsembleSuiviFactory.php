<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EnsembleSuiviFactory extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->model('EditeurContact/EditeurContactFactory');
        $this->load->model('Suivi/SuiviFactory');
        $this->load->model('EnsembleSuivi/EnsembleSuiviService');
        $this->load->model('Editeur/EditeurFactory');
        $this->load->model('Jeu/JeuFactory');
        $this->load->model('Reservation/ReservationFactory');
        $this->load->model('Reserver/ReserverFactory');
    }
    
    static public function getInstance() {
        $editeurContactDAO = EditeurContactFactory::getInstance();
        $suiviDAO   = SuiviFactory::getInstance();
        $editeurDAO = EditeurFactory::getInstance();
        $jeuDAO     = JeuFactory::getInstance();
        $reservationDAO = ReservationFactory::getInstance();
        $reserverDAO = ReserverFactory::getInstance();
        
        $dao = new EnsembleSuiviService();
        return $dao->initConstruct($editeurContactDAO, $suiviDAO, $editeurDAO, $jeuDAO, $reservationDAO, $reserverDAO);
    }
}