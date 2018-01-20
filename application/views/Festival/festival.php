<h1 id="titreInterface">Festivals :</h1>
<!-- Modal -->
<div class="modal fade" id="ajouterFestivalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un festival</h5>
            </div>

            <form method="POST" action="<?php echo site_url('festival/ajoutFestival');?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="annee">Année</label>
                        <input type="text" class="form-control" id="annee" name="annee" placeholder="année">
                        
                        <label for="nbEmplacement">Nombre d'emplacement</label>
                        <input type="text" class="form-control" id="nbEmplacement" name="nbEmplacement" placeholder="nombre d'emplacement">
                        
                        <label for="prix">Prix de l'emplacement</label>
                        <input type="text" class="form-control" id="prix" name="prix" placeholder="25.00">
                    </div>
                </div>
               
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-secondary">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php  


foreach($festivalCollection as $festival){
    // Changement de la couleur du panel
    $couleur= "";
    
    if ($festival->getIdFestival() == $this->session->userdata("idFestival")) {
        $couleur = 'style ="background-color: green;"';

    }
    $panel ='<div class="panel panel-default vignetteFestival col-lg-2 col-sm-3">
                    <div class="panel-heading" ' . $couleur .'">
                        <div class="row">
                            <div class="col-xs-7">
                                <h3 class="panel-title text-right">'.$festival->getAnneeFestival().'</h3>
                            </div>
                            <div class="col-xs-5 text-right">
                                <a class="btn btn-primary btn-xs" href="'. site_url('Festival/changerFestival?idFestival='. $festival->getIdFestival()) .'" role="button"><span class="glyphicon glyphicon-hand-down" aria-hidden="true"></span></a>
                                <a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#supprimerFestivalModal_' . $festival->getIdFestival() .'" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                            </div>
                        </div>                    
                    </div>
                    
                    <div class="panel-body">
                       <p>Nb Emplacements : '.$festival->getNbEmplacementTotal().'</p>
                       <p>Prix de l\'emplacement : '.$festival->getPrixEmplacementFestival().'</p>
                       <p>Emplacements restants : '. $festival->getNbEmplacementsRestant() .'</p>
                    </div>
                    
                </div>
            ';
    echo $panel;
    
    $modalSuppressionFestival =
    '<div class="modal fade" id="supprimerFestivalModal_' . $festival->getIdFestival() .'" tabindex="-1" role="dialog">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h5 class="modal-title"><b>Attention !</b></h5>
    
                          </div>
    
                          <form method="POST" action="' . site_url("Festival/supprimerFestival") . '">
                              <div class="modal-body">
                                    <p>Etes-vous sûr de vouloir supprimer ce festival ?</p>
                                    <input type="hidden" name="idFestival" id="idFestival" value="'. $festival->getIdFestival() .'">
                              </div>
                              <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-secondary">Valider</button>
                              </div>
                         </form>
                        </div>
                      </div>
                    </div>';
    echo ($modalSuppressionFestival);
}
?>

<div class="vignetteFestival col-sm-3">
<button type="button" class="btn btn-default btn-circle btn-lg"  data-toggle="modal" data-target="#ajouterFestivalModal"><i class="glyphicon glyphicon-plus"></i></button>
</div>

