<!-- formulaire de modification -->
<div class="col-sm-3 text-left" id="contenuPage">
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
</div>





<!-- tableau d'affichage et de modification -->
<div class="col-sm-9 text-left" id="contenuPage">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajouterEditeurModal">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
	</button>
</div>


