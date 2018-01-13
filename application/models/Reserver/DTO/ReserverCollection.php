<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ReserverCollection extends ArrayObject
{
    /**
     * renvoie vrai si un reserver correspond à $idJeu
     * @param int $idJeu
     * @return boolean
     */
    public function existeReserverIdJeu($idJeu){
        $res = false;
        foreach ($this as $reserverDto){
            if ($reserverDto->getIdJeu() == $idJeu){
                $res = true;
            }
        }
        return $res;
    }
    
    
    public function getByIdJeu($idJeu){
        if ($this->existeReserverIdJeu($idJeu)){
            foreach ($this as $reserverDto){
                if ($reserverDto->getIdJeu() == $idJeu){
                    return $reserverDto;
                }
            }
            return new ReserverDTO();
        }
    }
}