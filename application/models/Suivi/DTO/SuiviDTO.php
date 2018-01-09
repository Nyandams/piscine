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
     * @var int
     */
    private $logementSuivi = null;
    
    /**
     * @var int
     */
    private $reponseEditeur = null;
    
    
    /**
     * @return the $reponseEditeur
     */
    public function getReponseEditeur()
    {
        return $this->reponseEditeur;
    }

    /**
     * @param number $reponseEditeur
     */
    public function setReponseEditeur($reponseEditeur)
    {
        $this->reponseEditeur = $reponseEditeur;
    }

    public function premierContactToString(){
        if($this->premierContact != null){
            return $this->getPremierContact()->format('d/m/Y');
            
        }
        
    }
    
    public function secondContactToString(){
        if($this->secondContact != null){
            return $this->getSecondContact()->format('d/m/Y');
    
        }
    }
    
    
    
    /**
     * @return the $idEditeur
     */
    public function getIdEditeur()
    {
        return $this->idEditeur;
    }

    /**
     * @return the $logementSuivi
     */
    public function getLogementSuivi()
    {
        return $this->logementSuivi;
    }

    /**
     * @param number $idEditeur
     */
    public function setIdEditeur($idEditeur)
    {
        $this->idEditeur = $idEditeur;
    }

    /**
     * @param number $logementSuivi
     */
    public function setLogementSuivi($logementSuivi)
    {
        $this->logementSuivi = $logementSuivi;
    }

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
        if($this->premierContact == null){
            return null;
        }else{
            return new \DateTime($this->premierContact);
        }}

    /**
     * @return the $secondContact
     */
    public function getSecondContact()
    {
        if($this->secondContact == null){
            return null;
        }else{
            return new \DateTime($this->secondContact);
        }
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
        if ($premierContact instanceof \DateTime){
            $this->premierContact = $premierContact->format('Y-m-d H:i:s');
        } else {
            $this->premierContact = $premierContact;
        }
    }

    /**
     * @param DateTime $secondContact
     */
    public function setSecondContact($secondContact)
    {
        if ($secondContact instanceof \DateTime){
            $this->secondContact = $secondContact->format('Y-m-d H:i:s');
        } else {
            $this->secondContact = $secondContact;
        }}

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