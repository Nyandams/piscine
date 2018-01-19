<h1 id="titreInterface">Jeux : </h1>

<!-- js pour les tableaux-->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>


<!--Modal -->
<?php 
$admin = $this->session->userdata('admin');?>
<?php 
    if ($admin == 1){
        echo '
<div class="modal fade" id="ajouterJeuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un jeu</h5>
            </div>

            <form method="POST" action="'.site_url('Jeux/ajouterJeu') .'">
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

                    <div class="form-row">
                        <div class="col-sm-8">
                            <label for="selectEditeur">A quel éditeur appartient ce jeu ?</label>
                            <select class="selectEditeur" name="selectEditeur">';

                                
                // Affichage des différents éditeurs.
                $selection = '';
                foreach ($EditeurDto as $key => $EditJeu) {
                    $selection = $selection . "<option>";
                    $libEditeur = $EditJeu->getLibelleEditeur();
                    $selection = $selection . $libEditeur . "</option>";
                }
                echo ($selection);

             echo '</select>


			</div>
                    </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-secondary">Sauvegarder</button>
                </div> 
            </form>
        </div>
    </div>
</div>';
    }


?>






<!-- Table Jeux -->
<table id="tabJeux" class="table table-striped table-bordered col-sm-12 text-left" cellspacing="0" width="100%">
        <!-- Entete du tableau -->
        <thead>
            <tr>
                <th>Nom du jeu</th>

                <th>Nombre Joueur Min</th>
                <th>Nombre Joueur Max</th>
		<th>Notice</th>
                <th>Appartient à</th> <!-- Nom de l'édtieur -->
            </tr>
        </thead>

        <tbody>
            
            <!-- Insertion des données de manière dynamique -->
            <?php
                
                // Récupération des données
                $ligne = ''; // Stocke une ligne le temps de la créer

                foreach ($JeuxEditeursDto as $key => $EditJeu) {
        		    $idJeu = $EditJeu->getIdJeu();
                            $libelleJeu = $EditJeu->getLibelleJeu();
                            /*$idZone = $EditJeu->getIdZone();*/
                            $nbMinJoueurJeu = $EditJeu->getNbMinJoueurJeu();
                            $nbMaxJoueurJeu = $EditJeu->getNbMaxJoueurJeu();
        		    $noticeJeu = $EditJeu->getNoticeJeu();
                            $idEditeurJeu = $EditJeu->getIdEditeur();
        
        		    foreach ($EditeurDto as $key => $Edit){
            			$idEditeur = $Edit->getIdEditeur();
            			if ($idEditeur==$idEditeurJeu){
            
            			    $libelleEditeur = $Edit->getLibelleEditeur();
            			}
		              }

                    // Chaque tour de boucle crée une ligne pour la table, avec les informations d'un jeu.
                    $ligne = '<tr>';
                    $ligne = $ligne . '<td>' . $libelleJeu     . '</td>';
                    $ligne = $ligne . '<td>' . $nbMinJoueurJeu . '</td>';
                    $ligne = $ligne . '<td>' . $nbMaxJoueurJeu . '</td>';
                    if($noticeJeu == ""){
                        $ligne = $ligne . '<td>  </td>';
                    }else{
                        $ligne = $ligne . '<td>  <a href="'.$noticeJeu.'"> ici  </a></td>';
                    }
                    


                    // On ajoute le bouton supprimer et modifier dans la dernière colonne.
                    $ligne = $ligne . '<td class="row">
                        <label class="col-lg-6">' . $libelleEditeur . '</label>
                        <span class="pull-right">';

                        if ($admin == 1){
                            echo '<a class="btn btn-primary" href="'.site_url('Jeux/supprimerJeu?idJeu='.$idJeu).'" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
                        }
                        
                        $ligne = $ligne . '</span>
                        </td>';
                    
                    
                    $ligne = $ligne . '</tr>';
                    
                    echo  $ligne;
                    

		}

                ?>





        </tbody>
    </table>
   
    <script type="text/javascript" >        
        $(document).ready(function() {
            // Javascript de la table de base
            $('#tabJeux').DataTable();
        });
    </script>
