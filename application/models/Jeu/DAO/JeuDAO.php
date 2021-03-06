<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class JeuDAO extends CI_Model
{
    private $table = 'jeu';

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
        $bdd = $this->hydrateFromDTO($jeuDTO);
        $this->db->set($bdd)
                 ->insert($this->table);
    }
    
    /**
     * Supprime le jeuDTO de la BDD
     * @param JeuDTO $jeuDTO
     * @return Boolean
     */
    public function deleteJeu($jeuDTO){
        $id = $jeuDTO->getIdJeu();
        return $this->db->where('idJeu', $id)->delete($this->table);
    }
    
    
    public function updateJeu($dto){
        $bdd = $this->hydrateFromDTO($dto);
        
        $this->db->replace($this->table, $bdd);
    }
    
    /**
     * @param int $id
     * @return JeuDTO
     */
    public function getJeuById($id){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->where('idJeu', $id)
                             ->get()
                             ->result();
        
        
        if (!empty($resultat)) {
            return $this->hydrateFromDatabase($resultat[0]);
        }
        else {
            throw new NotFoundJeuException();
        }
        
       
    }
    
    /**
     * Renvoie tout les jeux d'un éditeur 
     * @param id $idEditeur
     * @return JeuCollection
     */
    public function getJeuByIdEditeur ($idEditeur) {
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->where('idEditeur', $idEditeur)
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
     * retourne le dernier festival créée dans la BDD
     * @return EditeurDTO
     */
    public function getLastIdJeu(){
        $resultat = $this->db->select()
        ->from($this->table)
        ->order_by('idjeu', 'desc')
        ->get()
        ->result();
        
        if (!empty($resultat)){
            $dto = $this->hydrateFromDatabase($resultat[0]);
            return $dto;
        } else {
            throw new NotFoundJeuException();
        }
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