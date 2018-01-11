<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ZoneReserverDTO extends CI_Model
{
    /**
     * @var ZoneDTO
     */
    private $zoneDTO = null;
    
    /**
     * @var EnsembleReservationDTO
     */
    private $ensembleReserverCollection = null;
    /**
     * @return ZoneDTO
     */
    public function getZoneDTO()
    {
        return $this->zoneDTO;
    }

    /**
     * @return EnsembleReservationDTO
     */
    public function getEnsembleReserverDTO()
    {
        return $this->ensembleReserverDTO;
    }

    /**
     * @param ZoneDTO $zoneDTO
     */
    public function setZoneDTO($zoneDTO)
    {
        $this->zoneDTO = $zoneDTO;
    }

    /**
     * @param EnsembleReservationDTO $ensembleReserverDTO
     */
    public function setEnsembleReserverCollection($ensembleReserverCollection)
    {
        $this->ensembleReserverCollection = $ensembleReserverCollection;
    }

    
    
    
   

    
}