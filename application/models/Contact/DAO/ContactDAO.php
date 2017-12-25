<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ContactDAO extends CI_Model
{
    private $correlationTable = array(
        'idContact'             => 'idContact',
        'estPrincipalContact'   => 'estPrincipalContact',
        'nomContact'            => 'nomContact',
        'prenomContact'         => 'prenomContact',
        'mailContact'           => 'mailContact',
        'rueContact'            => 'rueContact',
        'villeContact'          => 'rueContact',
        'cpContact'             => 'cpContact',
        'idEditeur'             => 'idEditeur'
    );
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Contact/NotFoundContactException');
        $this->load->model('Contact/DTO/ContactDTO');
        $this->load->model('Contact/DTO/ContactCollection');
    }
    
    /**
     * renvoi tous les Contacts
     * @throws NotFoundContactException
     * @return ContactCollection
     */
    public function getContacts(){
        $resultat = $this->db->select()
        ->from('Contact')
        ->get()
        ->result();
        
        if (!empty($resultat)){
            $contactCollection = new ContactCollection();
            
            foreach($resultat as $element){
                $dto = $this->hydrateFromDatabase($element);
                $EditeurCollection->append($dto);
            }
            
            return $contactCollection;
        }
        throw new NotFoundContactException();
    }


   /**
     * sauvegarde un contact dans la BDD
     * @param ContactDTO $ContactDTO
     */
    public function saveContact($ContactDTO){
        $bdd = hydrateFromDTO($ContactDTO);
        $this->db->set($bdd)
                 ->insert($this->table);
    }
    
    /**
     * Supprime l'contactDTO de la BDD
     * @param ContactDTO $contactDTO
     * @return Boolean
     */
    public function deleteContact($contactDTO){
        $id = $contactDTO->getIdContact();
        return $this->db->where('id', $id)->delete($this->table);
    }
    
    
    public function updateContact($dto){
        $bdd = hydrateFromDTO($dto);
        
        $this->db->update_batch($this->table, $bdd, 'idContact');
    }
    
    /**
     * @param int $id
     * @return ContactDTO
     */
    public function getContactById($id){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->where('idContact', $id)
                             ->get();
        
        $dto = hydrateFromDatabase($resultat);
        return $dto;
    }
    
    /**
     * retourne un contactCollection contenant les contact pouvant correspondre à $chaineCar
     * @param string $chaineCar
     * @return ContactCollection
     */
    public function listeRechercheContact($chaineCar){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->like('libelleContact', $chaineCar)
                             ->get()
                             ->result();
        
        $contactCollection = new ContactCollection();
        
        foreach($resultat as $element){
            $dto = $this->hydrateFromDatabase($element);
            $ContactCollection->append($dto);
        }
        
        return $contactCollection;
    }
    
     
    /**
     * @param ContactDTO $dto
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
     * @return ContactDTO
     */
    private function hydrateFromDatabase($db){
        $dto = new ContactDTO();
        foreach($this->correlationTable as $setterName => $getterName){
            $setter = 'set' .ucwords($setterName);
            $dto->$setter($db->$getterName);
        }
        return $dto;
    }
}

