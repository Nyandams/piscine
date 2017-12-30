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
        'renvoiJeuReserver'     => 'renvoiJeuReserver'
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
    
    /**
     * sauvegarde un type de jeu dans la BDD
     * @param ReserverDTO $reserverDTO
     */
    public function saveReserver($reserverDTO){
        $bdd = hydrateFromDTO($reserverDTO);
        $this->db->set($bdd)
        ->insert($this->table);
    }
    
    /**
     * Supprime le reserverDTO de la BDD
     * @param ReserverDTO $reserverDTO
     * @return Boolean
     */
    public function deleteReserver($reserverDTO){
        $id = $reserverDTO->getIdReserver();
        return $this->db->where('id', $id)->delete($this->table);
    }
    
    /**
     * modifie dans la base de donnée
     * @param ReserverDTO $dto
     */
    public function updateReserver($dto){
        $bdd = hydrateFromDTO($dto);
        $this->db->replace($this->table, $bdd);
    }
    
    /**
     * @param int $id
     * @return EditeurDTO
     */
    public function getReserverById($id){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->where('idReserver', $id)
                             ->get()
                             ->result();
        
        if(!empty($resultat)){
            $dto = hydrateFromDatabase($resultat[0]);
            return $dto;
        } else {
            throw new NotFoundReserverException();
        }
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