<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EnsembleSuiviDTO extends CI_Model
{
    
    /***
     * @var EditeurDTO
     */
    private $editeurDTO = null;
    
    /**
     * @var SuiviDTO
     */
    private $suiviDTO = null;
    
    
    /**
     * @return EditeurDTO
     */
    public function getEditeurDTO()
    {
        return $this->editeurDTO;
    }

    /**
     * @return SuiviDTO
     */
    public function getSuiviDTO()
    {
        return $this->suiviDTO;
    }

    /**
     * @param EditeurDTO $editeurDTO
     */
    public function setEditeurDTO($editeurDTO)
    {
        $this->editeurDTO = $editeurDTO;
    }

    /**
     * @param SuiviDTO $suiviDTO
     */
    public function setSuiviDTO($suiviDTO)
    {
        $this->suiviDTO = $suiviDTO;
    }

    
    
}