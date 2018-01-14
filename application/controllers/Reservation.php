<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reservation extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Permet de gérer les urls
        $this->load->helper('url');


        if (!$this->session->has_userdata('connexionOrganisateur')){
            redirect(site_url('/welcome'));
        } else {
            // Récupération des données de l'Editeur
            $this->load->model('ReservationAffichage/ReservationAffichageFactory');
	 
	    $this->load->model('Jeu/JeuFactory');
        }
    }


    public function index() {
        $this->reservationFestival();
    }


    public function reservationFestival(){
        $reservationAffichageService = $this->ReservationAffichageFactory->getInstance();
        $idFestival = $this->session->userdata('idFestival');
	$jeuDAO = $this->JeuFactory->getInstance();

        $data['reservationAffichageCollection'] = $reservationAffichageService->getReservationByIdFestival($idFestival);
	$data['JeuxReservation'] = $jeuDAO->getJeux();
        $data['page'] = $this->load->view('Reservation/tabReservation', $data, true);
        $data['title']= 'Reservations';
        $this->load->view("Theme/theme", $data); 
    }
}
