<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ReserverDTO extends CI_Model
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

} 