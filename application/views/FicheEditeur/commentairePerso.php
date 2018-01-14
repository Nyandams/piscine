<h3><label class="label label-default">Commentaires</label></h3>
<form method="POST" action="<?php echo site_url('FicheEditeur/sauvegarderCommentaire?idFicheEditeur=' . $idFicheEditeur)?>">
	<div class="form-row">
		<textarea class="form-control" id ="commentaire" name="commentaire"" row="3"><?php
			// text par défaut, la balise <?php doit etre placé juste après la fin de la premier textarea sinon des espaces apparaissent dans le text area
		      echo $commentaire;
			 ?></textarea>
	</div>

	<div class="form-row">
		<div class="pull-right"> 
        	<button type="submit" class="btn btn-success">Sauvegarder</button>
        </div>
	</div>
</form>