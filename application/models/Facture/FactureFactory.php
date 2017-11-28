<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FactureFactory extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Facture/DAO/FactureDAO');
    }
    
    static public function getInstance() {
        return new FactureDAO();
    }
}