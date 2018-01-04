<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SuiviDAO extends CI_Model
{
    private $table = 'suivi';
    
    private $correlationTable = array(
        'idEditeur'         => 'idEditeur',
        'idFestival'        => 'idFestival',
        'premierContact'    => 'premierContact',
        'secondContact'     => 'secondContact',
        'presenceEditeur'   => 'presenceEditeur',
        'commentaireSuivi'  => 'commentaireSuivi',
        'logementSuivi'     => 'logementSuivi'
    );
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Suivi/NotFoundSuiviException');
        $this->load->model('Suivi/DTO/SuiviDTO');
        $this->load->model('Suivi/DTO/SuiviCollection');
    }
    
    /**
     * renvoie une collection de SuiviDTO
     * @return SuiviCollection
     */
    public function getSuivi(){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->get()
                             ->result();
        
        $suiviCollection = new SuiviCollection();
        
        foreach($resultat as $element){
            $dto = $this->hydrateFromDatabase($element);
            $reserverCollection->append($dto);
        }
        
        return $suiviCollection;
    }
    
    /**
     * sauvegarde un suivi dans la BDD
     * @param suiviDTO $suiviDTO
     */
    public function saveSuivi($suiviDTO){
        $bdd = $this->hydrateFromDTO($suiviDTO);
        $this->db->set($bdd)
                 ->insert($this->table);
    }
    
    /**
     * Supprime le suiviDTO de la BDD
     * @param SuiviDTO $suiviDTO
     * @return Boolean
     */
    public function deleteSuivi($SuiviDTO){
        $idEditeur  = $SuiviDTO->getIdEditeur();
        $idFestival = $SuiviDTO->getIdFestival();
        
        return $this->db->where('idFestival', $idFestival)
                        ->where('idEditeur', $idEditeur)
                        ->delete($this->table);
    }
    
    /**
     * retourne le suivi correspondant à un editeur et à un festival
     * @param unknown $idEditeur
     * @param unknown $idFestival
     * @return SuiviDTO
     * @throws NotFoundSuiviException
     */
    public function getSuiviByIdEditeurFestival($idEditeur, $idFestival){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->where('idEditeur', $idEditeur)
                             ->where('idFestival', $idFestival)
                             ->get()
                             ->result();
        
        if(!empty($resultat)){
            $dto = $this->hydrateFromDatabase($resultat[0]);
            return $dto;
        } else {
            throw new NotFoundSuiviException();
        }
    }
    
    /**
     * modifie dans la base de donnée
     * @param ReserverDTO $dto
     */
    public function updateSuivi($dto){
        $bdd = $this->hydrateFromDTO($dto);
        print_r ($bdd);
        $this->db->replace($this->table, $bdd);
    }
    
   
    /**
    * renvoie tous les idSuivi d'un festival
    * @param int $idFestival
    * @return SuiviCollection
    */
    public function getSuiviByIdFestival($idFestival){
        $resultat = $this->db->select()  
                             ->from($this->table)
                             ->where('idFestival', $idFestival)
                             ->get()
                             ->result();
        
        $suiviCollection = new SuiviCollection();
        
        foreach($resultat as $element){
            $dto = $this->hydrateFromDatabase($element);
            $suiviCollection->append($dto);
        }
        return $suiviCollection;
    }
    
    /***
     * modifie le commentaire du suivi
     * @param unknown $idFestival
     * @param unknown $idEditeur
     * @param unknown $commentaire
     */
    public function setCommentaire($idEditeur, $idFestival, $commentaire){
        try{
            $suiviDto = $this->getSuiviByIdEditeurFestival($idEditeur, $idFestival);
            $suiviDto->setCommentaireSuivi($commentaire);
            $this->updateSuivi($suiviDto);
        }catch(Exception $e){
            
        }
    }
    
    /**
     * change la date de premierContact en la date Actuelle
     * @param int $idEditeur
     * @param int $idFestival
     */
    public function setPremierContact($idEditeur, $idFestival){
        try{
            $suiviDto = $this->getSuiviByIdEditeurFestival($idEditeur, $idFestival);
            $suiviDto->setPremierContact((new \DateTime())->format('Y-m-d H:i:s'));
            $this->updateSuivi($suiviDto);
        }catch(Exception $e){
            
        } 
    }
    
    /**
     * change la date de secondContact en la date Actuelle
     * @param int $idEditeur
     * @param int $idFestival
     */
    public function setSecondContact($idEditeur, $idFestival){
        try{
            $suiviDto = $this->getSuiviByIdEditeurFestival($idEditeur, $idFestival);
            $suiviDto->setSecondContact((new \DateTime())->format('Y-m-d H:i:s'));
            $this->updateSuivi($suiviDto);
        }catch(Exception $e){
            
        }
    }
    
    /**
     * supprime date de premierContact en la date Actuelle
     * @param int $idEditeur
     * @param int $idFestival
     */
    public function unsetPremierContact($idEditeur, $idFestival){
        try{
            $suiviDto = $this->getSuiviByIdEditeurFestival($idEditeur, $idFestival);
            $suiviDto->setPremierContact(null);
            $this->updateSuivi($suiviDto);
        }catch(Exception $e){
            
        }
    }
    
    
    /**
     * supprime date de secondContact en la date Actuelle
     * @param int $idEditeur
     * @param int $idFestival
     */
    public function unsetSecondContact($idEditeur, $idFestival){
        try{
            $suiviDto = $this->getSuiviByIdEditeurFestival($idEditeur, $idFestival);
            $suiviDto->setSecondContact(null);
            $this->updateSuivi($suiviDto);
        }catch(Exception $e){
            
        }
    }
    
    /**
     * passage d'un tableau récupéré en BDD à un dto
     * @param $db
     * @return SuiviDTO
     */
    private function hydrateFromDatabase($db){
        $dto = new SuiviDTO();
        foreach($this->correlationTable as $setterName => $getterName){
            $setter = 'set' .ucwords($setterName);
            $dto->$setter($db->$getterName);
        }
        return $dto;
    }
    
    /**
     * @param SuiviDTO $dto
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