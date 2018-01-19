<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>



<!-- Table organisateur -->
<h3><label class="label label-default">Organisateur</label></h3>
<table id="tabOrganisateur" class="table table-striped table-bordered col-sm-12 text-left" cellspacing="0" width="100%">
        <!-- Entete du tableau -->
        <thead>
            <tr>
                <th>Login</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Est admin</th>
            </tr>
        </thead>
        <tbody>
        
        <!-- Insertion des données de manière dynamique -->
            <?php
            
                
                // Récupération des données
                $ligne = ''; // Stocke une ligne le temps de la créer
                foreach ($organisateurCollection as $key => $organisateurDTO) {
                    $idOrga = $organisateurDTO->getIdOrganisateur();
                    $nomOrga = $organisateurDTO->getNomOrganisateur();
                    $prenomOrga = $organisateurDTO->getPrenomOrganisateur();
                    $loginOrga = $organisateurDTO->getLoginOrganisateur();
                    $estAdmin = $organisateurDTO->getAdmin();
                    
                    // Préparation de est Admin
                    $estAdminTxt = '';
                    if ($estAdmin) {
                        $estAdminTxt = "Oui";
                    }else {
                        $estAdminTxt = "Non";
                    }
                    
                  
 
                    $ligne = '<tr>';
  
                    $ligne = $ligne . '<td>' . $loginOrga . '</td>';
                    $ligne = $ligne . '<td>' . $nomOrga . '</td>';
                    $ligne = $ligne . '<td>' . $prenomOrga . '</td>';
                    
                    // On ajoute le bouton supprimer et modifier dans la dernière colonne.
                    $ligne = $ligne . '<td class="row">
                        <label class="col-lg-6">' . $estAdminTxt . '</label>
                        <span class="pull-right">
                        <a class="btn btn-primary" data-toggle="modal" data-target="#modifierOrganisateurModal_' . $idOrga .'" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                        <a class="btn btn-primary" data-toggle="modal" data-target="#supprimerVerifModal_' . $idOrga .'" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                        </span>
                        </td>';
                    $ligne = $ligne . '</tr>';
                    
                    echo  $ligne;
                    
                    // préparation de la selection multiple (fait au dessus sinon galere au milieu 
                    if ($estAdmin == 0 ){
                        $choixOption = '<option value=1>Oui</option>
                        <option value=0 selected="selected" >Non</option>';
                    }
                    elseif ($estAdmin == 1) {
                        $choixOption = '<option value=1 selected="selected" >Oui</option>
                        <option value=0>Non</option>';
                    }
                    
                    $modalModif = 
'<div class="modal fade" id="modifierOrganisateurModal_'. $idOrga .'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un organisateur</h5>
            </div>
                            
            <form id="formAjoutOrga" method="POST" action="'. site_url('organisateur/modificationOrganisateur?login=' . $loginOrga) .'">
                <div class="container-fluid">
            
                    <div class="form-row">
                        <label for="pseudo">Login</label>
                        <input type="text" id="pseudo" name="pseudo" class="form-control" placeholder="pseudo" value="'. $loginOrga .'">
                        '.form_error('pseudo') .'

                          <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" class="form-control" placeholder="nom" value="'. $nomOrga .'">
                        '.form_error('nom') .'
                        
                        <label for="prenom">Prenom</label>
                        <input type="text" id="prenom" name="prenom" class="form-control" placeholder="prenom" value="'. $prenomOrga .'">
                       '.form_error('prenom') .'


                        <label for="mdp">Mot de passe</label>
                        <input type="password" id="mdp" name="mdp" class="form-control" placeholder="Entre le mot de passe" value="">
                       '. form_error('mdp').'
                        
                        <label for="mdp">verifmdp</label>
                        <input type="password" id="verifmdp" name="verifmdp" class="form-control" placeholder="Verification du mot de passe" value="">
                       '. form_error('verifmdp').'
 
                        <label for="selectEstAdmin">Est admin ?</label>
                        <select class="selectEstAdmin" name="selectEstAdmin">
                            ' . $choixOption . '
                        </select>                        
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
                    
                    $modalVerif= 
                    '<!-- Vérification de la suppression -->
                        <div class="modal fade" id="supprimerVerifModal_' . $idOrga .'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h5 class="modal-title" id="exampleModalLabel">Supprimer l\'organisateur '. $loginOrga .' ?</h5>
                                    </div>
                        
                                    <form id="formAjoutOrga" method="POST" action="'. site_url('organisateur/supprimerOrganisateur') .'">
                                         <input type="hidden" id="idSuppEditeur" name="idSuppEditeur" class="form-control" value="'. $loginOrga .'">
                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                            <button type="submit" class="btn btn-secondary">Supprimer</button>
                                        </div> 
                                    </form>
                                </div>
                            </div>
                        </div>';
                    
                    echo $modalVerif;
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
        <h5 class="modal-title" id="exampleModalLabel">Ajouter un organisateur</h5>
      </div>

      <form method="POST" action="Organisateur/ajoutOrganisateur">
        <div class="modal-body">
        
        	<label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" class="form-control" placeholder="Entrer le nom" value="">
            <?php echo form_error('nom'); ?>
            
            <label for="prenom">Prenom</label>
            <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Entrer le prénom" value="">
            <?php echo form_error('prenom'); ?>

    		<label for="pseudo">Pseudo</label>
            <input type="text" id="pseudo" name="pseudo" class="form-control" placeholder="Entrer le pseudo" value="">
            <?php echo form_error('pseudo'); ?>
            
        	<label for="mdp">Mot de passe</label>
            <input type="password" id="mdp" name="mdp" class="form-control" placeholder="Entre le mot de passe" value="">
            <?php echo form_error('mdp'); ?>

             <label for="selectEstAdmin">Est admin ?</label>
             	<select class="selectEstAdmin" name="selectEstAdmin">
                 	<option value="0">Non</option>
                 	<option value="1">Oui</option>
                </select> 
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btn-secondary">Sauvegarder</button>
        </div>

      </form>
    </div>
  </div>
</div>

<button type="button" class="btn btn-success" data-toggle="modal" data-target="#ajouterOrganisateurModal" title="Ajouter un contact">Ajouter un organisateur</button>
   
    <script type="text/javascript" >        
        $(document).ready(function() {
            // Javascript de la table de base
            $('#tabOrganisateur').DataTable();
        });
    </script>


