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
        'telephoneContact'      => 'telephoneContact',
        'rueContact'            => 'rueContact',
        'villeContact'          => 'villeContact',
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
        return $this->db->where('idContact', $id)->delete($this->table);
    }
    
    /**
     * Modifie le contactDTO dans la BDD
     * @param ContactDTO $editeurDTO
     */
    public function updateContact($dto){
        $bdd = hydrateFromDTO($dto);
        
        $this->db->replace($this->table, $bdd);
    }
    
    /**
     * @param int $id
     * @return ContactDTO
     */
    public function getContactById($id){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->where('idContact', $id)
                             ->get()
                             ->result();
                             
        
        $dto = $this->hydrateFromDatabase($resultat[0]);
        return $dto;
    }
    
    // Renvoie le contact principale sous forme de dto, de l'editeur passé en argument.
    public function getContactEditeurPrincipal($idEditeur){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->where('idEditeur', $idEditeur)
                             ->where('estPrincipalContact', 1)
                             ->get();
        print_r($resultat);
        $dto = $this->hydrateFromDatabase($resultat[0]);
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
            $dto->$setter(
                $db->$getterName);
        }
        
        return $dto;
    }
}

