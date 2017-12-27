<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HebergementDAO extends CI_Model
{
    private $correlationTable = array(
        'idLogement'            => 'idLogement',
        'idEditeur'             => 'idEditeur',
        'nbNuitHebergement'     => 'nbNuitHebergement',
        'nbPersonneHebergement' => 'nbPersonneHebergement',
        'nomResponsable'        => 'nomResponsable',
        'prenomResponsable'     => 'prenomResponsable'
    );
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Hebergement/NotFoundHebergementException');
        $this->load->model('Hebergement/DTO/HebergementDTO');
        $this->load->model('Hebergement/DTO/HebergementCollection');
    }
    
    
    /**
     * @param HebergementDTO $dto
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
     * @return HebergementDTO
     */
    private function hydrateFromDatabase($db){
        $dto = new HebergementDTO();
        foreach($this->correlationTable as $setterName => $getterName){
            $setter = 'set' .ucwords($setterName);
            $dto->$setter($db->$getterName);
        }
        return $dto;
    }
}