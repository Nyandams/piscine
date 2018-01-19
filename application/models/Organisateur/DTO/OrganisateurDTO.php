<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OrganisateurDTO extends CI_Model
{
    /**
     * @var int
     */
    private $idOrganisateur = NULL;
    
    /**
     * @var string
     */
    private $loginOrganisateur = '';
    
    /**
     * @var string
     */
    private $motDePasseOrganisateur = '';
    
    /** 
     * @var int
     */
    private $admin = null;
    
    /**
     * @var string
     */
    private $nomOrganisateur = "";
    
    /**
     * @var string
     */
    private $prenomOrganisateur = "";
    


    /**
     * @return the $nomOrganisateur
     */
    public function getNomOrganisateur()
    {
        return $this->nomOrganisateur;
    }

    /**
     * @return the $prenomOrganisateur
     */
    public function getPrenomOrganisateur()
    {
        return $this->prenomOrganisateur;
    }

    /**
     * @param string $nomOrganisateur
     */
    public function setNomOrganisateur($nomOrganisateur)
    {
        $this->nomOrganisateur = $nomOrganisateur;
    }

    /**
     * @param string $prenomOrganisateur
     */
    public function setPrenomOrganisateur($prenomOrganisateur)
    {
        $this->prenomOrganisateur = $prenomOrganisateur;
    }

    /**
     * @return the $idOrganisateur
     */
    public function getIdOrganisateur()
    {
        return $this->idOrganisateur;
    }

    /**
     * @return the $loginOrganisateur
     */
    public function getLoginOrganisateur()
    {
        return $this->loginOrganisateur;
    }

    /**
     * @return the $motDePasseOrganisateur
     */
    public function getMotDePasseOrganisateur()
    {
        return $this->motDePasseOrganisateur;
    }

    /**
     * @return the $admin
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param number $idOrganisateur
     */
    public function setIdOrganisateur($idOrganisateur)
    {
        $this->idOrganisateur = $idOrganisateur;
    }

    /**
     * @param string $loginOrganisateur
     */
    public function setLoginOrganisateur($loginOrganisateur)
    {
        $this->loginOrganisateur = $loginOrganisateur;
    }

    /**
     * @param string $motDePasseOrganisateur
     */
    public function setMotDePasseOrganisateur($motDePasseOrganisateur)
    {
        $this->motDePasseOrganisateur = $motDePasseOrganisateur;
    }

    /**
     * @param number $admin
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }

    
    
}