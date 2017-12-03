<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TypeJeuDTO extends CI_Model
{
    /**
     * @var int
     */
    private $idTypeJeu = null;
    
    /**
     * @var string
     */
    private $libelleTypeJeu = "";
    
    /**
     * @var int
     */
    private $idZone = null;
    
    
    /**
     * @return the $idTypeJeu
     */
    public function getIdTypeJeu()
    {
        return $this->idTypeJeu;
    }

    /**
     * @return the $libelleTypeJeu
     */
    public function getLibelleTypeJeu()
    {
        return $this->libelleTypeJeu;
    }

    /**
     * @return the $idZone
     */
    public function getIdZone()
    {
        return $this->idZone;
    }

    /**
     * @param number $idTypeJeu
     */
    public function setIdTypeJeu($idTypeJeu)
    {
        $this->idTypeJeu = $idTypeJeu;
    }

    /**
     * @param string $libelleTypeJeu
     */
    public function setLibelleTypeJeu($libelleTypeJeu)
    {
        $this->libelleTypeJeu = $libelleTypeJeu;
    }

    /**
     * @param number $idZone
     */
    public function setIdZone($idZone)
    {
        $this->idZone = $idZone;
    }

    
}