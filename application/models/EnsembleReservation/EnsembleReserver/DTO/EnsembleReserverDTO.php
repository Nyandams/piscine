<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EnsembleReserverDTO extends CI_Model
{
    /**
     * @var int
     */
    private $idJeu = null;
    
    /**
     * @var int
     */
    private $idReservation = null;
    
    /**
     * @var int
     */
    private $quantiteJeuReserver = null;
    
    /**
     * @var int
     */
    private $dotationJeuReserver = null;
    
    /**
     * @var int
     */
    private $receptionJeuReserver = null;
    
    /**
     * @var int
     */
    private $renvoiJeuReserver = null;
    
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
     * @var string
     */
    private $libelleTypeJeu = "";
    
    /**
     * @var int
     */
    private $idZone = null;
    
    
    /**
     * @return the $idJeu
     */
    public function getIdJeu()
    {
        return $this->idJeu;
    }

    /**
     * @return the $idReservation
     */
    public function getIdReservation()
    {
        return $this->idReservation;
    }

    /**
     * @return the $quantiteJeuReserver
     */
    public function getQuantiteJeuReserver()
    {
        return $this->quantiteJeuReserver;
    }

    /**
     * @return the $dotationJeuReserver
     */
    public function getDotationJeuReserver()
    {
        return $this->dotationJeuReserver;
    }

    /**
     * @return the $receptionJeuReserver
     */
    public function getReceptionJeuReserver()
    {
        return $this->receptionJeuReserver;
    }

    /**
     * @return the $renvoiJeuReserver
     */
    public function getRenvoiJeuReserver()
    {
        return $this->renvoiJeuReserver;
    }

    /**
     * @return the $libelleJeu
     */
    public function getLibelleJeu()
    {
        return $this->libelleJeu;
    }

    /**
     * @return the $nbMinJoueurJeu
     */
    public function getNbMinJoueurJeu()
    {
        return $this->nbMinJoueurJeu;
    }

    /**
     * @return the $nbMaxJoueurJeu
     */
    public function getNbMaxJoueurJeu()
    {
        return $this->nbMaxJoueurJeu;
    }

    /**
     * @return the $noticeJeu
     */
    public function getNoticeJeu()
    {
        return $this->noticeJeu;
    }

    /**
     * @return the $idEditeur
     */
    public function getIdEditeur()
    {
        return $this->idEditeur;
    }

    /**
     * @return the $idTypeJeu
     */
    public function getIdTypeJeu()
    {
        return $this->idTypeJeu;
    }

    /**
     * @return the $libelleTypeJeu
     */
    public function getLibelleTypeJeu()
    {
        return $this->libelleTypeJeu;
    }

    /**
     * @return the $idZone
     */
    public function getIdZone()
    {
        return $this->idZone;
    }

    /**
     * @param number $idJeu
     */
    public function setIdJeu($idJeu)
    {
        $this->idJeu = $idJeu;
    }

    /**
     * @param number $idReservation
     */
    public function setIdReservation($idReservation)
    {
        $this->idReservation = $idReservation;
    }

    /**
     * @param number $quantiteJeuReserver
     */
    public function setQuantiteJeuReserver($quantiteJeuReserver)
    {
        $this->quantiteJeuReserver = $quantiteJeuReserver;
    }

    /**
     * @param number $dotationJeuReserver
     */
    public function setDotationJeuReserver($dotationJeuReserver)
    {
        $this->dotationJeuReserver = $dotationJeuReserver;
    }

    /**
     * @param number $receptionJeuReserver
     */
    public function setReceptionJeuReserver($receptionJeuReserver)
    {
        $this->receptionJeuReserver = $receptionJeuReserver;
    }

    /**
     * @param number $renvoiJeuReserver
     */
    public function setRenvoiJeuReserver($renvoiJeuReserver)
    {
        $this->renvoiJeuReserver = $renvoiJeuReserver;
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

    /**
     * @param string $libelleTypeJeu
     */
    public function setLibelleTypeJeu($libelleTypeJeu)
    {
        $this->libelleTypeJeu = $libelleTypeJeu;
    }

    /**
     * @param number $idZone
     */
    public function setIdZone($idZone)
    {
        $this->idZone = $idZone;
    }

}