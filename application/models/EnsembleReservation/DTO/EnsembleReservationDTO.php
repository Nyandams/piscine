<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EnsembleReservationDTO extends CI_Model
{
    /**
     * @var EnsembleReserverCollection
     */
    private $ensembleReserverCollection = null;
    
    /**
     * @var ReservationDTO
     */
    private $reservationDTO = null;
    
    /**
     * @var EnsembleLocaliserDTO
     */
    private $ensembleLocaliserDTO = null;
    
    /**
     * @var FactureDTO
     */
    private $factureDTO = null;
    
    /**
     * @return the $ensembleReserverCollection
     */
    public function getEnsembleReserverCollection()
    {
        return $this->ensembleReserverCollection;
    }

    /**
     * @return the $reservationDTO
     */
    public function getReservationDTO()
    {
        return $this->reservationDTO;
    }

    /**
     * @return the $ensembleLocaliserDTO
     */
    public function getEnsembleLocaliserDTO()
    {
        return $this->ensembleLocaliserDTO;
    }

    /**
     * @return the $factureDTO
     */
    public function getFactureDTO()
    {
        return $this->factureDTO;
    }

    /**
     * @param EnsembleReserverCollection $ensembleReserverCollection
     */
    public function setEnsembleReserverCollection($ensembleReserverCollection)
    {
        $this->ensembleReserverCollection = $ensembleReserverCollection;
    }

    /**
     * @param ReservationDTO $reservationDTO
     */
    public function setReservationDTO($reservationDTO)
    {
        $this->reservationDTO = $reservationDTO;
    }

    /**
     * @param EnsembleLocaliserDTO $ensembleLocaliserDTO
     */
    public function setEnsembleLocaliserDTO($ensembleLocaliserDTO)
    {
        $this->ensembleLocaliserDTO = $ensembleLocaliserDTO;
    }

    /**
     * @param FactureDTO $factureDTO
     */
    public function setFactureDTO($factureDTO)
    {
        $this->factureDTO = $factureDTO;
    }


}