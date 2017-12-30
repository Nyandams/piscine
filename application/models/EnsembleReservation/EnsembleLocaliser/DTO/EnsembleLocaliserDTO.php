<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EnsembleLocaliserDTO extends CI_Model
{
    /**
     * @var LocaliserDTO
     */
    private $localiserDTO = null;
    
    /**
     * @var zoneDTO
     */
    private $zoneDTO = null;
    
    /**
     * @return the $localiserDTO
     */
    public function getLocaliserDTO()
    {
        return $this->localiserDTO;
    }

    /**
     * @return the $zoneDTO
     */
    public function getZoneDTO()
    {
        return $this->zoneDTO;
    }

    /**
     * @param field_type $localiserDTO
     */
    public function setLocaliserDTO($localiserDTO)
    {
        $this->localiserDTO = $localiserDTO;
    }

    /**
     * @param field_type $zoneDTO
     */
    public function setZoneDTO($zoneDTO)
    {
        $this->zoneDTO = $zoneDTO;
    }

}