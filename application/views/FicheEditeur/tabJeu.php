<!-- js pour les tableaux-->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

<!-- Modal -->
<div class="modal fade" id="ajouterJeuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un jeu</h5>
            </div>

            <form method="POST" action=<?php echo 'ficheEditeur/ajouterJeu?idFicheEditeur='.  $idFicheEditeur ?>>
                <div class="container-fluid">
                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <label for="nomJeu">Nom</label>
                            <input type="text" class="form-control" id="nomJeu" name="nomJeu" placeholder="Entrer le nom du jeu">
                        </div>
                    </div>
                    
                    <div class="form-row">
                    	<div class="form-group col-sm-6">
                            <label for="nbMinJoueurJeu">Nombre minimum de joueur</label>
                            <input type="number" class="form-control" id="nbMinJoueurJeu" name="nbMinJoueurJeu" placeholder="Nombre mini">
                        </div>
                        
                        <div class="form-group col-sm-6">
                            <label for="nbMaxJoueurJeu">Nombre maximum de joueur</label>
                            <input type="number" class="form-control" id="nbMaxJoueurJeu" name="nbMaxJoueurJeu" placeholder="Nombre max">
                        </div>                    
                    </div>


                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <label for="noticeJeu">Notice du jeu</label>
                            <input type="text" class="form-control" id="noticeJeu" name="noticeJeu" placeholder="Lien vers la notice du jeu">
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

<!-- Table Jeu -->
<h3><label class="label label-default">Jeux</label></h3>
<table id="tabJeu" class="table table-striped table-bordered col-sm-12 text-left" cellspacing="0" width="100%">
        <!-- Entete du tableau -->
        <thead>
            <tr>
                <th>Jeu</th>
                <th>Type</th>
                <th>Table</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Jeu</th>
                <th>Type</th>
                <th>Table</th>
            </tr>
        </tfoot>
        <tbody>
            
            <!-- Insertion des données de manière dynamique -->
            <?php
                
                // Récupération des données
                $ligne = ''; // Stocke une ligne le temps de la créer
                
                foreach ($jeux as $key => $jeu) {
                    $idJeu = $jeu->getIdJeu();
                    $nomJeu = $jeu->getLibelleJeu();
                    $typeJeu = $jeu->getIdTypeJeu();
                    $nbPlaceMax = $jeu->getNbMaxJoueurJeu();

                    // Chaque tour de boucle crée une ligne pour la table, avec les informations d'un Jeu.
                    $ligne = '<tr>';

                    $ligne = $ligne . '<td>' . $nomJeu . '</td>';
                    $ligne = $ligne . '<td>' . $typeJeu . '</td>';
                    

                    // On ajoute le bouton supprimer et modifier dans la dernière colonne.
                    $ligne = $ligne . '<td class="row">
                        <label class="col-lg-6">' . $nomJeu . '</label>
                        <span class="pull-right">
                        <a class="btn btn-primary" href="FicheEditeur/modifierJeu?idJeu='.$idJeu . '&idFicheEditeur=' . $idFicheEditeur .'" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                        <a class="btn btn-primary" href="FicheEditeur/supprimerJeu?idJeu='.$idJeu . '&idFicheEditeur=' . $idFicheEditeur .'" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                        </span>
                        </td>';
                    $ligne = $ligne . '</tr>';
                    
                    echo  $ligne;
                }

            ?>

        </tbody>
    </table>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajouterJeuModal">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
    </button>
   
    <script type="text/javascript" >        
        $(document).ready(function() {
            // Javascript de la table de base
            $('#tabJeu').DataTable();
        });
    </script>