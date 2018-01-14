<h1 id="titreInterface">Festivals : </h1>
<!-- js pour les tableaux-->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

 <!-- <style type="text/css">
     [class*="col-"] {
  background-color: lightgreen;
  border: 2px solid black;
  border-radius: 6px;
 }
</style> -->

<!-- Modal -->
<div class="modal fade" id="ajouterEditeurModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Ajouter éditeur</h5>
            </div>

            <form method="POST" action= <?php echo site_url('Editeur/ajouterEditeur')?>>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nomEditeur">Nom de l'éditeur</label>
                        <input type="text" class="form-control" id="nomEditeur" name="nomEditeur" placeholder="Entrer le nom">
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

<!-- selection filtre suivi -->
<div class="row">
	<div class="col-sm-6 col-xs-12">
	<button type="button" class="btn btn-primary" data-toggle="modal" title="Ajouter un éditeur ?" data-target="#ajouterEditeurModal">
    	<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
   	</button>
   	</div>
   	
   	<div class="col-sm-6 col-xs-12 pull-right">
   	<div class="pull-right">
	<form method="POST" class="form-inline" action="<?php echo site_url('Editeur/choixFiltre'); ?>">
		<select id="selectFiltre" name="selectFiltre">
			<option value="7" <?php if(isset($filtreAff) && $filtreAff == 7){echo ('selected="selected"');}?>>Tout les éditeurs</option>
            <option value="1" <?php if(isset($filtreAff) && $filtreAff == 1) {echo ('selected="selected"');}?>>Non Contacté</option>
            <option value="2" <?php if(isset($filtreAff) && $filtreAff == 2) {echo ('selected="selected"');}?>>1 contact, pas de réponse</option>
            <option value="3" <?php if(isset($filtreAff) && $filtreAff == 3) {echo ('selected="selected"');}?>>2 contacts, pas de réponse</option>
            <option value="4" <?php if(isset($filtreAff) && $filtreAff == 4) {echo ('selected="selected"');}?>>Présent</option>
            <option value="5" <?php if(isset($filtreAff) && $filtreAff == 5){echo ('selected="selected"');}?>>Hésite</option>
            <option value="6" <?php if(isset($filtreAff) && $filtreAff == 6) {echo ('selected="selected"');}?>>Absent</option>
                
        </select>
        <button type="submit" class="btn btn-secondary">Appliquer filtre</button>
    </form>
    </div>
    </div>
</div>





<!-- Table Editeur -->
<table id="tabEditeur" class="table table-striped table-bordered col-sm-12 text-left" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Editeur</th>
            <th>Contact principal</th>
            <th>Telephone</th>
            <th>Mail</th>
            <th>Suivi rapide</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Editeur</th>
            <th>Contact principal</th>
            <th>Telephone</th>
            <th>Mail</th>
            <th>Suivi rapide</th>
        </tr>
    </tfoot>
    <tbody>

        <!-- Insertion des données de manière dynamique -->
        <?php
                // Récupération des données
                $ligne = ''; // Stocke une ligne le temps de la créer
                foreach ($ensembleSuiviCollection as $key => $ensembleSuiviDTO) {
                    $editeur = $ensembleSuiviDTO->getEditeurContactDTO();
                    $idEditeur = $editeur->getIdEditeur();
                    $nomEditeur = $editeur->getLibelleEditeur();
                    
                    if (!is_null($editeur->getIdContact())){
                        $idContact = $editeur->getIdContact();
                        $nomContact = $editeur->getNomContact();
                        $mailContact = $editeur->getMailContact();
                        $numContact = $editeur->getTelephoneContact();
                    }
                    else {
                        $idContact = "";
                        $nomContact = "";
                        $mailContact = "";
                        $numContact = "";
                    }
                    
                    
                    // Chaque tour de boucle crée une ligne pour la table, avec les informations d'un éditeur.
                    $ligne = '<tr>';

                    $ligne = $ligne . '<td><a  href="' . site_url('ficheEditeur?idFicheEditeur='. $idEditeur ) . '" >' . $nomEditeur . '</a></td>';
                    $ligne = $ligne . '<td><a  href="contact">' . $nomContact . '</a></td>';
                    $ligne = $ligne . '<td>' . $numContact . '</td>';
                    $ligne = $ligne . '<td>' . $mailContact . '</td>';
                    
                    // Préparation de la sélection pour la présence de l'editeur
                    
                    /* Correspondance pour la réponse Editeur 
                     * - -1 = Pas de réponse
                     * -  1 = Absent
                     * -  2 = Hésite
                     * -  3 = Présent
                     */
                    $suiviEditeur = $ensembleSuiviDTO->getSuiviDTO();
                    $selectionReponseEditeur = '';
                       
                    $selectionReponseEditeur = '
                     <option ';
                     $selected = '';
                     if ($suiviEditeur->getReponseEditeur() == -1) {
                         $selected = 'selected="selected"';
                     }
                     $selectionReponseEditeur = $selectionReponseEditeur . $selected .' value="'. -1 . '">Pas de réponse</option>';
                     
                     $selectionReponseEditeur = $selectionReponseEditeur .'
                     <option ';
                     $selected = '';
                     
                     if ($suiviEditeur->getReponseEditeur() == 1) {
                         
                         $selected = 'selected="selected"';
                     }
                     $selectionReponseEditeur = $selectionReponseEditeur . $selected .' value="'. 1 . '">Absent</option>';
                     
                     $selectionReponseEditeur = $selectionReponseEditeur .'<option ';
                     $selected = '';
              
                     if ($suiviEditeur->getReponseEditeur() == 2) {
                         $selected = 'selected="selected"';
                     }
                     $selectionReponseEditeur = $selectionReponseEditeur . $selected .' value="'. 2 . '">Hésite</option>';
                     
                     $selectionReponseEditeur = $selectionReponseEditeur .'<option ';
                     $selected = '';
                     if ($suiviEditeur->getReponseEditeur() == 3) {
                         $selected = 'selected="selected"';
                     }
                     $selectionReponseEditeur = $selectionReponseEditeur . $selected . ' value="'. 3 . '">Présent</option>';
                     
                     // Préparation de selection du bouton contacté
                     $cocheDejaContacte = '';
                     if (!is_null($suiviEditeur->getPremierContact())) {
                         $cocheDejaContacte = 'checked="checked"';
                     }
                    
                    // Préparation du lien (on met le filtre si on est sur un filtre
                     if (isset($filtreAff)) {
                         $lienSupp =  site_url('Editeur/supprimerEditeur?idEditeur='. $idEditeur . '&selectFiltre=' . $filtreAff);
                         $lienModifSuivi = site_url ('Editeur/sauvegardeSuiviRapideEditeur?idEditeur=' . $idEditeur . '&selectFiltre=' . $filtreAff);
                     }
                     else {
                         $lienSupp =  site_url('Editeur/supprimerEditeur?idEditeur='. $idEditeur); 
                         $lienModifSuivi = site_url ('Editeur/sauvegardeSuiviRapideEditeur?idEditeur=' . $idEditeur);
                     }
                    // On ajoute le bouton supprimer et modifier dans la dernière colonne.
                    $ligne = $ligne . '<td class="row">
                    <div class ="pull-left">
                        <form method="POST" action="'. $lienModifSuivi .'">
                            <label><input ' . $cocheDejaContacte . ' name="contactFait" id="contactFait" type="checkbox"> Contacté</label>
                            <select class="selectReponse" name="selectReponse">' . $selectionReponseEditeur .'</select>
                            <button type="submit" class="btn btn-primary">
            		          <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>
        		            </button>
                        </form>
                    </div>
                    <span class="pull-right">
                    <a class="btn btn-primary pull-right" data-toggle="modal" data-target="#modifierEditeurModal_' . $idEditeur .'" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                    <a class="btn btn-primary pull-right" href="'. $lienSupp .'" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                    </span>
                    </td>';
                    $ligne = $ligne . '</tr>';
                    
                    echo  $ligne;
                    
                    $modalModifEditeur ='
                    <div class="modal fade" id="modifierEditeurModal_' . $idEditeur .'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h5 class="modal-title" id="exampleModalLabel">Ajouter éditeur</h5>
                                </div>
                    
                                <form method="POST" action="' . site_url("Editeur/modifierEditeur?idEditeur=" . $idEditeur) . '">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nomEditeur">Nom de l éditeur</label>
                                            <input type="text" value="' . $nomEditeur . '" class="form-control" id="nomEditeur" name="nomEditeur" placeholder="Entrer le nom">
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
                    echo $modalModifEditeur;
                }
                

                ?>


            </tbody>
        </table>

<script type="text/javascript" >        
    $(document).ready(function() {
        // Javascript de la table de base
        $('#tabEditeur').DataTable();
    });
</script>



 



