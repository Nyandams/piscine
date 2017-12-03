<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SuiviDAO extends CI_Model
{
    private $correlationTable = array(
        'idSuivi'           => 'idSuivi',
        'typeSuivi'         => 'typeSuivi',
        'dateSuivi'         => 'dateSuivi',
        'commentaireSuivi'  => 'commentaireSuivi'
    );
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Suivi/NotFoundSuiviException');
        $this->load->model('Suivi/DTO/SuiviDTO');
        $this->load->model('Suivi/DTO/SuiviCollection');
    }
    
    
    
    /**
     * passage d'un tableau récupéré en BDD à un dto
     * @param $db
     * @return SuiviDTO
     */
    private function hydrateFromDatabase($db){
        $dto = new SuiviDTO();
        foreach($this->correlationTable as $setterName => $getterName){
            $setter = 'set' .ucwords($setterName);
            $dto->$setter($db->$getterName);
        }
        return $dto;
    }
}