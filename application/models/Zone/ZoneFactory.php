<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ZoneFactory extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Zone/DAO/ZoneDAO');
    }
    
    static public function getInstance() {
        return new ZoneDAO();
    }
}