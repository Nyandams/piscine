<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ReservationDAO extends CI_Model
{
    private $table = 'reservation';
    
    private $correlationTable = array(
        'idReservation'             => 'idReservation',
        'prixNegociationReservation'=> 'prixNegociationReservation',
        'idFestival'                => 'idFestival',
        'idEditeur'                 => 'idEditeur',
        'nbEmplacement'             => 'nbEmplacement'
    );
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Reservation/NotFoundReservationException');
        $this->load->model('Reservation/DTO/ReservationDTO');
        $this->load->model('Reservation/DTO/ReservationCollection');
    }
    
        /**
     * renvoie une collection d' "ReservationDTO"
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
        $bdd = $this->hydrateFromDTO($reservationDTO);
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
        return $this->db->where('idReservation', $id)->delete($this->table);
    }
    
    /**
     * update
     * @param ReservationDTO $dto
     */
    public function updateReservation($dto){
        $bdd = $this->hydrateFromDTO($dto);
        
        $this->db->replace($this->table, $bdd);
    }

        /**
     * @param int $id
     * @return ReservationDTO
     */
    public function getReservationById($id){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->where('idReservation', $id)
                             ->get()
                             ->result();
        
        if(!empty($resultat)){
            $dto = hydrateFromDatabase($resultat[0]);
            return $dto;
        } else {
            throw new NotFoundReservationException();
        }    
    }   
    
    /**
     * renvoie toutes les réservations correspondants à un festival
     * @param int $idFestival
     * @return ReservationCollection
     */
    public function getReservationByIdFestival($idFestival){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->where('idFestival', $idFestival)
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
     * Retourne un ReservationDto comprenant toutes les reservations correspondant a l'idEditeur et l'idFestival passe en parametre
     * @param int $idEditeur
     * @param int $idFestival
     * @return ReservationCollection
     */
    public function getReservationByIdEditeurFestival($idEditeur, $idFestival){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->where('idEditeur', $idEditeur)
                             ->where('idFestival', $idFestival)
                             ->get()
                             ->result();
        
        if(!empty($resultat)){
            $dto = $this->hydrateFromDatabase($resultat[0]);
            return $dto;
        } else {
            throw new NotFoundReservationException();
        }                             
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
}
