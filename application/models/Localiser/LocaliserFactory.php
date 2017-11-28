<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LocaliserFactory extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Localiser/DAO/LocaliserDAO');
    }
    
    static public function getInstance() {
        return new LocaliserDAO();
    }
}