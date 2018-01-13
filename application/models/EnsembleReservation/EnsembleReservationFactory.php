<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EnsembleReservationFactory extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Reservation/ReservationFactory');
        $this->load->model('Facture/FactureFactory');
        $this->load->model('EnsembleReservation/EnsembleReserver/EnsembleReserverFactory');
        $this->load->model('EnsembleReservation/EnsembleReservationService');
    }
    
    
    static public function getInstance() {
        $reserverService    = EnsembleReserverFactory::getInstance();
        $reservationDao     = ReservationFactory::getInstance();
        $factureDao         = FactureFactory::getInstance();
        
        $dao = new EnsembleReservationService();
        return $dao->initConstruct($reserverService, $reservationDao, $factureDao);
    }
}