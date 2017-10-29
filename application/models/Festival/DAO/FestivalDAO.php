<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FestivalDAO extends CI_Model
{
    private $correlationTable = array(
        'idFestival'                => 'idFestival',
        'anneeFestival'             => 'anneeFestival',
        'nbEmplacementTotal'        => 'nbEmplacementTotal',
        'prixEmplacementFestival'   => 'prixEmplacementFestival'
    );
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Festival/NotFoundFestivalException');
        $this->load->model('Festival/DTO/FestivalDTO');
    }

    public function getFestivals(){
        $resultat = $this->db->select()
                             ->from('Festival')
                             ->get()
                             ->result();
        
        if (!empty($resultat)){
            $festivalCollection = new FestivalCollection();
            
            foreach($resultat as $festival){
                $dto = $this->hydrateFromDatabase($festival);
                $festivalCollection->append($dto);
            }
        }
        throw new NotFoundFestivalException();
    }
    
    /**
     * passage d'un tableau récupéré en BDD à un dto
     * @param $db
     * @return FestivalDTO
     */
    private function hydrateFromDatabase($db){
        $dto = new FestivalDTO();
        foreach($this->correlationTable as $setterName => $getterName){
            $setter = 'set' .ucwords($setterName);
            $dto->$setter($db->$getterName);
        }
        return $dto;
    }
}