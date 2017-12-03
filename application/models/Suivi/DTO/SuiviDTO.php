<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SuiviDTO extends CI_Model
{
    /**
     * @var int
     */
    private $idSuivi = null;
    
    /**
     * @var string
     */
    private $typeSuivi = "";
    
    /**
     * @var DateTime
     */
    private $dateSuivi = null;
    
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
     * @return the $typeSuivi
     */
    public function getTypeSuivi()
    {
        return $this->typeSuivi;
    }

    /**
     * @return the $dateSuivi
     */
    public function getDateSuivi()
    {
        return $this->dateSuivi;
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
     * @param string $typeSuivi
     */
    public function setTypeSuivi($typeSuivi)
    {
        $this->typeSuivi = $typeSuivi;
    }

    /**
     * @param DateTime $dateSuivi
     */
    public function setDateSuivi($dateSuivi)
    {
        $this->dateSuivi = $dateSuivi;
    }

    /**
     * @param string $commentaireSuivi
     */
    public function setCommentaireSuivi($commentaireSuivi)
    {
        $this->commentaireSuivi = $commentaireSuivi;
    }

}