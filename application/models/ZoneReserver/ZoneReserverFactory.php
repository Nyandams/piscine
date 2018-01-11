<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ZoneReserverFactory extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->model('ZoneReserver/ZoneReserverService');
    }
    
    static public function getInstance() {
        return new ZoneReserverService();
    }
}