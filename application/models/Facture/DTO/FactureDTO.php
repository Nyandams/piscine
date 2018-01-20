<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FactureDTO extends CI_Model
{
    /**
     * @var int
     */
    private $idFacture = null;
    
    /**
     * @var DateTime
     */
    private $dateEmissionFacture = null;
    
    /**
     * @var DateTime
     */
    private $datePaiementFacture = null;

    /**
     * @var int
     */
    private $idReservation = null;
    
    
    public function dateEmissionFactureFormat(){
        if($this->dateEmissionFacture != null){
            return $this->getDateEmissionFacture()->format('Y-m-d');
        }
    }
    
    public function datePaiementFactureFormat(){
        if($this->datePaiementFacture != null){
            return $this->getDatePaiementFacture()->format('Y-m-d');
        }
    }
    
    
    
    public function dateEmissionFactureToString(){
        if($this->dateEmissionFacture != null){
            return $this->dateEmissionFacture->format('d/m/Y');
        }
    }
    
    public function datePaiementFactureToString(){
        if($this->datePaiementFacture != null){
            return $this->datePaiementFacture->format('d/m/Y');
        }
    }
    
    /**
     * @return $idFacture
     */
    public function getIdFacture()
    {
        return $this->idFacture;
    }

    /**
     * @return $dateEmissionFacture
     */
    public function getDateEmissionFacture()
    {
        if($this->dateEmissionFacture == null){
            return null;
        }else{
            return new \DateTime($this->dateEmissionFacture);
        }
    }

    /**
     * @return $datePaiementFacture
     */
    public function getDatePaiementFacture()
    {
        if($this->datePaiementFacture == null){
            return null;
        }else{
            return new \DateTime($this->datePaiementFacture);
        }
    }

    /**
     * @return $idReservation
     */
    public function getIdReservation()
    {
        return $this->idReservation;
    }

    /**
     * @param number $idFacture
     */
    public function setIdFacture($idFacture)
    {
        $this->idFacture = $idFacture;
    }

    /**
     * @param DateTime $dateEmissionFacture
     */
    public function setDateEmissionFacture($dateEmissionFacture)
    {
        if ($dateEmissionFacture instanceof \DateTime){
            $this->dateEmissionFacture = $dateEmissionFacture->format('Y-m-d H:i:s');
        } else {
            $this->dateEmissionFacture = $dateEmissionFacture;
        }
    }
    
    public function unsetDateEmissionFacture()
    {
       
           $this->dateEmissionFacture = null;
    }
    
    public function unsetDatePaiementFacture()
    {
        $this->datePaiementFacture = null;
    }

    /**
     * @param DateTime $datePaiementFacture
     */
    public function setDatePaiementFacture($datePaiementFacture)
    {
        if ($datePaiementFacture instanceof \DateTime){
            $this->datePaiementFacture = $datePaiementFacture->format('Y-m-d H:i:s');
        } else {
            $this->datePaiementFacture = $datePaiementFacture;
        }
    }

    /**
     * @param number $idReservation
     */
    public function setIdReservation($idReservation)
    {
        $this->idReservation = $idReservation;
    }

}