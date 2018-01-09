<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EnsembleReserverDTO extends CI_Model
{
    /***
     * @var ReserverDTO
     */
    private $reserverDTO = null;

    /**
     * @var JeuDTO
     */
    private $jeuDTO = null;
    
    /**
     * @var TypeJeuDTO
     */
    private $typeJeuDTO = null;
    
    /**
     * @var ZoneDTO
     */
    private $zoneDTO = null;
    
    /**
     * @var TypeJeuDTO
     */
    private $typeJeu = null;
    
    /**
     * @return the $typeJeu
     */
    public function getTypeJeu()
    {
        return $this->typeJeu;
    }

    /**
     * @param TypeJeuDTO $typeJeu
     */
    public function setTypeJeu($typeJeu)
    {
        $this->typeJeu = $typeJeu;
    }

    /**
     * @return the $zoneDTO
     */
    public function getZoneDTO()
    {
        return $this->zoneDTO;
    }

    /**
     * @param ZoneDTO $zoneDTO
     */
    public function setZoneDTO($zoneDTO)
    {
        $this->zoneDTO = $zoneDTO;
    }

    /**
     * @return the $reserverDTO
     */
    public function getReserverDTO()
    {
        return $this->reserverDTO;
    }
    

    /**
     * @param ReserverDTO $reserverDTO
     */
    public function setReserverDTO($reserverDTO)
    {
        $this->reserverDTO = $reserverDTO;
    }

    /**
     * @param JeuDTO $jeuDTO
     */
    public function setJeuDTO($jeuDTO)
    {
        $this->jeuDTO = $jeuDTO;
    }
    
    /**
     * @return the $jeuDTO
     */
    public function getJeuDTO()
    {
        return $this->jeuDTO;
    }

    /**
     * @return the $typeJeuDTO
     */
    public function getTypeJeuDTO()
    {
        return $this->typeJeuDTO;
    }

    /**
     * @param TypeJeuDTO $typeJeuDTO
     */
    public function setTypeJeuDTO($typeJeuDTO)
    {
        $this->typeJeuDTO = $typeJeuDTO;
    }


}