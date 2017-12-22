<title>Piscine</title>

<!-- Bootstrap -->
<link type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
<link type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

  <table id="tabEditeur" class="table table-striped table-bordered col-sm-10 text-left" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Libellé</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Id</th>
                <th>Libellé</th>
            </tr>
        </tfoot>
        <tbody>
            
            <!-- Insertion des données de manière dynamique -->
            <?php
                
                // Récupération des données
                $ligne = ''; // Stocke une ligne le temps de la créer
                foreach ($editeursDto as $key => $editeur) {
                    $idEditeur = $editeur->getIdEditeur();
                    
                    // Chaque tour de boucle crée une ligne pour la table, avec les informations d'un éditeur.
                    $ligne = '<tr>';

                    $ligne = $ligne . '<td>' . $idEditeur . '</td>';

                    // On ajoute le bouton supprimer et modifier dans la dernière colonne.
                    $ligne = $ligne . '<td class="row">
                        <label class="col-lg-8">' . $editeur->getLibelleEditeur() . '</label>
                        <button class="col-lg-2 glyphicon glyphicon-pencil" id="modifierEditeur_'. $idEditeur . '">
                        <button class="col-lg-2 glyphicon glyphicon-trash" id="supprimerEditeur_'. $idEditeur . '">
                        </td>';
                    $ligne = $ligne . '</tr>';
                    
                    echo  $ligne;
                }
                

            ?>

            
        </tbody>
    </table>

    <script type="text/javascript" > 

       
        $(document).ready(function() {
            // Javascript de la table de base
            $('#tabEditeur').DataTable();


            // Ajout des listener sur les bouton supprimer
            var tabPencil = $('[id^="supprimerEditeur"]');
            var longueur = tabPencil.length;
            for (var i = 0; i < longueur; i++) {
                
                // Il faut utiliser une fonction anonyme pour les boucles for
                (function(){
                    var idEditeur = getIdEditeurFromIdBtn(tabPencil[i].id);

                    $(tabPencil[i]).click(function() {
                        supprimerEditeur(idEditeur);
                    });
                })();
            }

            // Ajout des listener sur les bouton modifier
            var tabPencil = $('[id^="modifierEditeur"]');
            var longueur = tabPencil.length;
            for (var i = 0; i < longueur; i++) {
                
                // Il faut utiliser une fonction anonyme pour les boucles for
                (function(){
                    var idEditeur = getIdEditeurFromIdBtn(tabPencil[i].id);

                    $(tabPencil[i]).click(function() {
                        modifierEditeur(idEditeur);
                    });
                })();
            }
            
            // Supprime un editeur passé ayant l'id passé en argument
            function supprimerEditeur (idEditeur) {
                $.ajax({
                    type : "POST",
                    url : "<?php echo site_url('Accueil/supprimerEditeurAjax'); ?>",
                    dataType : 'html',
                    data : {idEdit : idEditeur},
                });
            }

            // TODO
            function modifierEditeur (idEditeur) {
                $.ajax({
                    type : "POST",
                    url : "<?php echo site_url('Accueil/modifierEditeurAjax'); ?>",
                    dataType : 'json',
                    data : {"idEditeur" : idEditeur}
                });
            }
        });

        function getIdEditeurFromIdBtn (idBtn) {
            // Extrait l'id de l'editeur a partir d'id du bouton
            return idBtn.substring(idBtn.indexOf('_') + 1, idBtn.length);
        }

    </script>