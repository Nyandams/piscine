<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SuiviDTO extends CI_Model
{
    /**
     * @var int
     */
    private $idEditeur = null;
    
    /**
     * @var DateTime
     */
    private $premierContact = null;
    
    /**
     * @var DateTime
     */
    private $secondContact = null;
    
    /**
     * @var int
     */
    private $presenceEditeur = null;
    
    /**
     * @var int
     */
    private $idFestival = null;
    
    /**
     * @var string
     */
    private $commentaireSuivi = "";
    
    /**
     * @return the $idSuivi
     */
    public function getIdSuivi()
    {
        return $this->idSuivi;
    }

    /**
     * @return the $premierContact
     */
    public function getPremierContact()
    {
        return $this->premierContact;
    }

    /**
     * @return the $secondContact
     */
    public function getSecondContact()
    {
        return $this->secondContact;
    }

    /**
     * @return the $presenceEditeur
     */
    public function getPresenceEditeur()
    {
        return $this->presenceEditeur;
    }

    /**
     * @return the $idFestival
     */
    public function getIdFestival()
    {
        return $this->idFestival;
    }

    /**
     * @return the $commentaireSuivi
     */
    public function getCommentaireSuivi()
    {
        return $this->commentaireSuivi;
    }

    /**
     * @param number $idSuivi
     */
    public function setIdSuivi($idSuivi)
    {
        $this->idSuivi = $idSuivi;
    }

    /**
     * @param DateTime $premierContact
     */
    public function setPremierContact($premierContact)
    {
        $this->premierContact = $premierContact;
    }

    /**
     * @param DateTime $secondContact
     */
    public function setSecondContact($secondContact)
    {
        $this->secondContact = $secondContact;
    }

    /**
     * @param number $presenceEditeur
     */
    public function setPresenceEditeur($presenceEditeur)
    {
        $this->presenceEditeur = $presenceEditeur;
    }

    /**
     * @param number $idFestival
     */
    public function setIdFestival($idFestival)
    {
        $this->idFestival = $idFestival;
    }

    /**
     * @param string $commentaireSuivi
     */
    public function setCommentaireSuivi($commentaireSuivi)
    {
        $this->commentaireSuivi = $commentaireSuivi;
    }

    
    
}