<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EnsembleReservationDTO extends CI_Model
{
    /**
     * @var EnsembleReserverCollection
     */
    private $ensembleReserverCollection = null;
    
    /**
     * @var int
     */
    private $idReservation = null;
    
    /**
     * @var float
     */
    private $prixNegociationReservation = null;
    
    /**
     * @var int
     */
    private $idFestival = null;
    
    /***
     * @var int
     */
    private $idEditeur = null;
    
    
    
    /**
     * @return the $ensembleReserverCollection
     */
    public function getEnsembleReserverCollection()
    {
        return $this->ensembleReserverCollection;
    }

    /**
     * @return the $idReservation
     */
    public function getIdReservation()
    {
        return $this->idReservation;
    }

    /**
     * @return the $prixNegociationReservation
     */
    public function getPrixNegociationReservation()
    {
        return $this->prixNegociationReservation;
    }

    /**
     * @return the $idFestival
     */
    public function getIdFestival()
    {
        return $this->idFestival;
    }

    /**
     * @return the $idEditeur
     */
    public function getIdEditeur()
    {
        return $this->idEditeur;
    }

    /**
     * @param EnsembleReserverCollection $ensembleReserverCollection
     */
    public function setEnsembleReserverCollection($ensembleReserverCollection)
    {
        $this->ensembleReserverCollection = $ensembleReserverCollection;
    }

    /**
     * @param number $idReservation
     */
    public function setIdReservation($idReservation)
    {
        $this->idReservation = $idReservation;
    }

    /**
     * @param number $prixNegociationReservation
     */
    public function setPrixNegociationReservation($prixNegociationReservation)
    {
        $this->prixNegociationReservation = $prixNegociationReservation;
    }

    /**
     * @param number $idFestival
     */
    public function setIdFestival($idFestival)
    {
        $this->idFestival = $idFestival;
    }

    /**
     * @param number $idEditeur
     */
    public function setIdEditeur($idEditeur)
    {
        $this->idEditeur = $idEditeur;
    }

}