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
     * @var string
     */
    private $nomOrganisateur = '';
    
    /**
     * @var string
     */
    private $prenomOrganisateur = '';

    /**
     * @return the $idOrganisateur
     */
    
    /**
     * 
     * @var unknown
     */
    private $admin = null;
    
    
    public function getIdOrganisateur()
    {
        return $this->idOrganisateur;
    }

    /**
     * @return the $admin
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param unknown $admin
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }

    /**
     * @param number $idOrganisateur
     */
    public function setIdOrganisateur($idOrganisateur)
    {
        $this->idOrganisateur = $idOrganisateur;
    }

    /**
     * @return $loginOrganisateur
     */
    public function getLoginOrganisateur()
    {
        return $this->loginOrganisateur;
    }

    /**
     * @return $motDePasseOrganisateur
     */
    public function getMotDePasseOrganisateur()
    {
        return $this->motDePasseOrganisateur;
    }

    /**
     * @return $nomOrganisateur
     */
    public function getNomOrganisateur()
    {
        return $this->nomOrganisateur;
    }

    /**
     * @return $prenomOrganisateur
     */
    public function getPrenomOrganisateur()
    {
        return $this->prenomOrganisateur;
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

}