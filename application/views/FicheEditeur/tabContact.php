
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>


<!-- Modal ajout -->
<div class="modal fade" id="ajouterContactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un contact</h5>
            </div>

            <form id="formContact" method="POST" action="<?php echo 'ficheEditeur/ajouterContact?idFicheEditeur='.  $idFicheEditeur ?>">
                <div class="container-fluid">
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label for="nomContact">Nom</label>
                            <input type="text" class="form-control" id="nomContact" name="nomContact" placeholder="Entrer le nom">
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="prenomContact">Prenom</label>
                            <input type="text" class="form-control" id="prenomContact" name="prenomContact" placeholder="Entrer le prenom">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-sm-8">
                            <label for="adresseMail">Adresse email</label>
                            <input type="mail" class="form-control" id="adresseMail" name="adresseMail" placeholder="Entrer l'email">
                        </div>

                        <div class="form-group col-sm-4">
                            <label for="numTelephone">Numéro téléphone</label>
                            <input type="text" class="input-medium bfh-phone form-control" data-format="+1 (ddd) ddd-dddd" id="numTelephone" name="numTelephone" placeholder="Entrer le numéro">
                        </div>
                    </div>
                  
                    <div class="form-row">
                        <div class="col-sm-6">
                            <label for="adresse">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Entrer l'adresse">
                        </div>

                        <div class="col-sm-3">
                            <label for="codePostal">Code postal</label>
                            <input type="text" class="form-control" id="codePostal" name="codePostal" placeholder="Entrer le code postal">
                        </div>

                        <div class="col-sm-3">
                            <label for="ville">Ville</label>
                            <input type="text" class="form-control" id="ville" name="ville" placeholder="Entrer la ville">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-sm-8">
                            <label for="selectPrincipal">Contact principal ?</label>
                            <select class="selectPrincipal" name="selectPrincipal">
                                <option value=1>Oui</option>
                                <option value=0>Non</option>  
                            </select>

                        </div>
                    </div>
                    
                    <div class="form-row">
                    	
                        <label for="selectContactExistant"><strong>OU</strong> choisissez un contact existant :</label>
                      	<select class="selectContactExistant" name="selectContactExistant">
                    	<?php 
                        $selection = '<option value="0">Contact existant<option>';
                        foreach ($AllContactDTO as $key => $EditContact) {
                            $idContact = $EditContact->getIdContact();
                            $nomContact = $EditContact->getNomContact();
                            
                            $selection = $selection . '<option value="'. $idContact . '">';
                            $selection = $selection . $nomContact . "</option>";
                        }
                        echo ($selection);
                        ?>
                    	</select>
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




    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ajouterContactModal" title="Ajouter un contact">Ajouter un contact</button>
   
    <script type="text/javascript" >        
        $(document).ready(function() {
            // Javascript de la table de base
            $('#tabContact').DataTable();
        });
    </script>