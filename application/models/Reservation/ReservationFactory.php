<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ReservationFactory extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Reservation/DAO/ReservationDAO');
    }
    
    static public function getInstance() {
        return new ReservationDAO();
    }
}