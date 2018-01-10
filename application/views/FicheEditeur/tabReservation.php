<!-- js pour les tableaux-->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

<!-- Modal ajouter reserver -->
<div class="modal fade" id="ajouterReserverModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un jeu à la réservation</h5>
            </div>

            <form method="POST" action="<?php echo (site_url("FicheEditeur/ajouterReserver?idFicheEditeur=" . $idFicheEditeur));?>">
                <div class="container-fluid">
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label for="selectJeu">Quel jeu ?</label>
                            <select class="selectJeu" name="selectJeu">
                                <?php
                                // Affichage des différents éditeurs.
                                $selection = '';
                                foreach ($jeux as $key => $jeu) {
                                    $selection = $selection . '<option value="'. $jeu->getIdJeu() . '">';
                                    $libEditeur = $jeu->getLibelleJeu();
                                    $selection = $selection . $libEditeur . "</option>";
                                }

                                echo ($selection);
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="selectQuantite">Combien de jeu ?</label>
                            <input type="number" class="form-control" id="selectQuantite" name="selectQuantite" placeholder="Entrer la quantité">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <label for="selectDotation">Dotation ?</label>
                            <select class="selectDotation" name="selectDotation">
                            	<option value="1">Oui</option>
                            	<option value="0">Non</option>
                            </select>
                         </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-secondary">Sauvegarder</button>
                </div> 
            </form>
        </div>
    </div>
</div>

<!-- Table Contact -->
<h3><label class="label label-default">Reservations</label></h3>
<table id="tabReserver" class="table table-striped table-bordered col-sm-12 text-left" cellspacing="0" width="100%">
        <!-- Entete du tableau -->
        <thead>
            <tr>
                <th>Jeu</th>
                <th>Quantite</th> 
                <th>Recu ?</th>
                <th>Renvoyé</th> 
            </tr>
        </thead>
        <tfoot>
            <tr>
               <th>Jeu</th>
                <th>Quantite</th> 
                <th>Recu ?</th>
                <th>Renvoyé</th> 
            </tr>
        </tfoot>
        <tbody>
            
            <!-- Insertion des données de manière dynamique -->
            <?php
                
                // Récupération des données
                $ligne = ''; // Stocke une ligne le temps de la créer
                foreach ($reservations as $key => $reservation) {
                    $jeuDTO = $reservation->getJeuDTO();
                    $reserverDTO = $reservation->getReserverDTO();
                    $typeJeuDTO = $reservation->getTypeJeu();
                    
                    
                    $idJeu = $jeuDTO->getIdJeu();
                    $nomJeu = $jeuDTO->getLibelleJeu();
                    $qteJeu = $reserverDTO->getQuantiteJeuReserver();
                    $recu = $reserverDTO->getReceptionJeuReserver();
                    $typeJeu = $jeuDTO->getIdTypeJeu();
                    $renvoyerJeu = $reserverDTO->getRenvoiJeuReserver();

                    $quantiteJeu = $reserverDTO->getQuantiteJeuReserver();

                    // Chaque tour de boucle crée une ligne pour la table, avec les informations d'un contact.
                    $ligne = '<tr>';
                    
                    // Affichage des oui ou non
                    if ($recu == 0) {
                        $recuTxt = 'Non';
                    }
                    else {
                        $recuTxt = 'Oui';
                    }
                    
                    if ($renvoyerJeu==0) {
                        $renvoyerTxt = 'Non';
                    }
                    else {
                        $renvoyerTxt = 'Oui';
                    }
  
                    $ligne = $ligne . '<td>' . $nomJeu . '</td>';
                    $ligne = $ligne . '<td>' . $qteJeu . '</td>';
                    $ligne = $ligne . '<td>' . $recuTxt . '</td>';
                    

                    // On ajoute le bouton supprimer et modifier dans la dernière colonne.
                    $ligne = $ligne . '<td class="row">
                        <label class="col-lg-6">' . $renvoyerTxt . '</label>
                        <span class="pull-right">
                        <a class="btn btn-primary" data-toggle="modal" data-target="#modifierReserverModal_' . $idJeu .'" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                        <a class="btn btn-primary" href="' . site_url("FicheEditeur/supprimerReserver?idJeu=" . $idJeu . "&idFicheEditeur=" . $idFicheEditeur) . '" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                        </span>
                        </td>';
                    $ligne = $ligne . '</tr>';
                    
                    echo $ligne;
                    
                    // Si jeu recu
                    if ($reserverDTO->getReceptionJeuReserver() == 1) {
                        $recu = 'checked="checked"';
                    }
                    else {
                       
                        $recu = '';
                    }
                    
                    // Si jeu recu
                    if ($reserverDTO->getRenvoiJeuReserver() == 1) {
                        $renvoyer = 'checked="checked"';
                    }
                    else {
                        $renvoyer = '';
                    }
                    
                    // Si dotation
                    // Si jeu recu
                    if ($reserverDTO->getDotationJeuReserver() == 1) {
                        $ouiDotationSelected = 'selected="selected"';
                        $nonDotationSelected = '';
                    }
                    else {
                        $ouiDotationSelected = '';
                        $nonDotationSelected = 'selected="selected"';
                    }
                    
                    // Nom de jeu commande
                    $nbJeuCommande = $reserverDTO->getQuantiteJeuReserver();
                    
                    // Creation du selecteur de zone
                    $choixZone = '<option value="0">Choisir zone</option>';
                    foreach ($zones as $key => $zone) {
                        // Si le jeu a une zone on affiche dans la liste déroulante sa zone en premier
                        if ($reserverDTO->getIdZone() == $zone->getIdZone()) {
                            $choixZone = $choixZone . '<option value="'. $zone->getIdZone() . '" selected="selected">';
                        }
                        else {
                            $choixZone = $choixZone . '<option value="'. $zone->getIdZone() . '">';
                        }
                        
                        $choixZone = $choixZone . $zone->getNomZone() . "</option>";
                    }

                    $modalModif ='
                    <div class="modal fade" id="modifierReserverModal_' . $idJeu . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h5 class="modal-title" id="exampleModalLabel">Modifier : <strong>' . $nomJeu . '</strong></h5>
                             </div>
                    
                             <form method="POST" action="'.  site_url("FicheEditeur/modifierReserver?idFicheEditeur=" . $idFicheEditeur) . '&idJeu=' . $idJeu . '">
                                <div class="container-fluid">
                                    '.
                                        // Premiere partie : le suivi du jeu
                                    
                                    '
                                    
                                    <div class="col-lg-6 well">
                                        <div><strong>Suivi du Jeu</strong></div>
                                        <div class="checkbox">
                                            <label><input ' . $recu .' name="recuBox" id="recuBox" type="checkbox">Reçu</label>
                                        </div>
                                        
                                        <div class="checkbox">
                                            <label><input ' . $renvoyer. ' name="renvoyerBox" id="renvoyerBox" type="checkbox">Renvoyé</label>
                                        </div>
                                        
                                     </div>
                                    '.
                                        // Deuxieme partie : Le changement de la réservation
                                    
                                    '
            
                                    <div class="col-lg-6 well">
                                        <div><strong>Modification du jeu</strong></div>
                                        <div class="form-row">
                                            <div class="col-sm-11">
                                                <label for="selectDotation">Dotation ?</label>
                                                <select class="selectDotation" name="selectDotation">
                                                	<option value="1" '. $ouiDotationSelected .'>Oui</option>
                                                	<option value="0" '. $nonDotationSelected .'>Non</option>
                                                </select>
                                             </div>
                                        </div>
                                    
            
                            
                                        <div class="form-row">
                                            <div class="col-sm-8">
                                                <label for="selectQuantite">Combien de jeu ?</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="number" value="' . $nbJeuCommande. '" class="form-control" id="selectQuantite" name="selectQuantite" placeholder="Entrer la quantité">
                                            </div>      
                                        </div>


                                        <div class="form-row">
                                            <div class="col-sm-4">
                                                <label for="selectZone">Zone : </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <select class="selectZone" name="selectZone"> 
                                                    '. 
                                                    // Affichage des différentes zones.
                                                        $choixZone
                                                    .'
                                                </select>
                                             </div>
                                        </div>
                                        
                                        <div class="form-row">
                                            <div class="col-sm-8 pull-right">
                                                <label for="creerZone">Créer zone ?</label>
                                            </div>
                                            
                                            <div class="form-row">
                                                <div class="col-sm-8 pull-right">
                                                    <input type="text" value="" class="form-control" id="nomCreerZone" name="nomCreerZone" placeholder="Saisir son nom">
                                                </div>
                                            </div>

    
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
                }
            ?>

        </tbody>
    </table>
	
	<div class="OptionSupplementaire">
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajouterReserverModal">
        	<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
    	</button>
    	
    	<div class="pull-right">
    		<form method="POST" action="<?php echo site_url ("FicheEditeur/sauvegarderReservation?idFicheEditeur=" . $idFicheEditeur)?>">
    			<label for="prixTotReservation">Prix total négotié</label>
        		<input type="number" <?php
        		      // Si le réservation existe pas, on doit disabled 
        		if (!isset($prixNego)) {
        		    echo ('disabled="disabled" value="0"');
        		} else {
        		    echo ('value=' . $prixNego); 
        		}
        		      
        		      ?> id="prixTotReservation" name="prixTotReservation">
        		<label>€</label>
        		<button type="submit" class="btn btn-primary">
            		<span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>
        		</button>
    		</form>
    		
    	</div>
	</div>
    
   
    <script type="text/javascript" >        
        $(document).ready(function() {
            // Javascript de la table de base
            $('#tabReserver').DataTable();
        });
    </script>