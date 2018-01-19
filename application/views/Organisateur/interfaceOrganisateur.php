<!-- Modal de modification pour l'organisateur -->
<div class="modal fade" id="ajouterContactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un organisateur</h5>
            </div>

            <form id="formAjoutOrga" method="POST" action="<?php echo 'organisateur/modifierOrganisateur' ?>">
                <div class="container-fluid">
                    <div class="form-row">
                        
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




<!-- Table organisateur -->
<h3><label class="label label-default">Organisateur</label></h3>
<table id="tabContact" class="table table-striped table-bordered col-sm-12 text-left" cellspacing="0" width="100%">
        <!-- Entete du tableau -->
        <thead>
            <tr>
                <th>Login</th>
                <th>Est admin</th>
            </tr>
        </thead>
        <tbody>
        
        <!-- Insertion des données de manière dynamique -->
            <?php
                
                // Récupération des données
                $ligne = ''; // Stocke une ligne le temps de la créer
                foreach ($ContactDTO as $key => $EditContact) {
                    
 

         
                    $ligne = '<tr>';
  
                    $ligne = $ligne . '<td>' .  . '</td>';
                    $ligne = $ligne . '<td>' .  . '</td>';
                    

                    // On ajoute le bouton supprimer et modifier dans la dernière colonne.
                    $ligne = $ligne . '<td class="row">
                        <label class="col-lg-6">' .  . '</label>
                        <span class="pull-right">
                        <a class="btn btn-primary" data-toggle="modal" data-target="#modifierOrganisateurModal_' . $idOrganisateur .'" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                        <a class="btn btn-primary" data-toggle="modal" data-target="#supprimerVerifModal_' . $idOrganisateur .'" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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
                    '<div class="modal fade" id="modifierContactModal_'. ($idContact) . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h5 class="modal-title" id="exampleModalLabel">Ajouter contact</h5>
                                </div>
                        
                                <form id="formContact" method="POST" action="ficheEditeur/modifierContact?idFicheEditeur=' .  $idFicheEditeur . '&idContact=' . $idContact .'">
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
                                                <input type="text" value ="' . $telContact . '" class="input-medium bfh-phone form-control" data-format="+1 (ddd) ddd-dddd" id="numTelephone" name="numTelephone" placeholder="Entrer le numéro">
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
                    
                    modalVerif= '<!-- Modal de modification pour lorganisateur -->
                        <div class="modal fade" id="supprimerVerifModal_" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h5 class="modal-title" id="exampleModalLabel">Ajouter un organisateur</h5>
                                    </div>
                        
                                    <form id="formAjoutOrga" method="POST" action="'.organisateur/modifierOrganisateur.'">
                                        <div class="container-fluid">
                                            <div class="form-row">
                                                
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
            
            
        </tbody>
    </table>


<!-- Modal d'ajout d'un organisateur -->
<div class="modal fade" id="ajouterOrganisateurModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel">Ajouter Organisateur</h5>
      </div>

      <form method="POST" action="Organisateur/ajoutOrganisateur">
        <div class="modal-body">

    		<label for="pseudo">Pseudo</label>
            <input type="text" id="pseudo" name="pseudo" class="form-control" placeholder="pseudo" value="">
            <?php echo form_error('pseudo'); ?>
            
        	<label for="mdp">Mot de passe</label>
            <input type="password" id="mdp" name="mdp" class="form-control" placeholder="mot de passe" value="">
            <?php echo form_error('mdp'); ?>
            
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" class="form-control" placeholder="nom" value="">
            <?php echo form_error('nom'); ?>
            
            <label for="prenom">Prenom</label>
            <input type="text" id="prenom" name="prenom" class="form-control" placeholder="prenom" value="">
            <?php echo form_error('prenom'); ?>
          
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btn-secondary">Sauvegarder</button>
        </div>

      </form>
    </div>
  </div>
</div>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajouterOrganisateurModal">
	<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
</button>
	
	

</div>


