<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FactureDAO extends CI_Model
{
    private $correlationTable = array(
        'idFacture'             => 'idFacture',
        'dateEmissionFacture'   => 'dateEmissionFacture',
        'datePaiementFacture'   => 'datePaiementFacture',
        'idReservation'         => 'idReservation'
    );
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Facture/NotFoundFactureException');
        $this->load->model('Facture/DTO/FactureDTO');
        $this->load->model('Facture/DTO/FactureCollection');
    }
    
   

    
    /**
     * renvoie une collection d' "FactureDTO"
     * @return FactureCollection
     */
    public function getFactures(){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->get()
                             ->result();
        
        $factureCollection = new FactureCollection();
        
        foreach($resultat as $element){
            $dto = $this->hydrateFromDatabase($element);
            $factureCollection->append($dto);
        }
        
        return $factureCollection;
    }
    
    /**
     * sauvegarde une facture dans la BDD
     * @param FactureDTO $factureDTO
     */
    public function saveFacture($factureDTO){
        $bdd = hydrateFromDTO($factureDTO);
        $this->db->set($bdd)
                 ->insert($this->table);
    }
    
    /**
     * Supprime le factureDTO de la BDD
     * @param FactureDTO $factureDTO
     * @return Boolean
     */
    public function deleteFacture($factureDTO){
        $id = $factureDTO->getIdFacture();
        return $this->db->where('id', $id)->delete($this->table);
    }
    
    
    public function updateFacture($dto){
        $bdd = hydrateFromDTO($dto);
        
        $this->db->replace($this->table, $bdd);
    }
    
    /**
     * @param int $id
     * @return FactureDTO
     */
    public function getFactureById($id){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->where('idFacture', $id)
                             ->get();
        
        $dto = hydrateFromDatabase($resultat);
        return $dto;
    }
    
    /**
     * retourne une factureCollection contenant les factures pouvant correspondre à $chaineCar (recherche par date d'émission de la facture)
     * @param string $chaineCar
     * @return FactureCollection
     */
    public function listeRechercheFacture($chaineCar){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->like('dateEmissionFacture', $chaineCar)
                             ->get()
                             ->result();
        
        $factureCollection = new FactureCollection();
        
        foreach($resultat as $element){
            $dto = $this->hydrateFromDatabase($element);
            $FactureCollection->append($dto);
        }
        
        return $factureCollection;
    }
    


    /**
     * @param FactureDTO $dto
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
     * @return FactureDTO
     */
    private function hydrateFromDatabase($db){
        $dto = new FactureDTO();
        foreach($this->correlationTable as $setterName => $getterName){
            $setter = 'set' .ucwords($setterName);
            $dto->$setter($db->$getterName);
        }
        return $dto;
    }
}
