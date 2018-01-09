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
    private $nomEditeur = "";
    
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
     * @var string
     */
    private $dateEmissionFacture = null;
    
    /**
     * @var string
     */
    private $datePaiementFacture = null;
    /**
     * @return the $idEditeur
     */
    
    public function getIdEditeur()
    {
        return $this->idEditeur;
    }

    /**
     * @return the $nomEditeur
     */
    public function getNomEditeur()
    {
        return $this->nomEditeur;
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
     * @param string $nomEditeur
     */
    public function setNomEditeur($nomEditeur)
    {
        $this->nomEditeur = $nomEditeur;
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