<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EnsembleLocaliserFactory extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Zone/ZoneFactory');
        $this->load->model('Localiser/LocaliserFactory');
    }
 
    static public function getInstance() {
        $zoneDao        = ZoneFactory::getInstance();
        $localiserDao   = LocaliserFactory::getInstance();
        
        $dao = new EnsembleLocaliserService();
        return $dao->initConstruct($localiserDao, $zoneDao);
    }
}