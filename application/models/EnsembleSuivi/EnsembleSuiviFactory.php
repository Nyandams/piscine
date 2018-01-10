<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EnsembleSuiviFactory extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Editeur/EditeurFactory');
        $this->load->model('Suivi/SuiviFactory');
        $this->load->model('EnsembleSuivi/EnsembleSuiviService');
    }
    
    static public function getInstance() {
        $editeurDAO = EditeurFactory::getInstance();
        $suiviDAO   = SuiviFactory::getInstance();
        
        $dao = new EnsembleSuiviService();
        return $dao->initConstruct($editeurDAO, $suiviDAO);
    }
}