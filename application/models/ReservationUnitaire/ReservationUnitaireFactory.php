<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ReservationUnitaireFactory extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Jeu/JeuFactory');
        $this->load->model('Reserver/ReserverFactory');
        $this->load->model('ReservationUnitaire/ReservationUnitaireService');
    }
    
    static public function getInstance() {
        $jeuDAO = JeuFactory::getInstance();
        $reserverDAO = ReserverFactory::getInstance();
        
        $dao = new ReservationUnitaireService();
        return $dao->initConstruct($jeuDAO, $reserverDAO);
    }
}