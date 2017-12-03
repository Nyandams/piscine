<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ReserverFactory extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Reserver/DAO/ReserverDAO');
    }
    
    static public function getInstance() {
        return new ReserverDAO();
    }
}