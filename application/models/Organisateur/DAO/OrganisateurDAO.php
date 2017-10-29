<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OrganisateurDAO extends CI_Model
{
    
    private $correlationTable = array(
        'idOrganisateur'            => 'idOrganisateur',
        'loginOrganisateur'         => 'loginOrganisateur',
        'motDePasseOrganisateur'    => 'motDePasseOrganisateur',
        'nomOrganisateur'           => 'nomOrganisateur',
        'prenomOrganisateur'        => 'prenomOrganisateur'
    );
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Organisateur/NotFoundOrganisateurException');
        $this->load->model('Organisateur/DTO/OrganisateurDTO');
    }
    
    /**
     * @param string $login
     * @return OrganisateurDTO
     */
    public function getOrganisateurByLogin($login){
        $resultat = $this->db->select()
                             ->from('organisateur')
                             ->where('loginOrganisateur', $login)
                             ->limit(1)
                             ->get()
                             ->result();
        
      
        if(!empty($resultat)){
            $dto = $this->hydrateFromDatabase($resultat[0]);

            return $dto;
        }
        throw new NotFoundOrganisateurException();
    }
    
    /**
     * @param string $login
     * @param string $mdp
     * @return boolean
     */
    public function connexionOrganisateur($login, $mdp){
        try{
            $organisateurDto = $this->getOrganisateurByLogin($login);
        }catch(NotFoundOrganisateurException $e){
            return false;
        }
        
        //ajouter md5
        if($mdp == $organisateurDto->getMotDePasseOrganisateur()){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * passage d'un tableau récupéré en BDD à un dto 
     * @param $db
     * @return OrganisateurDTO
     */
    private function hydrateFromDatabase($db){
        $dto = new OrganisateurDTO();
        foreach($this->correlationTable as $setterName => $getterName){
            $setter = 'set' .ucwords($setterName);
            $dto->$setter($db->$getterName);
        }
        return $dto;
    }
}