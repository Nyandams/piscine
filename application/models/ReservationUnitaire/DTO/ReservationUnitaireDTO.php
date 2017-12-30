<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 *
 */
class ReservationUnitaireDTO extends CI_Model
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
    private $nbMaxJoueurJeu = null;
    /**
     * @return number
     */
    public function getIdJeu()
    {
        return $this->idJeu;
    }

    /**
     * @return number
     */
    public function getIdReservation()
    {
        return $this->idReservation;
    }

    /**
     * @return number
     */
    public function getQuantiteJeuReserver()
    {
        return $this->quantiteJeuReserver;
    }

    /**
     * @return number
     */
    public function getDotationJeuReserver()
    {
        return $this->dotationJeuReserver;
    }

    /**
     * @return number
     */
    public function getReceptionJeuReserver()
    {
        return $this->receptionJeuReserver;
    }

    /**
     * @return number
     */
    public function getRenvoiJeuReserver()
    {
        return $this->renvoiJeuReserver;
    }

    /**
     * @return string
     */
    public function getLibelleJeu()
    {
        return $this->libelleJeu;
    }

    /**
     * @return number
     */
    public function getNbMaxJoueurJeu()
    {
        return $this->nbMaxJoueurJeu;
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
     * @param number $nbMaxJoueurJeu
     */
    public function setNbMaxJoueurJeu($nbMaxJoueurJeu)
    {
        $this->nbMaxJoueurJeu = $nbMaxJoueurJeu;
    }

    
    
    
    
}
