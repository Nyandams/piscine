<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class contactDAO extends CI_Model
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
        $this->load->model('Editeur/Contact/NotFoundContactException');
        $this->load->model('Editeur/Contact/DTO/ContactDTO');
        $this->load->model('Editeur/Contact/DTO/ContactCollection');
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
     * passage d'un tableau récupéré en BDD à un dto
     * @param $db
     * @return EditeurDTO
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