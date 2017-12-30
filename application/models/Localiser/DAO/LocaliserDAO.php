<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LocaliserDAO extends CI_Model
{
    private $table = 'localiser';
    
    private $correlationTable = array(
        'idZone'            => 'idZone',
        'idReservation'     => 'idReservation',
        'nbEmplacement'     => 'nbEmplacement'
    );
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Localiser/NotFoundLocaliserException');
        $this->load->model('Localiser/DTO/LocaliserDTO');
        $this->load->model('Localiser/DTO/LocaliserCollection');
    }
    
    /**
     * renvoie une collection de LocaliserDTO
     * @return FactureCollection
     */
    public function getLocaliser(){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->get()
                             ->result();
        
        $factureCollection = new LocaliserCollection();
        
        foreach($resultat as $element){
            $dto = $this->hydrateFromDatabase($element);
            $factureCollection->append($dto);
        }
        
        return $factureCollection;
    }
    
    /**
     * sauvegarde un localiserDTO dans la BDD
     * @param LocaliserDTO $localiserDTO
     */
    public function saveLocaliser($localiserDTO){
        $bdd = hydrateFromDTO($localiserDTO);
        $this->db->set($bdd)
                 ->insert($this->table);
    }
    
    /**
     * Supprime le localiserDTO de la BDD
     * @param localiserDTO $localiserDTO
     * @return Boolean
     */
    public function deleteLocaliser($localiserDTO){
        $idReservation  = $localiserDTO->getIdReservation();
        $idZone         = $localiserDTO->getIdZone();
        return $this->db->where('idReservation', $idReservation)->where('idZone', $idZone)->delete($this->table);
    }
    
    /**
     * @param LocaliserDTO $dto
     */
    public function updateLocaliser($dto){
        $bdd = hydrateFromDTO($dto);
        
        $this->db->replace($this->table, $bdd);
    }
    
    
    /**
     * renvoie le localiserDTO correspondant à un idReservation
     * @param int $id
     * @return LocaliserDTO
     */
    public function getLocaliserByIdReservation($id){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->where('idReservation', $id)
                             ->get()
                             ->result();
        
        if(!empty($resultat)){
            $dto = hydrateFromDatabase($resultat[0]);
            return $dto;
        } else {
            throw new NotFoundLocaliserException();
        }
    }
    
    
    /**
     * passage d'un tableau récupéré en BDD à un dto
     * @param $db
     * @return LocaliserDTO
     */
    private function hydrateFromDatabase($db){
        $dto = new LocaliserDTO();
        foreach($this->correlationTable as $setterName => $getterName){
            $setter = 'set' .ucwords($setterName);
            $dto->$setter($db->$getterName);
        }
        return $dto;
    }
    
    /**
     * @param LocaliserDTO $dto
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