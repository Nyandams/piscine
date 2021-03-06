<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ReserverDAO extends CI_Model
{
    private $table = 'reserver';
    
    private $correlationTable = array(
        'idJeu'                 => 'idJeu',
        'idReservation'         => 'idReservation',
        'quantiteJeuReserver'   => 'quantiteJeuReserver',
        'dotationJeuReserver'   => 'dotationJeuReserver',
        'receptionJeuReserver'  => 'receptionJeuReserver',
        'renvoiJeuReserver'     => 'renvoiJeuReserver',
        'idZone'                => 'idZone'
    );
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Reserver/NotFoundReserverException');
        $this->load->model('Reserver/DTO/ReserverDTO');
        $this->load->model('Reserver/DTO/ReserverCollection');
    }
    
    
    /**
     * renvoie une collection d' "ReserverDTO"
     * @return ReserverCollection
     */
    public function getReserver(){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->get()
                             ->result();
        
        $reserverCollection = new ReserverCollection();
        
        foreach($resultat as $element){
            $dto = $this->hydrateFromDatabase($element);
            $reserverCollection->append($dto);
        }
        
        return $reserverCollection;
    }
    
    public function suppReserverByIdJeu($idJeu) {
        $this->db->where('idJeu', $idJeu)
        ->delete($this->table);
    }
    
    /**
     * renvoie une collection d' "ReserverDTO"
     * @return ReserverCollection
     */
    public function getReserverByZone($idZone){
        $resultat = $this->db->select()
        ->from($this->table)
        ->where("idZone", $idZone)
        ->get()
        ->result();
        
        $reserverCollection = new ReserverCollection();
        
        foreach($resultat as $element){
            $dto = $this->hydrateFromDatabase($element);
            $reserverCollection->append($dto);
        }
        
        return $reserverCollection;
    }
    
    /**
     * sauvegarde un reserver dans la BDD
     * @param ReserverDTO $reserverDTO
     */
    public function saveReserver($reserverDTO){
        $bdd = $this->hydrateFromDTO($reserverDTO);
        $this->db->set($bdd)
                 ->insert($this->table);
        echo ("salut");
    }
    
    /**
     * Supprime le reserverDTO de la BDD
     * @param ReserverDTO $reserverDTO
     * @return Boolean
     */
    public function deleteReserver($reserverDTO){
        $idReservation = $reserverDTO->getIdReservation();
        $idJeu         = $reserverDTO->getIdJeu();
        
        return $this->db->where('idReservation', $idReservation)
                        ->where('idJeu', $idJeu)
                        ->delete($this->table);
    }
    

    
    /**
     * modifie dans la base de donnée
     * @param ReserverDTO $dto
     */
    public function updateReserver($dto){
        $bdd = $this->hydrateFromDTO($dto);
        $this->db->replace($this->table, $bdd);
    }
    
    /**
     * retourne tous les réserver ayant pour idReservation : $idReservation
     * @param int $idReservation
     * @return ReserverCollection
     */
    public function getReserverByIdReservation($idReservation){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->where('idReservation', $idReservation)
                             ->get()
                             ->result();
        
        $reserverCollection = new ReserverCollection();
        
        foreach($resultat as $element){
            $dto = $this->hydrateFromDatabase($element);
            $reserverCollection->append($dto);
        }        
        return $reserverCollection;
    }
    
    // Renvoie le reserverDTO d'un jeu
    public function getReserverByIdJeu($idJeu) {
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->where('idJeu', $idJeu)
                             ->get()
                             ->result();
        
        return $this->hydrateFromDatabase($resultat[0]);
    }
    
    
    
    
    /**
     * passage d'un tableau récupéré en BDD à un dto
     * @param $db
     * @return ReserverDTO
     */
    private function hydrateFromDatabase($db){
        $dto = new ReserverDTO();
        foreach($this->correlationTable as $setterName => $getterName){
            $setter = 'set' .ucwords($setterName);
            $dto->$setter($db->$getterName);
        }
        return $dto;
    }
    
    /**
     * @param ReserverDTO $dto
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