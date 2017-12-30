<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EditeurContactService extends CI_Model
{
    private $jeuDAO = null;
    private $reserverDAO = null;
    
    public function __construct() {
        parent::__construct();
        $this->load->model("Jeu/DAO/JeuDAO");
        $this->load->model("Reserver/DAO/ReserverDAO");
    }
    
    public function initConstruct($daoJeu, $daoReserver){
        $this->jeuDAO = $daoJeu;
        $this->reserverDAO = $daoReserver;
        
        return $this;
    }
    
    // Renvoie toutes les réservations liés à un éditeur, renvoie aussi le jeu pour lequel l'éditeur à réservé
    
    public function getReservationUnitaire($idEditeur) {
        $jeuEditeurCollection = $this->daoJeu->getJeuByIdEditeur($idEditeur);
        $reservationUnitaireCollection = new ReservationUnitaireCollection();
        
        foreach ($jeuEditeurCollection as $jeu) {
            $reservation = $this->reserverDAO->getReserverByIdJeu($jeu->getIdJeu());
            
        }
        
    }
}