<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EditeurFactory extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Editeur/DAO/EditeurDAO');
    }
    
    static public function getInstance() {
        return new EditeurDAO();
    }
}