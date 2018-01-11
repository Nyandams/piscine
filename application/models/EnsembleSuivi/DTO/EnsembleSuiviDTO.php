<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EnsembleSuiviDTO extends CI_Model
{
    
    /***
     * @var editeurContactDTO
     */
    private $editeurContactDTO = null;
    
    /**
     * @var SuiviDTO
     */
    private $suiviDTO = null;
    
    
    /**
     * @return editeurContactDTO
     */
    public function getEditeurContactDTO()
    {
        return $this->editeurContactDTO;
    }

    /**
     * @return SuiviDTO
     */
    public function getSuiviDTO()
    {
        return $this->suiviDTO;
    }

    /**
     * @param editeurContactDTO $editeurContactDTO
     */
    public function setEditeurContactDTO($editeurContactDTO)
    {
        $this->editeurContactDTO = $editeurContactDTO;
    }

    /**
     * @param SuiviDTO $suiviDTO
     */
    public function setSuiviDTO($suiviDTO)
    {
        $this->suiviDTO = $suiviDTO;
    }

    
    
}