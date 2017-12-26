<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EditeurContactFactory extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Editeur/EditeurFactory');
        $this->load->model('Contact/ContactFactory');
        $this->load->model('Editeur/DAO/EditeurDAO');
        $this->load->model('Contact/DAO/ContactDAO');
        $this->load->model('EditeurContact/EditeurContactService');
    }
    
    static public function getInstance() {
        $editeurDAO = EditeurFactory::getInstance();
        $contactDAO = ContactFactory::getInstance();
        $dao = new EditeurContactService();
        return $dao->initConstruct($editeurDAO, $contactDAO);
    }
}