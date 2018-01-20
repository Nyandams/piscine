<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FactureDAO extends CI_Model
{
    private $table = 'facture';
    
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
        $bdd = $this->hydrateFromDTO($factureDTO);
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
        return $this->db->where('idFacture', $id)->delete($this->table);
    }
    
    
    public function updateFacture($dto){
        $bdd = $this->hydrateFromDTO($dto);
        
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
                             ->get()
                             ->result();
        
        if(!empty($resultat)){
            $dto = $this->hydrateFromDatabase($resultat[0]);
            return $dto;
        } else {
            throw new NotFoundFactureException();
        }
    }
    
    
    /**
     * renvoie la facture correspondant à un idReservation
     * @param int $id
     * @return FactureDTO
     */
    public function getFactureByIdReservation($id){
        $resultat = $this->db->select()
                             ->from($this->table)
                             ->where('idReservation', $id)
                             ->get()
                             ->result();
        
        if(!empty($resultat)){
            $dto = $this->hydrateFromDatabase($resultat[0]);
            return $dto;
        } else {
            throw new NotFoundFactureException();
        }
    }
    

    /**
     * @param FactureDTO $dto
     * @return array('id' => value)
     */
    private function hydrateFromDTO($dto){
        $bdd = array();
        foreach($this->correlationTable as $getterName => $setterName){
            if ($setterName == "dateEmissionFacture" || $setterName == "datePaiementFacture"){
                $getter = 'get'.ucwords($getterName);
                if($dto->$getter() != null){
                    $bdd[$setterName] = $dto->$getter()->format('Y-m-d H:i:s');
                } else {
                    $bdd[$setterName] = $dto->$getter();
                }
                
            }else{
                $getter = 'get'.ucwords($getterName);
                $bdd[$setterName] = $dto->$getter();
            }
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
