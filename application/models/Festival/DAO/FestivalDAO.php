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

    /**
     * renvoi tous les festivals
     * @throws NotFoundFestivalException
     * @return FestivalCollection
     */
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
            return $festivalCollection;
        }
        throw new NotFoundFestivalException();
    }
    

     /**
     * sauvegarde un festival dans la BDD
     * @param FestivalDTO $festivalDTO
     */
    public function saveFestival($festivalDTO){
        $bdd = hydrateFromDTO($festivalDTO);
        $this->db->set($bdd)
                 ->insert($this->table);
    }
    

   
    /**
     * Supprime le festivalDTO de la BDD
     * @param FestivalDTO $festivalDTO
     * @return Boolean
     */
    public function deleteFestival($festivalDTO){
        $id = $festivalDTO->getIdFestival();
        return $this->db->where('id', $id)->delete($this->table);
    }
    
    
    public function updateFestival($dto){
        $bdd = hydrateFromDTO($dto);
        
        $this->db->update_batch($this->table, $bdd, 'idFestival');
    }
    
    /**
     * @param int $id
     * @return FestivalDTO
     */
    public function getFestivalById($id){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->where('idFestival', $id)
                             ->get();
        
        $dto = hydrateFromDatabase($resultat);
        return $dto;
    }
    
    /**
     * retourne un festivalCollection contenant les festivals pouvant correspondre à $chaineCar (recherche par année)
     * @param string $chaineCar
     * @return FestivalCollection
     */
    public function listeRechercheFestival($chaineCar){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->like('anneeFestival', $chaineCar)
                             ->get()
                             ->result();
        
        $festivalCollection = new FestivalCollection();
        
        foreach($resultat as $element){
            $dto = $this->hydrateFromDatabase($element);
            $FestivalCollection->append($dto);
        }
        
        return $festivalCollection;
    }
    
     
    /**
     * @param FestivalDTO $dto
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