<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EditeurDTO extends CI_Model
{
    /**
     * @var int
     */
    private $idEditeur = NULL;
    
    /**
     * @var string
     */
    private $libelleEditeur = '';
    /**
     * @return the $idEditeur
     */
    
    
    public function getIdEditeur()
    {
        return $this->idEditeur;
    }

    /**
     * @return the $libelleEditeur
     */
    public function getLibelleEditeur()
    {
        return $this->libelleEditeur;
    }

    /**
     * @param number $idEditeur
     */
    public function setIdEditeur($idEditeur)
    {
        $this->idEditeur = $idEditeur;
    }

    /**
     * @param string $libelleEditeur
     */
    public function setLibelleEditeur($libelleEditeur)
    {
        $this->libelleEditeur = $libelleEditeur;
    }

}