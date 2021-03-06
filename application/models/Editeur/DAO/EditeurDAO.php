<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EditeurDAO extends CI_Model
{
    private $table = 'editeur';
    
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
     * renvoie une collection d' "EditeurDTO"
     * @return EditeurCollection
     */
    public function getEditeurs(){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->get()
                             ->result();
        
        $editeurCollection = new EditeurCollection();
        
        foreach($resultat as $element){
            $dto = $this->hydrateFromDatabase($element);
            $editeurCollection->append($dto);
        }
        
        return $editeurCollection;
    }
    
    /**
     * retourne le dernier festival créée dans la BDD
     * @return EditeurDTO
     */
    public function getLastIdEditeur(){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->order_by('idEditeur', 'desc')
                             ->get()
                             ->result();
        
        if (!empty($resultat)){
            $dto = $this->hydrateFromDatabase($resultat[0]);
            return $dto;
        } else {
            throw new NotFoundEditeurException();
        }
    }
    
    /**
     * sauvegarde un editeur dans la BDD
     * @param EditeurDTO $editeurDTO
     */
    public function saveEditeur($editeurDTO){
        $bdd = $this->hydrateFromDTO($editeurDTO);
        $this->db->set($bdd)
                 ->insert($this->table);
    }
    
    /**
     * Supprime l'editeurDTO de la BDD
     * @param EditeurDTO $editeurDTO
     */
    public function deleteEditeur($editeurDTO){
        $id = $editeurDTO->getIdEditeur();
        return $this->db->where('idEditeur', $id)->delete($this->table);
    }
    
    /**
     * Modifie l'editeurDTO dans la BDD
     * @param EditeurDTO $editeurDTO
     */
    public function updateEditeur($dto){
        $bdd = $this->hydrateFromDTO($dto);
        
        $this->db->replace($this->table, $bdd);
    }
    
    /**
     * @param int $id
     * @return EditeurDTO
     */
    public function getEditeurById($id){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->where('idEditeur', $id)
                             ->get()
                             ->result();
        
        if(!empty($resultat)){
            $dto = $this->hydrateFromDatabase(current($resultat));
            return $dto;
        } else {
            throw new NotFoundEditeurException();
        }
        
        
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
     * passage d'une ligne de tableau récupéré en BDD à un dto
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