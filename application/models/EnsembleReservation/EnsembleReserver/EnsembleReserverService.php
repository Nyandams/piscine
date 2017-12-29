<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EnsembleReserverService extends CI_Model
{
    private $reserverDAO = null;
    private $jeuDAO      = null;
    private $typeJeuDAO  = null;
    
    
    public function __construct() {
        parent::__construct();
        $this->load->model("Reserver/DAO/ReserverDAO");
        $this->load->model("Jeu/DAO/JeuDAO");
        $this->load->model("TypeJeu/DAO/TypeJeuDAO");
        $this->load->model("EnsembleReservation/EnsembleReserver/DTO/EnsembleReserverDTO");
        $this->load->model("EnsembleReservation/EnsembleReserver/DTO/EnsembleReserverCollection");
    }
    
    public function initConstruct($daoReserver, $daoJeu, $daoTypeJeu){
        $this->reserverDAO = $daoReserver;
        $this->jeuDAO      = $daoJeu;
        $this->typeJeuDAO  = $daoTypeJeu;
        return $this;
    }
    
    
    public function getEnsembleReserverByIdReservation($idReservation){
        $reserverCollection = $this->reserverDAO->getReserverByIdReservation($idReservation);
        $ensembleReserverCollection = new EnsembleReserverCollection();
        
        foreach ($reserverCollection as $reserverDto){
            $ensembleReserverTmp = new EnsembleReserverDTO();
            //récupération à partir de ReserverDTO
            $ensembleReserverTmp->setIdJeu($reserverDto->getIdJeu());
            $ensembleReserverTmp->setIdReservation($idReservation);
            $ensembleReserverTmp->setQuantiteJeuReserver($reserverDto->getQuantiteJeuReserver());
            $ensembleReserverTmp->setDotationJeuReserver($reserverDto->getDotationJeuReserver());
            $ensembleReserverTmp->setReceptionJeuReserver($reserverDto->getReceptionJeuReserver());
            $ensembleReserverTmp->setRenvoiJeuReserver($reserverDto->getRenvoiJeuReserver());
            
            //récupération à partir de JeuDTO
            try{
                $jeuDto = $this->jeuDAO->getJeuById($ensembleReserverTmp->getIdJeu());
                
                $ensembleReserverTmp->setLibelleJeu($jeuDto->getLibelleJeu());
                $ensembleReserverTmp->setNbMinJoueurJeu($jeuDto->getNbMinJoueurJeu());
                $ensembleReserverTmp->setNbMaxJoueurJeu($jeuDto->getNbMaxJoueurJeu());
                $ensembleReserverTmp->setNoticeJeu($jeuDto->getNoticeJeu());
                $ensembleReserverTmp->setIdEditeur($jeuDto->getIdEditeur());
                $ensembleReserverTmp->setIdTypeJeu($jeuDto->getIdTypeJeu());
            }catch (exception $e){
                
            }
            
            //récupération à partir de TypeJeuDTO
            try{
                $typeJeuDto = $this->typeJeuDAO->getTypeJeuById($ensembleReserverTmp->getIdTypeJeu());
                
                $ensembleReserverTmp->setLibelleTypeJeu($typeJeuDto->getLibelleTypeJeu());
                $ensembleReserverTmp->setIdZone($typeJeuDto->getIdZone());
                
            }catch (Exception $e){
                
            }
            $ensembleReserverCollection->append($ensembleReserverTmp);
        }
        return $ensembleReserverCollection; 
    }
    
}