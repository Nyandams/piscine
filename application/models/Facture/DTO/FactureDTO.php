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
        return $this->dateEmissionFacture;
    }

    /**
     * @return $datePaiementFacture
     */
    public function getDatePaiementFacture()
    {
        return $this->datePaiementFacture;
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
        $this->dateEmissionFacture = $dateEmissionFacture;
    }

    /**
     * @param DateTime $datePaiementFacture
     */
    public function setDatePaiementFacture($datePaiementFacture)
    {
        $this->datePaiementFacture = $datePaiementFacture;
    }

    /**
     * @param number $idReservation
     */
    public function setIdReservation($idReservation)
    {
        $this->idReservation = $idReservation;
    }

}