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

            <form method="POST" action= <?php echo site_url('Editeur/ajouterEditeur')?>>
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
            <th>Editeur</th>
            <th>Contact principal</th>
            <th>Telephone</th>
            <th>Mail</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Editeur</th>
            <th>Contact principal</th>
            <th>Telephone</th>
            <th>Mail</th>
        </tr>
    </tfoot>
    <tbody>

        <!-- Insertion des données de manière dynamique -->
        <?php
                // Récupération des données
                $ligne = ''; // Stocke une ligne le temps de la créer
                
                foreach ($editeursDTO as $key => $editeur) {
                    
                    $idEditeur = $editeur->getIdEditeur();
                    $nomEditeur = $editeur->getLibelleEditeur();
                    if (!is_null($editeur->getIdContact())){
                        $idContact = $editeur->getIdContact();
                        $nomContact = $editeur->getNomContact();
                        $mailContact = $editeur->getMailContact();
                        $numContact = $editeur->getTelephoneContact();
                    }
                    else {
                        $idContact = "";
                        $nomContact = "";
                        $mailContact = "";
                        $numContact = "";
                    }
                    
                    
                    // Chaque tour de boucle crée une ligne pour la table, avec les informations d'un éditeur.
                    $ligne = '<tr>';

                    $ligne = $ligne . '<td><a  href="' . site_url('ficheEditeur?idFicheEditeur='. $idEditeur ) . '" >' . $nomEditeur . '</a></td>';
                    $ligne = $ligne . '<td><a  href="contact">' . $nomContact . '</a></td>';
                    $ligne = $ligne . '<td>' . $numContact . '</td>';
              

                    // On ajoute le bouton supprimer et modifier dans la dernière colonne.
                    $ligne = $ligne . '<td class="row">
                    <label class="col-lg-6 ">' . $mailContact . '</label>
                    <span class="pull-right">
                    <a class="btn btn-primary pull-right" data-toggle="modal" data-target="#modifierEditeurModal_' . $idEditeur .'" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                    <a class="btn btn-primary pull-right" href="'. site_url('Editeur/supprimerEditeur?idEditeur=') . $idEditeur .'" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                    </span>
                    </td>';
                    $ligne = $ligne . '</tr>';
                    
                    echo  $ligne;
                    
                    $modalModifEditeur ='
                    <div class="modal fade" id="modifierEditeurModal_' . $idEditeur .'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h5 class="modal-title" id="exampleModalLabel">Ajouter éditeur</h5>
                                </div>
                    
                                <form method="POST" action="' . site_url("Editeur/modifierEditeur?idEditeur=" . $idEditeur) . '">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nomEditeur">Nom de l éditeur</label>
                                            <input type="text" value="' . $nomEditeur . '" class="form-control" id="nomEditeur" name="nomEditeur" placeholder="Entrer le nom">
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
                    echo $modalModifEditeur;
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