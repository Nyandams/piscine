<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FactureDAO extends CI_Model
{
    private $correlationTable = array(
        'idFacture'             => 'idFacture',
        'dateEmissionFacture'   => 'dateEmissionFacture',
        'datePaiementFacture'   => 'datePaiementFacture',
        'idReservation'         => 'idReservation'
    );
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Facture/NotFoundFactureException');
        $this->load->model('Facture/DTO/FactureDTO');
        $this->load->model('Facture/DTO/FactureCollection');
    }
    
    
 
    /**
     * passage d'un tableau récupéré en BDD à un dto
     * @param $db
     * @return FactureDTO
     */
    private function hydrateFromDatabase($db){
        $dto = new FactureDTO();
        foreach($this->correlationTable as $setterName => $getterName){
            $setter = 'set' .ucwords($setterName);
            $dto->$setter($db->$getterName);
        }
        return $dto;
    }
}