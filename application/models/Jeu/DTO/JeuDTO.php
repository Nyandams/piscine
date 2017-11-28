<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class JeuDTO extends CI_Model
{
    /**
     * @var int
     */
    private $idJeu = null;
    
    /**
     * @var string
     */
    private $libelleJeu = "";

    /**
     * @var int
     */
    private $nbMinJoueurJeu = null;

    /**
     * @var int
     */
    private $nbMaxJoueurJeu = null;

    /**
     * @var string
     */
    private $noticeJeu = "";

    /**
     * @var int
     */
    private $idEditeur = null;

    /**
     * @var int
     */
    private $idTypeJeu = null;
    
    /**
     * @return $idJeu
     */
    public function getIdJeu()
    {
        return $this->idJeu;
    }

    /**
     * @return $libelleJeu
     */
    public function getLibelleJeu()
    {
        return $this->libelleJeu;
    }

    /**
     * @return $nbMinJoueurJeu
     */
    public function getNbMinJoueurJeu()
    {
        return $this->nbMinJoueurJeu;
    }

    /**
     * @return $nbMaxJoueurJeu
     */
    public function getNbMaxJoueurJeu()
    {
        return $this->nbMaxJoueurJeu;
    }

    /**
     * @return $noticeJeu
     */
    public function getNoticeJeu()
    {
        return $this->noticeJeu;
    }

    /**
     * @return $idEditeur
     */
    public function getIdEditeur()
    {
        return $this->idEditeur;
    }

    /**
     * @return $idTypeJeu
     */
    public function getIdTypeJeu()
    {
        return $this->idTypeJeu;
    }

    /**
     * @param number $idJeu
     */
    public function setIdJeu($idJeu)
    {
        $this->idJeu = $idJeu;
    }

    /**
     * @param string $libelleJeu
     */
    public function setLibelleJeu($libelleJeu)
    {
        $this->libelleJeu = $libelleJeu;
    }

    /**
     * @param number $nbMinJoueurJeu
     */
    public function setNbMinJoueurJeu($nbMinJoueurJeu)
    {
        $this->nbMinJoueurJeu = $nbMinJoueurJeu;
    }

    /**
     * @param number $nbMaxJoueurJeu
     */
    public function setNbMaxJoueurJeu($nbMaxJoueurJeu)
    {
        $this->nbMaxJoueurJeu = $nbMaxJoueurJeu;
    }

    /**
     * @param string $noticeJeu
     */
    public function setNoticeJeu($noticeJeu)
    {
        $this->noticeJeu = $noticeJeu;
    }

    /**
     * @param number $idEditeur
     */
    public function setIdEditeur($idEditeur)
    {
        $this->idEditeur = $idEditeur;
    }

    /**
     * @param number $idTypeJeu
     */
    public function setIdTypeJeu($idTypeJeu)
    {
        $this->idTypeJeu = $idTypeJeu;
    }


}