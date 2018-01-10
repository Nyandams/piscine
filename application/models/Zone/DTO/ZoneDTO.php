<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ZoneDTO extends CI_Model
{
    /**
     * @var int
     */
    private $idZone = null;
    
    /**
     * @var string
     */
    private $nomZone = "";
    
    /**
     * @var int
     */
    private $idFestival = NULL;
    
    
    
    /**
     * @return the $idZone
     */
    public function getIdZone()
    {
        return $this->idZone;
    }

    /**
     * @return the $nomZone
     */
    public function getNomZone()
    {
        return $this->nomZone;
    }

    /**
     * @return the $idFestival
     */
    public function getIdFestival()
    {
        return $this->idFestival;
    }

    /**
     * @param number $idZone
     */
    public function setIdZone($idZone)
    {
        $this->idZone = $idZone;
    }

    /**
     * @param string $nomZone
     */
    public function setNomZone($nomZone)
    {
        $this->nomZone = $nomZone;
    }

    /**
     * @param number $idFestival
     */
    public function setIdFestival($idFestival)
    {
        $this->idFestival = $idFestival;
    }

    
}