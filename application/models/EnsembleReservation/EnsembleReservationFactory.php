<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EnsembleReservationFactory extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Reservation/ReservationFactory');
        $this->load->model('EnsembleReservation/EnsembleReserverFactory');
    }
    
    
    static public function getInstance() {
        $reserverService = EnsembleReserverFactory::getInstance();
        $reservationDao  = ReservationFactory::getInstance();
        $dao = new EnsembleReservationService();
        return $dao->initConstruct($reserverService, $reservationDao);
    }
}