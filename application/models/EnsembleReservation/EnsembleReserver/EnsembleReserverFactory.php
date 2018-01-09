<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EnsembleReserverFactory extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Reserver/ReserverFactory');
        $this->load->model('Jeu/JeuFactory');
        $this->load->model('TypeJeu/TypeJeuFactory');
        $this->load->model('Zone/ZoneFactory');
    }
    
    static public function getInstance() {
        $reserverDAO = ReserverFactory::getInstance();
        $jeuDAO      = JeuFactory::getInstance();
        $typeJeuDAO  = TypeJeuFactory::getInstance();
        $zoneDAO     = ZoneFactory::getInstance();
        
        $dao = new EnsembleReserverService();
        return $dao->initConstruct($reserverDAO, $jeuDAO, $typeJeuDAO, $zoneDAO);
    }
}