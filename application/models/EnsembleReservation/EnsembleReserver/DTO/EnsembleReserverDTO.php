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
    private $typeJeu = null;
    
    
    /**
     * @return the $reserverDTO
     */
    public function getReserverDTO()
    {
        return $this->reserverDTO;
    }

    /**
     * @return the $jeuDTO
     */
    public function getJeuDTO()
    {
        return $this->jeuDTO;
    }

    /**
     * @return the $typeJeu
     */
    public function getTypeJeu()
    {
        return $this->typeJeu;
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
     * @param TypeJeuDTO $typeJeu
     */
    public function setTypeJeu($typeJeu)
    {
        $this->typeJeu = $typeJeu;
    }

}