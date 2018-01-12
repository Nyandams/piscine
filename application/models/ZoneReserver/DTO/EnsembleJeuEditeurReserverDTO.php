<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EnsembleJeuEditeurReserverDTO extends CI_Model
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
     * @var EditeurDTO
     */
    private $editeurDTO = null;
    /**
     * @return ReserverDTO
     */
    public function getReserverDTO()
    {
        return $this->reserverDTO;
    }

    /**
     * @return JeuDTO
     */
    public function getJeuDTO()
    {
        return $this->jeuDTO;
    }

    /**
     * @return TypeJeuDTO
     */
    public function getTypeJeuDTO()
    {
        return $this->typeJeuDTO;
    }

    /**
     * @return EditeurDTO
     */
    public function getEditeurDTO()
    {
        return $this->editeurDTO;
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
     * @param TypeJeuDTO $typeJeuDTO
     */
    public function setTypeJeuDTO($typeJeuDTO)
    {
        $this->typeJeuDTO = $typeJeuDTO;
    }

    /**
     * @param EditeurDTO $editeurDTO
     */
    public function setEditeurDTO($editeurDTO)
    {
        $this->editeurDTO = $editeurDTO;
    }
}