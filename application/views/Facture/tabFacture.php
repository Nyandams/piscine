<!-- js pour les tableaux-->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>


<!-- Table Facture -->
<table id="tabFacture" class="table table-striped table-bordered col-sm-12 text-left" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Editeur</th>
            <th>Année</th>
            <th>Envoi facture</th>
            <th>Paiement facture</th>
            <th>Prix facture</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Editeur</th>
            <th>Année</th>
            <th>Envoi facture</th>
            <th>Paiement facture</th>
            <th>Prix facture</th>
        </tr>
    </tfoot>
    <tbody>

        <!-- Insertion des données de manière dynamique -->
        <?php
                // Récupération des données
                $ligne = ''; // Stocke une ligne le temps de la créer
                
                foreach ($factureAffichageCollection as $key => $factureDTO) {
                    
                    $idEditeur = $editeur->getIdEditeur();
                    $nomEditeur = $editeur->getLibelleEditeur();
                    
                    
                    
                    
                    // Chaque tour de boucle crée une ligne pour la table, avec les informations d'un éditeur.
                    $ligne = '<tr>';

                    $ligne = $ligne . '<td><a  href="' . site_url('ficheEditeur?idFicheEditeur='. $idEditeur ) . '" >' . $nomEditeur . '</a></td>';
                    $ligne = $ligne . '<td>'.$annee.' </td>';
                    $ligne = $ligne . '<td>'.$envoiFacture.' </td>';
                    $ligne = $ligne . '<td>'.$paiementFacture.' </td>';
                    $ligne = $ligne . '<td>'.$prixFacture.' </td>';
                    
                    
                    

                    
                    $ligne = $ligne . '</tr>';
                    
                    echo  $ligne;
                }
                

                ?>


            </tbody>
        </table>


<script type="text/javascript" >        
    $(document).ready(function() {
        // Javascript de la table de base
        $('#tabFacture').DataTable();
    });
</script>