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
     * renvoie une collection de ReservationDTO
     * @return ReservationCollection
     */
    public function getReservation(){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->get()
                             ->result();

        $reservationCollection = new ReservationCollection();
        
        foreach($resultat as $element){
            $dto = $this->hydrateFromDatabase($element);
            $reservationCollection->append($dto);
        }

    
        return $reservationCollection;
    }



    /**
     * sauvegarde une reservation dans la BDD
     * @param ReservationDTO $reservationDTO
     */
    public function saveReservation($reservationDTO){
        $bdd = hydrateFromDTO($reservationDTO);
        $this->db->set($bdd)
                 ->insert($this->table);
    }
    
    /**
     * Supprime le reservationDTO de la BDD
     * @param ReservationDTO $reservationDTO
     * @return Boolean
     */
    public function deleteReservation($reservationDTO){
        $id = $reservationDTO->getIdReservation();
        return $this->db->where('id', $id)->delete($this->table);
    }
    
    
    public function updateReservation($dto){
        $bdd = hydrateFromDTO($dto);
        
        $this->db->replace($this->table, $bdd);
    }



    public function getReservationById($id){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->where('idReservation', $id)
                             ->get();
        
        $dto = hydrateFromDatabase($resultat);
        return $dto;
    }



    /**
     * @param ReservationDTO $dto
     * @return array('id' => value)
     */
    private function hydrateFromDTO($dto){
        $bdd = array();
        foreach($this->correlationTable as $getterName => $setterName){
            $getter = 'get'.ucwords($getterName);
            $bdd[$setterName] = $dto->$getter();
        }
        return $bdd;
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