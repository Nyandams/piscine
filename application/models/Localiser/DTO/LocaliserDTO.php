<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LocaliserDTO extends CI_Model
{
    /**
     * @var int
     */
    private $idZone = null;
    
    /**
     * @var int
     */
    private $idReservation = null;

    /**
     * @var int
     */
    private $nbEmplacement = null;
    
    /**
     * @return $idZone
     */
    public function getIdZone()
    {
        return $this->idZone;
    }

    /**
     * @return $idReservation
     */
    public function getIdReservation()
    {
        return $this->idReservation;
    }

    /**
     * @return $nbEmplacement
     */
    public function getNbEmplacement()
    {
        return $this->nbEmplacement;
    }

    /**
     * @param number $idZone
     */
    public function setIdZone($idZone)
    {
        $this->idZone = $idZone;
    }

    /**
     * @param number $idReservation
     */
    public function setIdReservation($idReservation)
    {
        $this->idReservation = $idReservation;
    }

    /**
     * @param number $nbEmplacement
     */
    public function setNbEmplacement($nbEmplacement)
    {
        $this->nbEmplacement = $nbEmplacement;
    }

}