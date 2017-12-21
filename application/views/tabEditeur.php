<title>Piscine</title>

<!-- Bootstrap -->
<link type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
<link type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

  <table id="example" class="table table-striped table-bordered col-sm-10 text-left" cellspacing="0" width="100%">
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
                    
                    // Chaque tour de boucle crée une ligne pour la table, avec les informations d'un éditeur.
                    $ligne = '<tr>';

                    $ligne = $ligne . '<td>' . $editeur->getIdEditeur() . '</td>';
                    $ligne = $ligne . '<td>' . $editeur->getLibelleEditeur() . '</td>';

                    $ligne = $ligne . '</tr>';
                    
                    echo  $ligne;
                }
            ?>


        </tbody>
    </table>

    <button id="testAjax">Click pour faire une requete en ajax !</button>


    <script type="text/javascript" > 
    $(document).ready(function() {
        // Javascript de la table de base
        $('#example').DataTable();

        //Bouton pour tester ajax
        $("#testAjax").click(function() {
            
            $.ajax({
                url : "<?php echo site_url('Accueil/supprimerEditeurAjax'); ?>",
                type : 'GET',
                dataType : 'text',
                data : '1',
                success : function (msg) {
                    alert ("Bien réussi.");
                }
            });

            return false;

        });
    });

    </script>