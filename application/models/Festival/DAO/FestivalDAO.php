<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FestivalDAO extends CI_Model
{
    private $correlationTable = array(
        'idFestival'                => 'idFestival',
        'anneeFestival'             => 'anneeFestival',
        'nbEmplacementTotal'        => 'nbEmplacementTotal',
        'prixEmplacementFestival'   => 'prixEmplacementFestival'
    );
    
    private $table = "Festival";
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Festival/NotFoundFestivalException');
        $this->load->model('Festival/DTO/FestivalDTO');
        $this->load->model('Festival/DTO/FestivalCollection');
    }

    /**
     * renvoi tous les festivals
     * @throws NotFoundFestivalException
     * @return FestivalCollection
     */
    public function getFestivals(){
        $resultat = $this->db->select()
                             ->from('Festival')
                             ->order_by('anneeFestival', 'desc')
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
        return new FestivalCollection();
    }
    
    /**
     * renvoie le festival le plus récent
     * @return FestivalCollection
     * @throws NotFoundFestivalException
     */
    public function getFestivalActuel(){
        $festivalCollection = $this->getFestivals();
        if(!empty($festivalCollection)){
            return $festivalCollection->offsetGet(0);
        } else {
            throw new NotFoundFestivalException();
        }
    }
    

     /**
     * sauvegarde un festival dans la BDD
     * @param FestivalDTO $festivalDTO
     */
    public function saveFestival($festivalDTO){
        $bdd = $this->hydrateFromDTO($festivalDTO);
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
        $bdd = $this->hydrateFromDTO($dto);
        
        $this->db->replace($this->table, $bdd);
    }
    
    /**
     * @param int $id
     * @return FestivalDTO
     */
    public function getFestivalById($id){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->where('idFestival', $id)
                             ->get()
                             ->result();
        
        if(!empty($resultat)){
            $dto = $this->hydrateFromDatabase($resultat[0]);
            return $dto;
        } else {
            throw new NotFoundFestivalException();
        }
        
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