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