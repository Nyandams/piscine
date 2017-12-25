<!-- js pour les tableaux-->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

<!-- Modal -->
<div class="modal fade" id="ajouterContactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel">Ajouter contact</h5>
      </div>

    </div>
  </div>
</div>

<!-- Table Contact -->
<table id="tabContact" class="table table-striped table-bordered col-sm-12 text-left" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id contact</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Adresse email</th>
                <th>Adresse</th>
                <th>Travail chez</th> <!-- Nom de l'édtieur -->
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Id contact</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Adresse email</th>
                <th>Adresse</th>
                <th>Travail chez</th> <!-- Nom de l'édtieur -->
            </tr>
        </tfoot>
        <tbody>
            
            <!-- Insertion des données de manière dynamique -->
            <?php
                
                // Récupération des données
                $ligne = ''; // Stocke une ligne le temps de la créer
                foreach ($ContactsEditeursDto as $key => $EditContact) {
                    $idContact = $EditContact->getIdContact();
                    $estPrincipalContact = $EditContact->getEstPrincipalContact();
                    $nomContact = $EditContact->getNomContact();
                    $prenomContact = $EditContact->getPrenomContact();
                    $mailContact = $EditContact->getMailContact();
                    $rueContact = $EditContact->getRueContact();
                    $villeContact = $EditContact->getVilleContact();
                    $cpContact = $EditContact->getCpContact();
                    $libelleEditeur = $EditContact->getLibelleEditeur();

                    // Chaque tour de boucle crée une ligne pour la table, avec les informations d'un contact.
                    $ligne = '<tr>';

                    $ligne = $ligne . '<td>' . $idContact . '</td>';
                    $ligne = $ligne . '<td>' . $estPrincipalContact . '</td>';
                    $ligne = $ligne . '<td>' . $nomContact . '</td>';
                    $ligne = $ligne . '<td>' . $prenomContact . '</td>';
                    $ligne = $ligne . '<td>' . $mailContact . '</td>';
                    $ligne = $ligne . '<td>' . $villeContact . '</td>';

                    // On ajoute le bouton supprimer et modifier dans la dernière colonne.
                    $ligne = $ligne . '<td class="row">
                        <label class="col-lg-6">' . $libelleEditeur . '</label>
                        <span class="pull-right">
                        <a class="btn btn-primary" href="modifierContact?idContact='.$idContact . '" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                        <a class="btn btn-primary" href="supprimerContact?idContact='.$idContact .'" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                        </span>
                        </td>';
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
            $('#tabContact').DataTable();
        });

       

    </script>