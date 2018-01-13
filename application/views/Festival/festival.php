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
    $panel = 
           '<a href="#">
                <div class="panel panel-default vignetteFestival col-sm-3">
                    <div class="panel-heading">
                        <h3 class="panel-title">'.$festival->getAnneeFestival().'</h3>
                    </div>
      		        <div class="panel-body">
                       <p>Nb Emplacements : '.$festival->getNbEmplacementTotal().'</p>
                       <p>Prix de l\'emplacement : '.$festival->getPrixEmplacementFestival().'</p>
                       <p>Emplacements restants : '. $festival->getNbEmplacementsRestant() .'</p>
                    </div>
                </div>
            </a>';
    
    echo $panel;
}
?>

<div class="vignetteFestival col-sm-3">
<button type="button" class="btn btn-default btn-circle btn-lg"  data-toggle="modal" data-target="#ajouterFestivalModal"><i class="glyphicon glyphicon-plus"></i></button>
</div>

