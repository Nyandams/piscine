<h1 id="titreInterface">Contacts : </h1>
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
                <h5 class="modal-title" id="exampleModalLabel">Ajouter éditeur</h5>
            </div>

            <form method="POST" action="Contact/ajouterContact">
                <div class="container-fluid">
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label for="nomContact">Nom</label>
                            <input type="text" class="form-control" id="nomContact" name="nomContact" placeholder="Entrer le nom">
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="prenomContact">Prenom</label>
                            <input type="text" class="form-control" id="prenomContact" name="prenomContact" placeholder="Entrer le prenom">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-sm-8">
                            <label for="adresseMail">Adresse email</label>
                            <input type="mail" class="form-control" id="adresseMail" name="adresseMail" placeholder="Entrer l'email">
                        </div>

                        <div class="form-group col-sm-4">
                            <label for="numTelephone">Numéro téléphone</label>
                            <input type="text" class="input-medium bfh-phone form-control" data-format="+1 (ddd) ddd-dddd" id="numTelephone" name="numTelephone" placeholder="Entrer le numéro de téléphone">
                        </div>
                    </div>
                  
                    <div class="form-row">
                        <div class="col-sm-6">
                            <label for="adresse">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Entrer l'adresse">
                        </div>

                        <div class="col-sm-3">
                            <label for="codePostal">Code postal</label>
                            <input type="text" class="form-control" id="codePostal" name="codePostal" placeholder="Entrer le code postal">
                        </div>

                        <div class="col-sm-3">
                            <label for="ville">Ville</label>
                            <input type="text" class="form-control" id="ville" name="ville" placeholder="Entrer la ville">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-sm-8">
                            <label for="selectEditeur">Chez quel éditeur travail ce contact ?</label>
                            <select class="selectEditeur" name="selectEditeur">

                                <?php
                                // Affichage des différents éditeurs.
                                $selection = '';
                                foreach ($EditeurDto as $key => $EditContact) {
                                    $selection = $selection . "<option>";
                                    $libEditeur = $EditContact->getLibelleEditeur();
                                    $selection = $selection . $libEditeur . "</option>";
                                }

                                echo ($selection);
                                ?>
                            </select>
                            <label for="selectEditeur">Contact principal ?</label>
                            <select class="selectPrincipal" name="selectPrincipal">
                                <option>Oui</option>
                                <option>Non</option>  
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
<table id="tabContact" class="table table-striped table-bordered col-sm-12 text-left" cellspacing="0" width="100%">
        <!-- Entete du tableau -->
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Adresse</th>
                <th>Editeur</th> <!-- Nom de l'édtieur -->
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Adresse</th>
                <th>Editeur</th> <!-- Nom de l'édtieur -->
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
                    $telContact = $EditContact->getTelephoneContact();

                    // Chaque tour de boucle crée une ligne pour la table, avec les informations d'un contact.
                    $ligne = '<tr>';

                    $ligne = $ligne . '<td>' . $nomContact . '</td>';
                    $ligne = $ligne . '<td>' . $prenomContact . '</td>';
                    $ligne = $ligne . '<td>' . $mailContact . '</td>';
                    $ligne = $ligne . '<td>' . $telContact . '</td>';
                    $ligne = $ligne . '<td>' . $villeContact . '</td>';

                    // On ajoute le bouton supprimer et modifier dans la dernière colonne.
                    $ligne = $ligne . '<td class="row">
                        <label class="col-lg-6">' . $libelleEditeur . '</label>
                        <span class="pull-right">
                        <a class="btn btn-primary" data-toggle="modal" data-target="#modifierContactModal_'. $idContact .'" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                        <a class="btn btn-primary" href="supprimerContact?idContact='.$idContact .'" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                        </span>
                        </td>';
                    $ligne = $ligne . '</tr>';
                    
                    echo  $ligne;
                    
                    // préparation de la selection multiple (fait au dessus sinon galere au milieu
                    if ($estPrincipalContact == 0 ){
                        $choixOption = '<option value=1>Oui</option>
                        <option value=0 selected="selected" >Non</option>';
                    }
                    elseif ($estPrincipalContact == 1) {
                        $choixOption = '<option value=1 selected="selected" >Oui</option>
                        <option value=0>Non</option>';
                    }
                    
                    $modalModif =
                    '<div class="modal fade" id="modifierContactModal_'. $idContact . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h5 class="modal-title" id="exampleModalLabel">Ajouter éditeur</h5>
                                </div>
                                
                                <form id="formContact" method="POST" action="' . site_url ("Contact/modifierContact?idContact=" . $idContact) . '">
                                    <div class="container-fluid">
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                                <label for="nomContact">Nom</label>
                                                <input type="text" value="' . $nomContact . '" class="form-control" id="nomContact" name="nomContact" placeholder="Entrer le nom">
                                            </div>
                                    
                                            <div class="form-group col-sm-6">
                                                <label for="prenomContact">Prenom</label>
                                                <input type="text" value="' . $prenomContact  .'" class="form-control" id="prenomContact" name="prenomContact" placeholder="Entrer le prenom">
                                            </div>
                                        </div>
                    
                                        <div class="form-row">
                                            <div class="form-group col-sm-8">
                                                <label for="adresseMail">Adresse email</label>
                                                <input type="mail" value ="' . $mailContact . '" class="form-control" id="adresseMail" name="adresseMail" placeholder="Entrer l email">
                                            </div>
                    
                                            <div class="form-group col-sm-4">
                                                <label for="numTelephone">Numéro téléphone</label>
                                                <input type="text" value ="' . $telContact . '" class="input-medium bfh-phone form-control" data-format="+1 (ddd) ddd-dddd" id="numTelephone" name="numTelephone" placeholder="Entrer le numéro de téléphone">
                                            </div>
                                        </div>
                    
                                        <div class="form-row">
                                            <div class="col-sm-6">
                                                <label for="adresse">Adresse</label>
                                                <input type="text" value ="' . $rueContact . '" class="form-control" id="adresse" name="adresse" placeholder="Entrer l adresse">
                                            </div>
                        
                                            <div class="col-sm-3">
                                                <label for="codePostal">Code postal</label>
                                                <input type="text" value ="' . $cpContact . '" class="form-control" id="codePostal" name="codePostal" placeholder="Entrer le code postal">
                                            </div>
                        
                                            <div class="col-sm-3">
                                                <label for="ville">Ville</label>
                                                <input type="text" value ="' . $villeContact . '" class="form-control" id="ville" name="ville" placeholder="Entrer la ville">
                                            </div>
                                        </div>
                        
                                        <div class="form-row">
                                            <div class="col-sm-8">
                                                <label for="selectPrincipal">Contact principal ?</label>
                                                <select class="selectPrincipal" name="selectPrincipal">
                                                    ' . $choixOption  . '
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
                    </div>';
                    echo ($modalModif);
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