<!-- js pour les tableaux-->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

<!-- Modal ajouter reserver -->
<div class="modal fade" id="ajouterReserverModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Ajouter éditeur</h5>
            </div>

            <form method="POST" action="<?php echo (site_url("FicheEditeur/ajouterReserver?idFicheEditeur=" . $idFicheEditeur));?>">
                <div class="container-fluid">
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label for="selectJeu">Quel jeu ?</label>
                            <select class="selectJeu" name="selectJeu">
                                <?php
                                // Affichage des différents éditeurs.
                                $selection = '';
                                foreach ($jeux as $key => $jeu) {
                                    $selection = $selection . '<option value="'. $jeu->getIdJeu() . '">';
                                    $libEditeur = $jeu->getLibelleJeu();
                                    $selection = $selection . $libEditeur . "</option>";
                                }

                                echo ($selection);
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="selectQuantite">Combien de jeu ?</label>
                            <input type="number" class="form-control" id="selectQuantite" name="selectQuantite" placeholder="Entrer la quantité">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <label for="selectDotation">Dotation ?</label>
                            <select class="selectDotation" name="selectDotation">
                            	<option value="1">Oui</option>
                            	<option value="0">Non</option>
                            </select>
                         </div>
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

<!-- Table Contact -->
<h3><label class="label label-default">Reservations</label></h3>
<table id="tabReserver" class="table table-striped table-bordered col-sm-12 text-left" cellspacing="0" width="100%">
        <!-- Entete du tableau -->
        <thead>
            <tr>
                <th>Jeu</th>
                <th>Quantite</th> 
                <th>Recu ?</th>
                <th>Type Jeu</th> 
            </tr>
        </thead>
        <tfoot>
            <tr>
               <th>Jeu</th>
                <th>Quantite</th> 
                <th>Recu ?</th>
                <th>Type Jeu</th> 
            </tr>
        </tfoot>
        <tbody>
            
            <!-- Insertion des données de manière dynamique -->
            <?php
                
                // Récupération des données
                $ligne = ''; // Stocke une ligne le temps de la créer
                foreach ($reservations as $key => $reservation) {
                    $jeuDTO = $reservation->getJeuDTO();
                    $reserverDTO = $reservation->getReserverDTO();
                    $typeJeuDTO = $reservation->getTypeJeu();
                    
                    
                    $idJeu = $jeuDTO->getIdJeu();
                    $nomJeu = $jeuDTO->getLibelleJeu();
                    $qteJeu = $reserverDTO->getQuantiteJeuReserver();
                    $recu = $reserverDTO->getReceptionJeuReserver();
                    $typeJeu = $jeuDTO->getIdTypeJeu();

                    $quantiteJeu = $reserverDTO->getQuantiteJeuReserver();

                    // Chaque tour de boucle crée une ligne pour la table, avec les informations d'un contact.
                    $ligne = '<tr>';
  
                    $ligne = $ligne . '<td>' . $nomJeu . '</td>';
                    $ligne = $ligne . '<td>' . $qteJeu . '</td>';
                    $ligne = $ligne . '<td>' . $recu . '</td>';
                    

                    // On ajoute le bouton supprimer et modifier dans la dernière colonne.
                    $ligne = $ligne . '<td class="row">
                        <label class="col-lg-6">' . '0' . '</label>
                        <span class="pull-right">
                        <a class="btn btn-primary" href="modifierRes?idContact=' . '" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                        <a class="btn btn-primary" href="' . site_url("FicheEditeur/SupprimerJeu?idJeu=" . $idJeu . "&idFicheEditeur=" . $idFicheEditeur) . '" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                        </span>
                        </td>';
                    $ligne = $ligne . '</tr>';
                    
                    echo  $ligne;
                }
            ?>

        </tbody>
    </table>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajouterReserverModal">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
    </button>
   
    <script type="text/javascript" >        
        $(document).ready(function() {
            // Javascript de la table de base
            $('#tabReserver').DataTable();
        });
    </script>