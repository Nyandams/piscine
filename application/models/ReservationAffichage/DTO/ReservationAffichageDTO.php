<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ReservationAffichageDTO extends CI_Model
{
	/**
	* @var int
	*/
	private $idEditeur = null;


	/**
	* @var string
	*/
	private $libelleEditeur = "";


	/**
	* @var float
	*/	
	private $prixNegociationReservation = null;

	/**
	* @var float
	*/	
	private $nbEmplacement = null;

	/**
	* @var int
	*/
	private $idFestival = null;

	/**
	* @var int
	*/
	private $anneeFestival = null;

	/**
	* @var int
	*/
	private $idJeu = null;

	/**
	* @var string
	*/
	private $libelleJeu = "";






	/**
	* @return the $libelleEditeur
	*/
	public function getLibelleEditeur(){
	return $this->libelleEditeur;
	}

	/**
	* @return the $prixNegociationReservation
	*/
	public function getPrixNegociationReservation(){
		return $this->prixNegociationReservation;
	}

	/**
	* @return the $anneeFestival
	*/
	public function getAnneeFestival(){
		return $this->anneeFestival;
	}

	/**
	* @return the $libelleJeu
	*/
	public function getLibelleJeu(){
	return $this->libelleJeu;
	}

	/**
	* @return the $nbEmplacement
	*/
	public function getNbEmplacement(){
	return $this->nbEmplacement;
	}

	




	/**
	* @param number $idEditeur
  	*/
	public function setIdEditeur($idEditeur)
	{
		$this->idEditeur = $idEditeur;
	}
  
	/**
	* @param string $libelleEditeur
	*/
	public function setLibelleEditeur($libelleEditeur)
  	{
		$this->libelleEditeur = $libelleEditeur;
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
	* @param number $prixNegociationReservation
	*/
	public function setPrixNegociationReservation($prixNegociationReservation)
	{
		$this->prixNegociationReservation = $prixNegociationReservation;
	}


	/**
	* @param number $idJeu
  	*/
	public function setIdJeu($idJeu)
	{
		$this->idJeu = $idJeu;
	}
  
	/**
	* @param string $libelleJeu
	*/
	public function setLibelleJeu($libelleJeu)
  	{
		$this->libelleJeu = $libelleJeu;
	}

        /**
        * @param string $nbEmplacement
        */
        public function setNbEmplacement($nbEmplacement)
        {
                $this->nbEmplacement = $nbEmplacement;
        }

}
