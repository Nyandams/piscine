<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ZoneDAO extends CI_Model
{
    private $table = 'zone';
    
    private $correlationTable = array(
        'idZone'    => 'idZone',
        'nomZone'   => 'nomZone',
        'idEditeur' => 'idEditeur'
    );
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Zone/NotFoundZoneException');
        $this->load->model('Zone/DTO/ZoneDTO');
        $this->load->model('Zone/DTO/ZoneCollection');
    }
    
    /**
     * renvoie une collection d' "ZoneDTO"
     * @return ZoneCollection
     */
    public function getZones(){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->get()
                             ->result();
        
        $zoneCollection = new ZoneCollection();
        
        foreach($resultat as $element){
            $dto = $this->hydrateFromDatabase($element);
            $zoneCollection->append($dto);
        }
        
        return $zoneCollection;
    }
    
    /**
     * sauvegarde une zone dans la BDD
     * @param ZoneDTO $zoneDTO
     */
    public function saveZone($zoneDTO){
        $bdd = hydrateFromDTO($zoneDTO);
        $this->db->set($bdd)
                 ->insert($this->table);
    }
    
    /**
     * Supprime le zoneDTO de la BDD
     * @param ZoneDTO $zoneDTO
     * @return Boolean
     */
    public function deleteZone($zoneDTO){
        $id = $zoneDTO->getIdZone();
        return $this->db->where('idZone', $id)->delete($this->table);
    }
    
    /**
     * remplace dans le $dto dans la BDD
     * @param ZoneDTO $dto
     */
    public function updateZone($dto){
        $bdd = hydrateFromDTO($dto);
        
        $this->db->replace($this->table, $bdd);
    }
    
    /**
     * @param int $id
     * @return ZoneDTO
     */
    public function getZoneById($id){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->where('idZone', $id)
                             ->get()
                             ->result();
        
        if(!empty($resultat)){
            $dto = hydrateFromDatabase($resultat[0]);
            return $dto;
        } else {
            throw new NotFoundZoneException();
        }
    }
    


    /**
     * @param ZoneDTO $dto
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
     * @return ZoneDTO
     */
    private function hydrateFromDatabase($db){
        $dto = new ZoneDTO();
        foreach($this->correlationTable as $setterName => $getterName){
            $setter = 'set' .ucwords($setterName);
            $dto->$setter($db->$getterName);
        }
        return $dto;
    }
}

