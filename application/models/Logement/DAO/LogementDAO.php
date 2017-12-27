<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LogementDAO extends CI_Model
{
    private $correlationTable = array(
        'idLogement'        => 'idLogement',
        'prixNuitLogement'  => 'prixNuitLogement',
        'nbMaxPlaceLogement'=> 'nbMaxPlaceLogement',
        'rueLogement'       => 'rueLogement',
        'villeLogement'     => 'villeLogement',
        'cpLogement'        => "cpLogement"
    );
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Logement/NotFoundLogementException');
        $this->load->model('Logement/DTO/LogementDTO');
        $this->load->model('Logement/DTO/LogementCollection');
    }
    
    
    
    /**
     * passage d'un tableau récupéré en BDD à un dto
     * @param $db
     * @return LogementDTO
     */
    private function hydrateFromDatabase($db){
        $dto = new LogementDTO();
        foreach($this->correlationTable as $setterName => $getterName){
            $setter = 'set' .ucwords($setterName);
            $dto->$setter($db->$getterName);
        }
        return $dto;
    }
    
    /**
     * @param LogementDTO $dto
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