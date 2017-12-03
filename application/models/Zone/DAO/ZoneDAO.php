<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ZoneDAO extends CI_Model
{
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