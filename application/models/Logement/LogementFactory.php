<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LogementFactory extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Logement/DAO/LogementDAO');
    }
    
    static public function getInstance() {
        return new LogementDAO();
    }
}