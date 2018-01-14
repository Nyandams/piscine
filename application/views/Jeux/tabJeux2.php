<h1 id="titreInterface">Jeux : </h1>

<!-- js pour les tableaux-->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

<!-- Table Jeux -->
<table id="tabJeux" class="table table-striped table-bordered col-sm-12 text-left" cellspacing="0" width="100%">
        <!-- Entete du tableau -->
        <thead>
            <tr>
                <th>Nom du jeu</th>
                <th>Type du jeu</th>
                <th>Nombre Joueur Min</th>
                <th>Nombre Joueur Max</th>
		<th>Notice</th>
                <th>Appartient à</th> <!-- Nom de l'édtieur -->
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Nom du jeu</th>
                <th>Type du jeu</th>
                <th>Nombre Joueur Min</th>
                <th>Nombre Joueur Max</th>
		<th>Notice</th>
                <th>Appartient à</th> <!-- Nom de l'édtieur -->
            </tr>
        </tfoot>
        <tbody>
            
            <!-- Insertion des données de manière dynamique -->
            <?php
                
                // Récupération des données
                $ligne = ''; // Stocke une ligne le temps de la créer
                foreach ($JeuxEditeursDto as $key => $EditJeu) {
                    $idJeu = $EditJeu->getIdJeu();
                    $libelleJeu = $EditJeu->getLibelleJeu();
		    $idTypeJeu = $EditJeu->getIdTypeJeu();
                    $nbMinJoueurJeu = $EditJeu->getNbMinJoueurJeu();
                    $nbMaxJoueurJeu = $EditJeu->getNbMaxJoueurJeu();
		    $noticeJeu = $EditJeu->getNoticeJeu();
                    $idEditeur = $EditJeu->getIdEditeur();
                    

                    // Chaque tour de boucle crée une ligne pour la table, avec les informations d'un jeu.
                    $ligne = '<tr>';
                    $ligne = $ligne . '<td>' . $libelleJeu     . '</td>';
		    $ligne = $ligne . '<td>' . $idTypeJeu      . '</td>';
                    $ligne = $ligne . '<td>' . $nbMinJoueurJeu . '</td>';
                    $ligne = $ligne . '<td>' . $nbMaxJoueurJeu . '</td>';
                    $ligne = $ligne . '<td>' . $noticeJeu      . '</td>';
                    $ligne = $ligne . '<td>' . $idEditeur      . '</td>';

 
/*                    // On ajoute le bouton supprimer et modifier dans la dernière colonne.
                    $ligne = $ligne . '<td class="row">
                        <label class="col-lg-6">' . $libelleEditeur . '</label>
                        <span class="pull-right">
                        <a class="btn btn-primary" data-toggle="modal" data-target="#modifierContactModal_'. $idContact .'" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                        <a class="btn btn-primary" href="supprimerContact?idContact='.$idContact .'" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                        </span>
                        </td>';*/
                    $ligne = $ligne . '</tr>';
                    
                    echo  $ligne;
                    

		}
                    ?>

        </tbody>
    </table>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajouterContactModal">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
    </button>
   
    <script type="text/javascript" >        
        $(document).ready(function() {
            // Javascript de la table de base
            $('#tabJeux').DataTable();
        });
    </script>
