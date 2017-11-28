<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HebergementDTO extends CI_Model
{
    /**
     * @var int
     */
    private $idLogement = null;
    
    /**
     * @var int
     */
    private $idLogement = null;

    /**
     * @var int
     */
    private $nbNuitHebergement = null;

    /**
     * @var int
     */
    private $nbPersonneHebergement = null;

    /**
     * @var string
     */
    private $nomResponsable = "";

    /**
     * @var string
     */
    private $prenomResponsable = "";
    
    /**
     * @return $idLogement
     */
    public function getIdLogement()
    {
        return $this->idLogement;
    }

    /**
     * @return $idLogement
     */
    public function getIdLogement()
    {
        return $this->idLogement;
    }

    /**
     * @return $nbNuitHebergement
     */
    public function getNbNuitHebergement()
    {
        return $this->nbNuitHebergement;
    }

    /**
     * @return $nbPersonneHebergement
     */
    public function getNbPersonneHebergement()
    {
        return $this->nbPersonneHebergement;
    }

    /**
     * @return $nomResponsable
     */
    public function getNomResponsable()
    {
        return $this->nomResponsable;
    }
    
    /**
     * @return $prenomResponsable
     */
    public function getPrenomResponsable()
    {
        return $this->prenomResponsable;
    }

    /**
     * @param number $idLogement
     */
    public function setIdLogement($idLogement)
    {
        $this->idLogement = $idLogement;
    }

    /**
     * @param number $idLogement
     */
    public function setIdLogement($idLogement)
    {
        $this->idLogement = $idLogement;
    }

    /**
     * @param number $nbNuitHebergement
     */
    public function setNbNuitHebergement($nbNuitHebergement)
    {
        $this->nbNuitHebergement = $nbNuitHebergement;
    }

    /**
     * @param number $nbPersonneHebergement
     */
    public function setNbPersonneHebergement($nbPersonneHebergement)
    {
        $this->nbPersonneHebergement = $nbPersonneHebergement;
    }

    /**
     * @param string $nomResponsable
     */
    public function setNomResponsable($nomResponsable)
    {
        $this->nomResponsable = $nomResponsable;
    }

    /**
     * @param string $prenomResponsable
     */
    public function setPrenomResponsable($prenomResponsable)
    {
        $this->prenomResponsable = $prenomResponsable;
    }


}