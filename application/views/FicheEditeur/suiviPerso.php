<h3><label class="label label-default">Suivis</label></h3>
<br/>

<?php 
// Prépa affichage
$factureCheck = '';
$paiementCheck = '';

if (isset ($factureDTO)) {
    if (!is_null($factureDTO->getDateEmissionFacture()))
    {
        $factureCheck =('checked="checked"');
        $factureValue = $factureDTO->getDateEmissionFacture()->format('d/m/Y');
    }
    
    if (!is_null($factureDTO->getDatePaiementFacture()))
    {
        $paiementCheck = ('checked="checked"');
        $paiementValue = $factureDTO->getDatePaiementFacture()->format('d/m/Y');
    }
}


?>
<section class="row">
    <form action="<?php echo site_url('FicheEditeur/sauvegarderSuivi?idFicheEditeur=' . $idFicheEditeur); ?>" method="POST">
        <div class="col-lg-12">
        <div class="well">
        <label class="label label-default">Suivi de l'éditeur</label>
        	<div class="checkbox">
        		<label><input type="checkbox" <?php if ($suivi->getPresenceEditeur()) {echo ('checked="checked"');}?> name="presentContact" id="presentContact">Editeur présent physiquement</label>       	
        	</div>
        	<div class="checkbox">
        		<label><input type="checkbox" <?php if ($suivi->getLogementSuivi()) {echo ('checked="checked"');}?> name="hebergementContact" id="hebergementContact">Editeur hébergé</label>
        	</div>
        	<div class="checkbox">
        	
        		<label><input type="checkbox" <?php echo ($factureCheck) ?> name="factureEnvoye" id="factureEnvoye">Facture envoyée</label>
        		<?php
        		if (isset($factureValue)){
        		    echo '<div class="pull-right">
        		              <label>' . $factureValue .'</label>
        		          </div>';
        		}
        		?>
        		
        		       	       	
        	</div>
        	<div class="checkbox">
        		<label><input type="checkbox" <?php echo ($paiementCheck) ?> name="paiementEnvoye" id="paiementEnvoye">Paiement effectué</label>
        		<?php
        		if (isset($paiementValue)){
        		    echo '<div class="pull-right">
        		              <label>' . $paiementValue .'</label>
        		          </div>';
        		}
        		?>
        	</div>            
        </div>
        </div>  
        
        
         <?php 
         $reponseEditeur = $suivi->getReponseEditeur();
         ?>
        <div class="col-lg-12">
            <div class="well">
            	<label class="label label-default">Suivi des échanges</label>
        		<div class="row">
        		
        		<!-- PREMIERE LIGNE -->
            			<div class="col-md-6">
                			<div class="checkbox">
                            	<label><input <?php 
                            
                            	
                            	if ($suivi->getPremierContact() !== null) {
                            	    echo ('checked="checked"');
                            	}
                            	if (!is_null($suivi->getSecondContact())) {
                            	    echo (' disabled="disabled" ');
                            	}
                            	?> name="premierContact" id="premierContact" type="checkbox">1er contact</label> <?php 
                            	   if($suivi->getPremierContact() != null){
                            	       echo '<input class="form-control col-sm-2" type="date" value="'. $suivi->premierContactFormat() .'" id="dateModifPremierContact">';
                            	   }
                            	?>
                            </div>
                        </div>
    
                        <div class="col-md-6">
                        	<div class="pull-left">
                        		<label for="selectReponse1">Réponse :</label>
                        	</div>
                        	
                        	<div class="pull-right">
                        	<?php 
                            	//on ne peut pas le selectionner on a contacté une deuxieme fois
                            	echo getListeDeroulante(!is_null($suivi->getSecondContact()), "selectReponse1", $suivi);
                            ?>
                        	</div>
                        	
                        </div>
                       
                </div>
                
                <div class="row">
                <!-- DEUXIEME LIGNE -->
        			<div class="col-md-6">
            			<div class="checkbox">
                        	<label><input <?php 
                        	if (!is_null($suivi->getSecondContact())) {
                        	    echo ('checked="checked"');
                        	}
                        	// Si pas encore contacté ou si y a une réponse, pas besoin de ce bouton
                        	if (is_null($suivi->getPremierContact()) or !($reponseEditeur == null or $reponseEditeur == -1)) {
                        	    echo (' disabled="disabled" ');
                        	}
                        	?> name="deuxiemeContact" id="deuxiemeContact" type="checkbox">2eme contact</label> <?php 
                        	if(!is_null($suivi->getSecondContact())){
                        	    echo '<input class="form-control" type="date" value="'. $suivi->secondContactFormat() .'" id="dateModifSecondContact">';
                            }
                        	?>
                        </div>
                    </div>

                    <div class="col-md-6">
                    	<div class="pull-left">
                    		<label for="selectReponse2">Réponse :</label>
                    	</div>
                    	<div class="pull-right">
                    	<?php 
                    	//On ne peut toujours séléectionner uine réponse
                    	echo getListeDeroulante(is_null($suivi->getSecondContact()), "selectReponse2", $suivi);
                    ?>
                    	
                    	</div>
                    	
                    </div>
                    
                </div>
                    
                </div>
            <div class="pull-right">
            	<button type="submit" class="btn btn-success">Sauvegarder</button>
          	</div>
        </div>	
     </form>
</section>


<?php 

function getListeDeroulante ($estDisabled, $idName, $suivi) {
    // Création de la liste déroulante
    /* Correspondance pour la réponse Editeur
     * - -1 = Pas de réponse
     * -  1 = Absent
     * -  2 = Hésite
     * -  3 = Présent
     */
    
    $selectionReponseEditeur = '';
    
    $selectionReponseEditeur = '
                         <option ';
    $selected = '';
    if ($suivi->getReponseEditeur() == -1) {
        $selected = 'selected="selected"';
    }
    $selectionReponseEditeur = $selectionReponseEditeur . $selected .' value="'. -1 . '">Pas de réponse</option>';
    
    $selectionReponseEditeur = $selectionReponseEditeur .'
                         <option ';
    $selected = '';
    
    if ($suivi->getReponseEditeur() == 1) {
        
        $selected = 'selected="selected"';
    }
    $selectionReponseEditeur = $selectionReponseEditeur . $selected .' value="'. 1 . '">Absent</option>';
    
    $selectionReponseEditeur = $selectionReponseEditeur .'<option ';
    $selected = '';
    
    if ($suivi->getReponseEditeur() == 2) {
        $selected = 'selected="selected"';
    }
    $selectionReponseEditeur = $selectionReponseEditeur . $selected .' value="'. 2 . '">Hésite</option>';
    
    $selectionReponseEditeur = $selectionReponseEditeur .'<option ';
    $selected = '';
    if ($suivi->getReponseEditeur() == 3) {
        $selected = 'selected="selected"';
    }
    $selectionReponseEditeur = $selectionReponseEditeur . $selected . ' value="'. 3 . '">Présent</option>';
    
    // Préparation du blocage de la sélection
    $disabled = '';
    if ($estDisabled) {
        $disabled  = 'disabled="disabled"';
    }
    // On ajoute le bouton supprimer et modifier dans la dernière colonne.
    $listeDeroulante = '<td class="row">
                        <div class ="pull-left">
                             <select '. $disabled .' class=' . $idName .' name=' . $idName .'>' . $selectionReponseEditeur .'</select>
                            </form>
                        </div>';
    return $listeDeroulante;
}
?>
