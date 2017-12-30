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
    
    /**
     * permet d'initialiser les dao du service
     * @param ReservationDAO $daoReserver
     * @param JeuDAO $daoJeu
     * @param TypeJeuDAO $daoTypeJeu
     * @return EnsembleReserverService
     */
    public function initConstruct($daoReserver, $daoJeu, $daoTypeJeu){
        $this->reserverDAO = $daoReserver;
        $this->jeuDAO      = $daoJeu;
        $this->typeJeuDAO  = $daoTypeJeu;
        return $this;
    }
    
    /**
     * renvoie la collection d'EnsembleReserverDTO correspondante à l'idReservation passée en paramètre
     * @param int $idReservation
     * @return EnsembleReserverCollection
     */
    public function getEnsembleReserverByIdReservation($idReservation){
        $reserverCollection = $this->reserverDAO->getReserverByIdReservation($idReservation);
        $ensembleReserverCollection = new EnsembleReserverCollection();
        
        foreach ($reserverCollection as $reserverDto){
            $ensembleReserverTmp = new EnsembleReserverDTO();
            //récupération à partir de ReserverDTO
            $ensembleReserverTmp->setReserverDTO($reserverDto); 
            
            //récupération à partir de JeuDTO
            try{
                $jeuDto = $this->jeuDAO->getJeuById($ensembleReserverTmp->getReserverDTO()->getIdJeu());
                $ensembleReserverTmp->setJeuDTO($jeuDTO);
            }catch (exception $e){
                
            }
            
            //récupération à partir de TypeJeuDTO
            try{
                $typeJeuDto = $this->typeJeuDAO->getTypeJeuById($ensembleReserverTmp->getJeuDTO()->getIdTypeJeu());
                $ensembleReserverTmp->setTypeJeu($typeJeuDto);                
            }catch (Exception $e){
                
            }
            $ensembleReserverCollection->append($ensembleReserverTmp);
        }
        return $ensembleReserverCollection; 
    }
    
}