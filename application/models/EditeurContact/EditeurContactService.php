<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EditeurContactService extends CI_Model
{
    private $editeurDAO = null;
    
    private $contactDAO = null;
    
    public function __construct($editeurDAO, $contactDAO){
        parent::__construct();
        $this->load->model('Editeur/NotFoundEditeurException');
        $this->load->model('Editeur/DTO/EditeurDTO');
        $this->load->model('Editeur/DTO/EditeurCollection');
        
        $this->load->model('Contact/NotFoundContactException');
        $this->load->model('Contact/DTO/ContactDTO');
        $this->load->model('Contact/DTO/ContactCollection');
    }
    
    
    public function getEditeurContact(){
        $editeurCollection = $this->editeurDAO->getEditeurs();
        $editeurContactCollection = new EditeurContactCollection();
        foreach ($editeurCollection as $editeur){
            
        }
    }
}