<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HebergementFactory extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Hebergement/DAO/HebergementDAO');
    }
    
    static public function getInstance() {
        return new HebergementDAO();
    }
}