<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ContactFactory extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Editeur/Contact/DAO/ContactDAO');
    }
    
    static public function getInstance() {
        return new ContactDAO();
    }
}