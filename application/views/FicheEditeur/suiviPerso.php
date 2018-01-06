<h3><label class="label label-default">Suivi</label></h3>
<section class="row">
    <form action="<?php echo site_url('FicheEditeur/sauvegarderSuivi?idFicheEditeur=' . $idFicheEditeur); ?>" method="POST">
        <div class="col-lg-6 well">
            <div class="checkbox">
            	<label><input <?php 
            	if ($suivi->getPremierContact() !== null) {
            	    echo ('checked="checked"');
            	}
            	?>name="premierContact" id="premierContact" type="checkbox">1er contact <?php if($suivi->getPremierContact() !== null){echo($suivi->getPremierContact());}?></label>
            </div>
            <div class="checkbox">
            	<label><input <?php 
            	if ($suivi->getSecondContact() !== null) {
            	    echo ('checked="checked"');
            	}
            	?>name="deuxiemeContact" id="deuxiemeContact" type="checkbox">2eme contact <?php if($suivi->getSecondContact() !== null){echo($suivi->getSecondContact());}?></label>
            </div>
            <div class="checkbox">
            	<label><input <?php if ($suivi->getPresenceEditeur() == 1) {
            	    echo ('checked="checked"');
            	}
            	?>name="presentContact" id="presentContact" type="checkbox">Présent ?</label>
            </div>
            <div class="checkbox">
            	<label><input <?php if ($suivi->getLogementSuivi() == 1) {
            	    echo ('checked="checked"');
            	}
            	?>name="hebergementContact" id="hebergementContact" type="checkbox">Hébergement ?</label>
            </div>
            
        </div>
        
        <div class="col-lg-6 well">
            <div class="checkbox">
            	<label><input name="factureContact" id="factureContact" type="checkbox">Facture envoyée</label>
            </div>
            <div class="checkbox">
            	<label><input name="paiementContact" id="paiementContact" type="checkbox">Paiement</label>
            </div>
            
            <button type="submit" class="btn btn-secondary">Sauvegarder</button>
        </div>
     </form>
</section>