<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class JeuDAO extends CI_Model
{
    private $correlationTable = array(
        'idJeu'             => 'idJeu',
        'libelleJeu'        => 'libelleJeu',
        'nbMinJoueurJeu'    => 'nbMinJoueurJeu',
        'nbMaxJoueurJeu'    => 'nbMaxJoueurJeu',
        'noticeJeu'         => 'noticeJeu',
        'idEditeur'         => 'idEditeur',
        'idTypeJeu'         => 'idTypeJeu'
    );
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Jeu/NotFoundJeuException');
        $this->load->model('Jeu/DTO/JeuDTO');
        $this->load->model('Jeu/DTO/JeuCollection');
    }
    

    
    /**
     * renvoie une collection d' "JeuDTO"
     * @return JeuCollection
     */
    public function getJeux(){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->get()
                             ->result();
        
        $jeuCollection = new JeuCollection();
        
        foreach($resultat as $element){
            $dto = $this->hydrateFromDatabase($element);
            $jeuCollection->append($dto);
        }
        
        return $jeuCollection;
    }
    
    /**
     * sauvegarde un jeu dans la BDD
     * @param JeuDTO $jeuDTO
     */
    public function saveJeu($jeuDTO){
        $bdd = hydrateFromDTO($jeuDTO);
        $this->db->set($bdd)
                 ->insert($this->table);
    }
    
    /**
     * Supprime le jeuDTO de la BDD
     * @param JeuDTO $jeuDTO
     * @return Boolean
     */
    public function deleteJeu($jeuDTO){
        $id = $jeuDTO->getIdjeu();
        return $this->db->where('id', $id)->delete($this->table);
    }
    
    
    public function updateJeu($dto){
        $bdd = hydrateFromDTO($dto);
        
        $this->db->update_batch($this->table, $bdd, 'idJeu');
    }
    
    /**
     * @param int $id
     * @return JeuDTO
     */
    public function getJeuById($id){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->where('idJeu', $id)
                             ->get();
        
        $dto = hydrateFromDatabase($resultat);
        return $dto;
    }
    
    /**
     * retourne un jeuCollection contenant les jeux pouvant correspondre à $chaineCar
     * @param string $chaineCar
     * @return JeuCollection
     */
    public function listeRechercheJeu($chaineCar){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->like('libelleJeu', $chaineCar)
                             ->get()
                             ->result();
        
        $jeuCollection = new JeuCollection();
        
        foreach($resultat as $element){
            $dto = $this->hydrateFromDatabase($element);
            $JeuCollection->append($dto);
        }
        
        return $jeuCollection;
    }
    
     
    /**
     * @param JeuDTO $dto
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
     * @return JeuDTO
     */
    private function hydrateFromDatabase($db){
        $dto = new JeuDTO();
        foreach($this->correlationTable as $setterName => $getterName){
            $setter = 'set' .ucwords($setterName);
            $dto->$setter($db->$getterName);
        }
        return $dto;
    }
}