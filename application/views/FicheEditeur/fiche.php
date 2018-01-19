<section class="row">
	<!-- colonne de gauche -->
	<div class="row">
		<div class = "pull-left">
			<h1><?php echo $nomEditeur ?></h1>
		</div>
	</div>
	<div class="row">
		<div class = "col-lg-6 col-md-12">
    		<?php
    		    echo $tabJeu;
    		    if (!is_null($idFestival)){
    			echo $suiviPerso;
    			echo $zoneCommentaire;
    		    }
    		?>
    	</div>
    
    	<!-- colonne de gauche -->
    	<div class = "col-lg-6 col-md-12">
    		<?php
    		    echo $tabContact;
    			echo $tabReserver;
    		?>
    	</div>
	</div>
	

	
</section>

