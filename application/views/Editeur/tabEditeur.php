<!-- js pour les tableaux-->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

<table id="tabEditeur" class="table table-striped table-bordered col-sm-10 text-left" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Libellé</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Id</th>
                <th>Libellé</th>
            </tr>
        </tfoot>
        <tbody>
            
            <!-- Insertion des données de manière dynamique -->
            <?php
                
                // Récupération des données
                $ligne = ''; // Stocke une ligne le temps de la créer
                foreach ($editeursDto as $key => $editeur) {
                    $idEditeur = $editeur->getIdEditeur();
                    
                    // Chaque tour de boucle crée une ligne pour la table, avec les informations d'un éditeur.
                    $ligne = '<tr>';

                    $ligne = $ligne . '<td>' . $idEditeur . '</td>';

                    // On ajoute le bouton supprimer et modifier dans la dernière colonne.
                    $ligne = $ligne . '<td class="row">
                        <label class="col-lg-8">' . $editeur->getLibelleEditeur() . '</label>
                        <a class="btn btn-primary" href="modifierEditeur?idEditeur='.$idEditeur . '" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                        <a class="btn btn-primary" href="supprimerEditeur?idEditeur='.$idEditeur .'" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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
            $('#tabEditeur').DataTable();
        });

       

    </script>