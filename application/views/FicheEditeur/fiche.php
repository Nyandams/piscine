<section class="row">
	<!-- colonne de gauche -->
	<div class="row">
		<div class = "pull-left">
			<h1><?php echo $nomEditeur ?></h1>
		</div>
	</div>
	<div class="row">
		<div class = "col-lg-5 col-md-12">
    		<?php
    		    echo $tabJeu;
    		    if (!is_null($idFestival)){
				echo '<div style="height:80px"></div>';
        			echo $suiviPerso;
				echo '<div style="height:80px"></div>';
        			echo $zoneCommentaire;
    		    }
    		?>
    	</div>

	<div class = "col-md-1"></div>
    
    	<!-- colonne de gauche -->
    	<div class = "col-lg-6 col-md-12">

    		<?php
    		    echo $tabContact;	
		    echo '<div style="height:80px"></div>';
    			if(!is_null($idFestival)){
    			    echo $tabReserver;
    			}
    		?>
    	</div>
	</div>
	

	
</section>

