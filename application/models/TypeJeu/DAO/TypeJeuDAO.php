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
     * renvoie une collection d' "TypeJeuDTO"
     * @return TypeJeuCollection
     */
    public function getTypeJeux(){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->get()
                             ->result();
        
        $typejeuCollection = new TypeJeuCollection();
        
        foreach($resultat as $element){
            $dto = $this->hydrateFromDatabase($element);
            $typejeuCollection->append($dto);
        }
        
        return $typejeuCollection;
    }
    
    /**
     * sauvegarde un type de jeu dans la BDD
     * @param TypeJeuDTO $typejeuDTO
     */
    public function saveTypeJeu($typejeuDTO){
        $bdd = hydrateFromDTO($typejeuDTO);
        $this->db->set($bdd)
                 ->insert($this->table);
    }
    
    /**
     * Supprime le typejeuDTO de la BDD
     * @param TypeJeuDTO $typejeuDTO
     * @return Boolean
     */
    public function deleteTypeJeu($typejeuDTO){
        $id = $typejeuDTO->getIdTypeJeu();
        return $this->db->where('id', $id)->delete($this->table);
    }
    
    
    public function updateTypeJeu($dto){
        $bdd = hydrateFromDTO($dto);
        
        $this->db->replace($this->table, $bdd);
    }
    
    /**
     * @param int $id
     * @return EditeurDTO
     */
    public function getTypeJeuById($id){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->where('idTypeJeu', $id)
                             ->get();
        
        $dto = hydrateFromDatabase($resultat);
        return $dto;
    }
    
    /**
     * retourne un typejeuCollection contenant les types de jeu pouvant correspondre à $chaineCar
     * @param string $chaineCar
     * @return TypeJeuCollection
     */
    public function listeRechercheTypeJeu($chaineCar){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->like('libelleTypeJeu', $chaineCar)
                             ->get()
                             ->result();
        
        $typejeuCollection = new TypeJeuCollection();
        
        foreach($resultat as $element){
            $dto = $this->hydrateFromDatabase($element);
            $TypeJeuCollection->append($dto);
        }
        
        return $typejeuCollection;
    }
    
     
    /**
     * @param TypeJeuDTO $dto
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

