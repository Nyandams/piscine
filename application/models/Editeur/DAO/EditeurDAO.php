<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EditeurDAO extends CI_Model
{
    private $table = 'Editeur';
    
    private $correlationTable = array(
        'idEditeur'         => 'idEditeur',
        'libelleEditeur'    => 'libelleEditeur'       
    );
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Editeur/NotFoundEditeurException');
        $this->load->model('Editeur/DTO/EditeurDTO');
        $this->load->model('Editeur/DTO/EditeurCollection');
    }
    
    /**
     * renvoi tous les Editeurs
     * @throws NotFoundEditeurException
     * @return EditeurCollection
     */
    public function getEditeurs(){
        $resultat = $this->db->select()
        ->from($this->table)
        ->get()
        ->result();
        
        if (!empty($resultat)){
            $editeurCollection = new EditeurCollection();
            
            foreach($resultat as $element){
                $dto = $this->hydrateFromDatabase($element);
                $EditeurCollection->append($dto);
            }
            
            return $editeurCollection;
        }
        throw new NotFoundEditeurException();
    }

    public function saveEditeur($editeurDTO){
        $bdd = hydrateFromDTO($editeurDTO);
        $this->db->set($bdd)
                 ->insert($this->table);
    }
     
    /**
     * @param EditeurDTO $dto
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
     * @return EditeurDTO
     */
    private function hydrateFromDatabase($db){
        $dto = new EditeurDTO();
        foreach($this->correlationTable as $setterName => $getterName){
            $setter = 'set' .ucwords($setterName);
            $dto->$setter($db->$getterName);
        }
        return $dto;
    }
}