<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FestivalFactory extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Festival/DAO/FestivalDAO');
    }
    
    static public function getInstance() {
        return new FestivalDAO();
    }
}