<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SuiviFactory extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Suivi/DAO/SuiviDAO');
    }
    
    static public function getInstance() {
        return new SuiviDAO();
    }
}