<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LocaliserDAO extends CI_Model
{
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