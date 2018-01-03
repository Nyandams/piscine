<h3><label class="label label-default">Commentaires</label></h3>
<form method="POST" action=<?php echo('FicheEditeur/modifierCommentaire?idFicheEditeur=' . $ficheEditeur)?>>
	<div class="form-row">
		<textarea class="form-control" value="<?php echo $commentaire ?>" row="3"></textarea>
	</div>

	<div class="form-row">
		<div class="pull-right"> 
        	<button type="submit" class="btn btn-secondary">Sauvegarder</button>
        </div>
	</div>
</form>