<!-- formulaire de modification -->

	<h2><?php echo $organisateur->getLoginOrganisateur(); ?></h2>
	 <form method="post" action="Organisateur/modificationOrganisateur">
	 
	 	<label for="nom">Nom</label>
        <input type="text" id="nom" name="nom" class="form-control" placeholder="nom" value="<?php echo $organisateur->getNomOrganisateur(); ?>">
        <?php echo form_error('nom'); ?>
        
        <label for="prenom">Prenom</label>
        <input type="text" id="prenom" name="prenom" class="form-control" placeholder="prenom" value="<?php echo $organisateur->getPrenomOrganisateur(); ?>">
        <?php echo form_error('prenom'); ?>
        
    	<label for="mdp">Mot de passe</label>
        <input type="password" id="mdp" name="mdp" class="form-control" placeholder="mot de passe" value="">
        <?php echo form_error('mdp'); ?>
        
		<label for="verifmdp">Vérification mot de passe</label>
        <input type="password" id="verifmdp" name="verifmdp" class="form-control" placeholder="mot de passe" value="">
        <?php echo form_error('verifmdp'); ?>
        
		<button type="submit" class="btn btn-secondary">Modifier</button>
	
	</form>







<!-- Modal -->
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
            
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" class="form-control" placeholder="nom" value="">
            <?php echo form_error('nom'); ?>
            
            <label for="prenom">Prenom</label>
            <input type="text" id="prenom" name="prenom" class="form-control" placeholder="prenom" value="">
            <?php echo form_error('prenom'); ?>
            
        	<label for="mdp">Mot de passe</label>
            <input type="password" id="mdp" name="mdp" class="form-control" placeholder="mot de passe" value="">
            <?php echo form_error('mdp'); ?>
          
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


