<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OrganisateurDAO extends CI_Model
{
    
    private $table = 'organisateur';
    
    private $correlationTable = array(
        'idOrganisateur'            => 'idOrganisateur',
        'loginOrganisateur'         => 'loginOrganisateur',
        'motDePasseOrganisateur'    => 'motDePasseOrganisateur',
        'admin'                     => 'admin',
        'nomOrganisateur'           => 'nomOrganisateur',
        'prenomOrganisateur'                    => 'prenomOrganisateur'
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
                             ->from($this->table)
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
    
    
    // Renvoie tout les organisateurs.
    public function getOrganisateurs(){
        $resultat = $this->db->select()
        ->from($this->table)
        ->get()
        ->result();
        
        $orgaCollection = new OrganisateurCollection();
        
        foreach($resultat as $element){
            $dto = $this->hydrateFromDatabase($element);
            $orgaCollection->append($dto);
        }
        
        return $orgaCollection;
        
        
    }
    
    
    /**
     * sauvegarde un organisateur dans la BDD
     * @param OrganisateurDTO $organisateurDTO
     * @return boolean
     */
    public function saveOrganisateur($organisateurDTO){
        try{
            $oldOrgaDTO = $this->getOrganisateurByLogin($login);
            return false;
        } catch(Exception $e) {
            $organisateurDTO->setMotDePasseOrganisateur(md5($organisateurDTO->getMotDePasseOrganisateur()));
            $bdd = $this->hydrateFromDTO($organisateurDTO);
            
            $this->db->set($bdd)
                     ->insert($this->table);
            return true;
        }  
    }
    
    /**
     * Supprime OrganisateurDTO de la BDD
     * @param OrganisateurDTO $organisateurDTO
     */
    public function deleteOrganisateur($organisateurDTO){
        $id = $organisateurDTO->getIdOrganisateur();
        return $this->db->where('idOrganisateur', $id)->delete($this->table);
    }
    
    /**
     * Modifie OrganisateurDTO dans la BDD
     * @param OrganisateurDTO $organisateurDTO
     */
    public function updateOrganisateur($dto){
        $bdd = $this->hydrateFromDTO($dto);
        
        $this->db->replace($this->table, $bdd);
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
        if(md5($mdp) == $organisateurDto->getMotDePasseOrganisateur()){
            if ($organisateurDto->getAdmin() == 1){
                $this->session->set_userdata('admin', 1);
            }else{
                $this->session->set_userdata('admin', 0);
                
            }
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
    
    /**
     * @param OrganisateurDTO $dto
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
}