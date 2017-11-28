<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class JeuFactory extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Jeu/DAO/JeuDAO');
    }
    
    static public function getInstance() {
        return new JeuDAO();
    }
}