<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TypeJeuDAO extends CI_Model
{
    private $correlationTable = array(
        'idTypeJeu'         => 'idTypeJeu',
        'libelleTypeJeu'    => 'libelleTypeJeu',
        'idZone'            => 'idZone'
    );
    
    public function __construct(){
        parent::__construct();
        $this->load->model('TypeJeu/NotFoundTypeJeuException');
        $this->load->model('TypeJeu/DTO/TypeJeuDTO');
        $this->load->model('TypeJeu/DTO/TypeJeuCollection');
    }
    
    
    
    /**
     * passage d'un tableau récupéré en BDD à un dto
     * @param $db
     * @return TypeJeuDTO
     */
    private function hydrateFromDatabase($db){
        $dto = new TypeJeuDTO();
        foreach($this->correlationTable as $setterName => $getterName){
            $setter = 'set' .ucwords($setterName);
            $dto->$setter($db->$getterName);
        }
        return $dto;
    }
}