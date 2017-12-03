<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ReservationDAO extends CI_Model
{
    private $correlationTable = array(
        'idReservation'             => 'idReservation',
        'prixNegociationReservation'=> 'prixNegociationReservation',
        'idFestival'                => 'idFestival',
        'idEditeur'                 => 'idEditeur'
    );
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Reservation/NotFoundReservationException');
        $this->load->model('Reservation/DTO/ReservationDTO');
        $this->load->model('Reservation/DTO/ReservationCollection');
    }
    
    
    
    /**
     * passage d'un tableau récupéré en BDD à un dto
     * @param $db
     * @return ReservationDTO
     */
    private function hydrateFromDatabase($db){
        $dto = new ReservationDTO();
        foreach($this->correlationTable as $setterName => $getterName){
            $setter = 'set' .ucwords($setterName);
            $dto->$setter($db->$getterName);
        }
        return $dto;
    }
}