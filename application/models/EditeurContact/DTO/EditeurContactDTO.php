<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EditeurContactDTO extends CI_Model
{
    // CONTIENT idEditeur,libelleEditeur, ainsi que les données du contact principal de cet éditeur
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
    
    /**
     * @var int
     */
    private $idContact = null;
    
    /**
     * @var int
     *
     * renvoie 1 s'il le principal contact d'un éditeur 0 sinon
     */
    private $estPrincipalContact = null;
    
    /**
     * @var string
     */
    private $nomContact = '';
    
    /**
     * @var string
     */
    private $prenomContact = '';
    
    /**
     * @var string
     */
    private $mailContact = '';
    
    /**
     * @var string
     */
    private $rueContact = '';
    
    /**
     * @var string
     */
    private $villeContact = '';
    
    /**
     * @var string
     */
    private $cpContact = '';
    
    
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
     * @return the $idContact
     */
    public function getIdContact()
    {
        return $this->idContact;
    }

    /**
     * @return the $estPrincipalContact
     */
    public function getEstPrincipalContact()
    {
        return $this->estPrincipalContact;
    }

    /**
     * @return the $nomContact
     */
    public function getNomContact()
    {
        return $this->nomContact;
    }

    /**
     * @return the $prenomContact
     */
    public function getPrenomContact()
    {
        return $this->prenomContact;
    }

    /**
     * @return the $mailContact
     */
    public function getMailContact()
    {
        return $this->mailContact;
    }

    /**
     * @return the $rueContact
     */
    public function getRueContact()
    {
        return $this->rueContact;
    }

    /**
     * @return the $villeContact
     */
    public function getVilleContact()
    {
        return $this->villeContact;
    }

    /**
     * @return the $cpContact
     */
    public function getCpContact()
    {
        return $this->cpContact;
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

    /**
     * @param number $idContact
     */
    public function setIdContact($idContact)
    {
        $this->idContact = $idContact;
    }

    /**
     * @param number $estPrincipalContact
     */
    public function setEstPrincipalContact($estPrincipalContact)
    {
        $this->estPrincipalContact = $estPrincipalContact;
    }

    /**
     * @param string $nomContact
     */
    public function setNomContact($nomContact)
    {
        $this->nomContact = $nomContact;
    }

    /**
     * @param string $prenomContact
     */
    public function setPrenomContact($prenomContact)
    {
        $this->prenomContact = $prenomContact;
    }

    /**
     * @param string $mailContact
     */
    public function setMailContact($mailContact)
    {
        $this->mailContact = $mailContact;
    }

    /**
     * @param string $rueContact
     */
    public function setRueContact($rueContact)
    {
        $this->rueContact = $rueContact;
    }

    /**
     * @param string $villeContact
     */
    public function setVilleContact($villeContact)
    {
        $this->villeContact = $villeContact;
    }

    /**
     * @param string $cpContact
     */
    public function setCpContact($cpContact)
    {
        $this->cpContact = $cpContact;
    }

}
    