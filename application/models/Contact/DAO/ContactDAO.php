<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ContactDAO extends CI_Model
{
    private $table = 'contact';

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
     * renvoie une collection de contactDTO
     * @return ContactCollection
     */
    public function getContact(){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->get()
                             ->result();
        



        $contactCollection = new ContactCollection();
        
        foreach($resultat as $element){
            $dto = $this->hydrateFromDatabase($element);
            $contactCollection->append($dto);
        }
        return $contactCollection;
    }


    /**
     * sauvegarde un contact dans la BDD
     * @param ContactDTO $contactDTO
     */
    public function saveContact($contactDTO){
        $bdd = $this->hydrateFromDTO($contactDTO);
        $this->db->set($bdd)
                 ->insert($this->table);
    }


    /**
     * Supprime contactDTO de la BDD
     * @param ContactDTO $contactDTO
     */
    public function deleteContact($contactDTO){
        $id = $contactDTO->getIdContact();
        return $this->db->where('id', $id)->delete($this->table);
    }
    
    /**
     * Modifie le contactDTO dans la BDD
     * @param ContactDTO $editeurDTO
     */
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
     * @param ContactDTO $dto
     * @return array('id' => value)
     */
    private function hydrateFromDTO($dto){
        $bdd = array();
        foreach($this->correlationTable as $getterName => $setterName){
            # ucwords met la 1ere lettre d'un string en majuscule
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