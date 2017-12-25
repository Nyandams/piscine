<!-- js pour les tableaux-->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

<!-- Modal -->
<div class="modal fade" id="ajouterEditeurModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel">Ajouter éditeur</h5>
      </div>

      <form method="POST" action="Editeur/ajouterEditeur">
        <div class="modal-body">

          <div class="form-group">
            <label for="nomEditeur">Nom de l'éditeur</label>
            <input type="text" class="form-control" id="nomEditeur" name="nomEditeur" placeholder="Entrer le nom">
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

<!-- Table Editeur -->
<table id="tabEditeur" class="table table-striped table-bordered col-sm-12 text-left" cellspacing="0" width="100%">
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
                        <label class="col-lg-6 ">' . $editeur->getLibelleEditeur() . '</label>
                        <span class="pull-right">
                        <a class="btn btn-primary" href="modifierEditeur?idEditeur='.$idEditeur . '" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                        <a class="btn btn-primary" href="supprimerEditeur?idEditeur='.$idEditeur .'" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                        </span>
                        </td>';
                    $ligne = $ligne . '</tr>';
                    
                    echo  $ligne;
                }
                

            ?>

            
        </tbody>
    </table>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajouterEditeurModal">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
    </button>


    <!--
    <form method="POST" action="ajouterEditeur">
    
      <div class="form-group">
        <label for="nomJeu">Nom du jeu</label>
        <input type="text" class="form-control" id="nomJeu" name="nomJeu" placeholder="Entrer le nom">
      </div>
      <button type="submit" class="btn btn-secondary">Sauvegarder</button>
    </form>
     -->
   
    <script type="text/javascript" >        
        $(document).ready(function() {
            // Javascript de la table de base
            $('#tabEditeur').DataTable();
        });

       

    </script>