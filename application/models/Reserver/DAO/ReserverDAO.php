<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ReserverDAO extends CI_Model
{
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