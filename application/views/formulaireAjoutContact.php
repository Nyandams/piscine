  <!-- Formulaire ajout contact -->
    <form method="POST" action="ajouterEditeur">
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
          <input type="text" class="input-medium bfh-phone form-control" data-format="+1 (ddd) ddd-dddd" id="numTelephone" name="numTelephone" placeholder="Entrer le numéro de téléphone">
        </div>
      </div>
      
      <div class="form-row">
        <div class="col-sm-6">
            <label for="adresse">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Entrer l'adresse">
        </div>

        <div class="col-sm-2">
            <label for="codePostal">Code postal</label>
            <input type="number" class="form-control" id="codePostal" name="codePostal" placeholder="Entrer le code postal">
        </div>

        <div class="col-sm-4">
            <label for="ville">Ville</label>
            <input type="text" class="form-control" id="ville" name="ville" placeholder="Entrer la ville">
        </div>
      </div>

      <div class="col-sm-12">
        <button type="submit" class="btn btn-secondary">Sauvegarder</button>
      </div>

      
    </form>
