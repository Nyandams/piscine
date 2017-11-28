<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EditeurDAO extends CI_Model
{
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
        ->from('Editeur')
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