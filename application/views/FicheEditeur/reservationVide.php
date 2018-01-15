<h3><label class="label label-default">Reservations</label></h3>

<!-- Modal -->
<div class="modal fade" id="ajouterReservationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un festival</h5>
            </div>
            
            <form method="POST" action="<?php echo site_url('ficheEditeur/creerReservation?idFicheEditeur=' .$idFicheEditeur);?>">
                <div class="modal-body">
                    <div class="form-group">
                        
                        <label for="nbEmplacement">Nombre d'emplacement</label>
                        <input type="text" class="form-control" id="nbEmplacement" name="nbEmplacement" placeholder="nombre d'emplacement">
                                
                        <label for="prix">Prix négocié ?</label>
                        <input type="text" class="form-control" id="prix" name="prix">
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

<div class="vignetteFestival col-sm-3">
<button type="button" class="btn btn-default btn-circle btn-lg"  data-toggle="modal" data-target="#ajouterReservationModal"><i class="glyphicon glyphicon-plus"></i></button>
</div>