<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TypeJeuFactory extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->model('TypeJeu/DAO/TypeJeuDAO');
    }
    
    static public function getInstance() {
        return new TypeJeuDAO();
    }
}