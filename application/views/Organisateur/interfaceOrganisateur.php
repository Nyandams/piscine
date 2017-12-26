<!-- formulaire de modification -->
<div class="col-sm-3 text-left" id="contenuPage">
	<label for="pseudo" class="sr-only">pseudo</label>
        <input type="text" id="pseudo" name="pseudo" class="form-control" placeholder="login" value="<?php echo set_value('pseudo'); ?>">

</div>





<!-- tableau d'affichage et de modification -->
<div class="col-sm-9 text-left" id="contenuPage">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajouterEditeurModal">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
	</button>
</div>


