<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FactureAffichageDTO extends CI_Model
{
    /**
     * @var int
     */
    private $idEditeur = null;
    
    /**
     * @var string
     */
    private $libelleEditeur = "";
    
    /**
     * @var int
     */
    private $idFacture = null;
    
    /**
     * @var int
     */
    private $idReservation = null;
    
    /**
     * @var int
     */
    private $idFestival = null;
    
    /**
     * @var float
     */
    private $prixNegociationReservation = null;
    
    /**
     * @var int
     */
    private $anneeFestival = null;
    
    /**
     * @var DateTime
     */
    private $dateEmissionFacture = null;
    
    /**
     * @var DateTime
     */
    private $datePaiementFacture = null;
    /**
     * @return the $idEditeur
     */
    
    
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
    
    
    public function getIdEditeur()
    {
        return $this->idEditeur;
    }

    /**
     * @return the $libelleEditeur
     */
    public function getLibelleEditeur()
    {
        return $this->libelleEditeur;
    }

    /**
     * @return the $idFacture
     */
    public function getIdFacture()
    {
        return $this->idFacture;
    }

    /**
     * @return the $idReservation
     */
    public function getIdReservation()
    {
        return $this->idReservation;
    }

    /**
     * @return the $idFestival
     */
    public function getIdFestival()
    {
        return $this->idFestival;
    }

    /**
     * @return the $prixNegociationReservation
     */
    public function getPrixNegociationReservation()
    {
        return $this->prixNegociationReservation;
    }

    /**
     * @return the $anneeFestival
     */
    public function getAnneeFestival()
    {
        return $this->anneeFestival;
    }

    /**
     * @return the $dateEmissionFacture
     */
    public function getDateEmissionFacture()
    {
        return $this->dateEmissionFacture;
    }

    /**
     * @return the $datePaiementFacture
     */
    public function getDatePaiementFacture()
    {
        return $this->datePaiementFacture;
    }

    /**
     * @param number $idEditeur
     */
    public function setIdEditeur($idEditeur)
    {
        $this->idEditeur = $idEditeur;
    }

    /**
     * @param string $libelleEditeur
     */
    public function setLibelleEditeur($libelleEditeur)
    {
        $this->libelleEditeur = $libelleEditeur;
    }

    /**
     * @param number $idFacture
     */
    public function setIdFacture($idFacture)
    {
        $this->idFacture = $idFacture;
    }

    /**
     * @param number $idReservation
     */
    public function setIdReservation($idReservation)
    {
        $this->idReservation = $idReservation;
    }

    /**
     * @param number $idFestival
     */
    public function setIdFestival($idFestival)
    {
        $this->idFestival = $idFestival;
    }

    /**
     * @param number $prixNegociationReservation
     */
    public function setPrixNegociationReservation($prixNegociationReservation)
    {
        $this->prixNegociationReservation = $prixNegociationReservation;
    }

    /**
     * @param number $anneeFestival
     */
    public function setAnneeFestival($anneeFestival)
    {
        $this->anneeFestival = $anneeFestival;
    }

    /**
     * @param string $dateEmissionFacture
     */
    public function setDateEmissionFacture($dateEmissionFacture)
    {
        $this->dateEmissionFacture = $dateEmissionFacture;
    }

    /**
     * @param string $datePaiementFacture
     */
    public function setDatePaiementFacture($datePaiementFacture)
    {
        $this->datePaiementFacture = $datePaiementFacture;
    }

    
}