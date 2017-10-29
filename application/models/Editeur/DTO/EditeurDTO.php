<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EditeurService extends CI_Model
{
    /**
     * @var /Editeur/Editeur/DTO/EditeurDTO
     */
    private $EditeurDTO = null;
    
    /**
     * @var /Editeur/Contact/DTO/EditeurCollection
     */
    private $contactCollection = NULL;
    
    
    /**
     * @return the $EditeurDTO
     */
    public function getEditeurDTO()
    {
        return $this->EditeurDTO;
    }

    /**
     * @param /Editeur/Editeur $EditeurDTO
     */
    public function setEditeurDTO($EditeurDTO)
    {
        $this->EditeurDTO = $EditeurDTO;
    }

    /**
     * @return the $contactCollection
     */
    public function getContactCollection()
    {
        return $this->contactCollection;
    }

    /**
     * @param /Editeur/Editeur/DTO/EditeurCollection $contactCollection
     */
    public function setContactCollection($contactCollection)
    {
        $this->contactCollection = $contactCollection;
    }

}