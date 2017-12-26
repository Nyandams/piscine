<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EditeurContactService extends CI_Model
{
    private $editeurDAO = null;
    private $contactDAO = null;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Editeur/NotFoundEditeurException');
        $this->load->model('Editeur/DTO/EditeurDTO');
        $this->load->model('Editeur/DTO/EditeurCollection');
        $this->load->model("Editeur/DAO/EditeurDAO");
        
        $this->load->model('Contact/NotFoundContactException');
        $this->load->model('Contact/DTO/ContactDTO');
        $this->load->model('Contact/DTO/ContactCollection');
        $this->load->model("Contact/DAO/ContactDAO", "contactDAO");
        
        

    }
    
    public function initConstruct($daoEditeur, $daoContact){
        $this->editeurDAO = $daoEditeur;
        $this->contactDAO = $daoContact;
        
        return $this;
    }
    
    // Renvoie tout les éditeurs avec leur contact principal
    public function getEditeurContactPrincipal(){
        $editeurCollection = $this->editeurDAO->getEditeurs();
        $editeurContactCollection = new EditeurContactCollection();
        
        foreach ($editeurCollection as $editeur){
            $editeurContact = new EditeurContactDTO();
            $editeurContact->setIdEditeur($editeur->getIdEditeur());
            $editeurContact->setLibelleEditeur($editeur->getLibelleEditeur());
            
            try{
                $contactDTO = $this->contactDAO->getContactEditeurPrincipal($editeur->getIdEditeur());
                $editeurContact->setIdContact($contactDTO->getIdContact());
                $editeurContact->setNomContact($contactDTO->getNomContact());
                $editeurContact->setRueContact($contactDTO->getRueContact());
                $editeurContact->setVilleContact($contactDTO->getVilleContact());
                $editeurContact->setCpContact($contactDTO->getCpContact());
                $editeurContact->setMailContact($contactDTO->getMailContact());                
                $editeurContact->setEstPrincipalContact($contactDTO->getEstPrincipalContact());
            } catch(Exception $e) {
                
            }
            
            $editeurContactCollection->append($editeurContact);
        }
        return $editeurContactCollection;
    }
    
    // Renvoie tout les contacts avec leur éditeurs
    public function getEditeurContact(){
        $contactCollection = $this->contactDAO->getContact();
        $editeurContactCollection = new EditeurContactCollection();
        
        foreach ($contactCollection as $contactDTO){
            $editeurContact = new EditeurContactDTO();
            $editeurContact->setIdContact($contactDTO->getIdContact());
            $editeurContact->setNomContact($contactDTO->getNomContact());
            $editeurContact->setRueContact($contactDTO->getRueContact());
            $editeurContact->setVilleContact($contactDTO->getVilleContact());
            $editeurContact->setCpContact($contactDTO->getCpContact());
            $editeurContact->setMailContact($contactDTO->getMailContact());
            $editeurContact->setEstPrincipalContact($contactDTO->getEstPrincipalContact());
            
            try{
                $editeurDTO = $this->EditeurDAO->getEditeurById($contactDTO->getIdEditeur());
                $editeurContact->setLibelleEditeur($editeurDTO->getLibelleEditeur());
            }catch(Exception $e){
                
            }
            
            $editeurContactCollection->append($editeurContact);
        }
        return $editeurContactCollection;
    }
}