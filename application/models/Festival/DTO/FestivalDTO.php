<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FestivalDTO extends CI_Model
{
    /**
     * @var int
     */
    private $idFestival = NULL;
    
    /**
     * @var int
     */
    private $anneeFestival = NULL;
    
    /**
     * @var float
     */
    private $nbEmplacementTotal = NULL;
    
    /**
     * @var float
     */
    private $prixEmplacementFestival = NULL;
    
    /**
     * @var float
     */
    private $nbEmplacementsRestant = NULL;
    
    /**
     * @return the $nbEmplacementsRestant
     */
    public function getNbEmplacementsRestant()
    {
        return $this->nbEmplacementsRestant;
    }

    /**
     * @param number $nbEmplacementsRestant
     */
    public function setNbEmplacementsRestant($nbEmplacementsRestant)
    {
        $this->nbEmplacementsRestant = $nbEmplacementsRestant;
    }

    /**
     * @return the $idFestival
     */
    public function getIdFestival()
    {
        return $this->idFestival;
    }

    /**
     * @return the $anneeFestival
     */
    public function getAnneeFestival()
    {
        return $this->anneeFestival;
    }

    /**
     * @return the $nbEmplacementTotal
     */
    public function getNbEmplacementTotal()
    {
        return $this->nbEmplacementTotal;
    }

    /**
     * @return the $prixEmplacementFestival
     */
    public function getPrixEmplacementFestival()
    {
        return $this->prixEmplacementFestival;
    }

    /**
     * @param number $idFestival
     */
    public function setIdFestival($idFestival)
    {
        $this->idFestival = $idFestival;
    }

    /**
     * @param number $anneeFestival
     */
    public function setAnneeFestival($anneeFestival)
    {
        $this->anneeFestival = $anneeFestival;
    }

    /**
     * @param number $nbEmplacementTotal
     */
    public function setNbEmplacementTotal($nbEmplacementTotal)
    {
        $this->nbEmplacementTotal = $nbEmplacementTotal;
    }

    /**
     * @param number $prixEmplacementFestival
     */
    public function setPrixEmplacementFestival($prixEmplacementFestival)
    {
        $this->prixEmplacementFestival = $prixEmplacementFestival;
    }

}