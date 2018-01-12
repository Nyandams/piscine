<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ZoneReserverDTO extends CI_Model
{
    /**
     * @var ZoneDTO
     */
    private $zoneDTO = null;
    
    /**
     * @var EnsembleJeuEditeurReserverDTO
     */
    private $ensembleJeuEditeur = null;
    
    
    /**
     * @return ZoneDTO
     */
    public function getZoneDTO()
    {
        return $this->zoneDTO;
    }

    /**
     * @return EnsembleJeuEditeurReserverCollection
     */
    public function getEnsembleJeuEditeur()
    {
        return $this->ensembleJeuEditeur;
    }

    /**
     * @param ZoneDTO $zoneDTO
     */
    public function setZoneDTO($zoneDTO)
    {
        $this->zoneDTO = $zoneDTO;
    }

    /**
     * @param EnsembleJeuEditeurReserverDTO $ensembleJeuEditeur
     */
    public function setEnsembleJeuEditeur($ensembleJeuEditeur)
    {
        $this->ensembleJeuEditeur = $ensembleJeuEditeur;
    }

    
    
}