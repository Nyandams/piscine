<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LogementDTO extends CI_Model
{
    /**
     * @var int
     */
    private $idLogement = null;
    
    /**
     * @var float
     */
    private $prixNuitLogement = null;
    
    /**
     * @var int
     */
    private $nbMaxPlaceLogement = null;
    
    /**
     * @var string
     */
    private $rueLogement = "";
    
    /**
     * @var string
     */
    private $villeLogement = "";
    
    /**
     * @var string
     */
    private $cpLogement = "";
    
    /**
     * @var int
     */
    private $telLogement = null;
    
    /**
     * @return the $idLogement
     */
    public function getIdLogement()
    {
        return $this->idLogement;
    }

    /**
     * @return the $prixNuitLogement
     */
    public function getPrixNuitLogement()
    {
        return $this->prixNuitLogement;
    }

    /**
     * @return the $nbMaxPlaceLogement
     */
    public function getNbMaxPlaceLogement()
    {
        return $this->nbMaxPlaceLogement;
    }

    /**
     * @return the $rueLogement
     */
    public function getRueLogement()
    {
        return $this->rueLogement;
    }

    /**
     * @return the $villeLogement
     */
    public function getVilleLogement()
    {
        return $this->villeLogement;
    }

    /**
     * @return the $cpLogement
     */
    public function getCpLogement()
    {
        return $this->cpLogement;
    }

    /**
     * @return the $telLogement
     */
    public function getTelLogement()
    {
        return $this->telLogement;
    }

    /**
     * @param number $idLogement
     */
    public function setIdLogement($idLogement)
    {
        $this->idLogement = $idLogement;
    }

    /**
     * @param number $prixNuitLogement
     */
    public function setPrixNuitLogement($prixNuitLogement)
    {
        $this->prixNuitLogement = $prixNuitLogement;
    }

    /**
     * @param number $nbMaxPlaceLogement
     */
    public function setNbMaxPlaceLogement($nbMaxPlaceLogement)
    {
        $this->nbMaxPlaceLogement = $nbMaxPlaceLogement;
    }

    /**
     * @param string $rueLogement
     */
    public function setRueLogement($rueLogement)
    {
        $this->rueLogement = $rueLogement;
    }

    /**
     * @param string $villeLogement
     */
    public function setVilleLogement($villeLogement)
    {
        $this->villeLogement = $villeLogement;
    }

    /**
     * @param string $cpLogement
     */
    public function setCpLogement($cpLogement)
    {
        $this->cpLogement = $cpLogement;
    }

    /**
     * @param number $telLogement
     */
    public function setTelLogement($telLogement)
    {
        $this->telLogement = $telLogement;
    }
    
}