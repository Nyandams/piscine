<h1 id="titreInterface">Réservation : </h1>
<!-- js pour les tableaux-->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>


<!-- Table Reservation -->
<table id="tabReservation" class="table table-striped table-bordered col-sm-12 text-left" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Editeur</th>
            <th>Année</th>
            <th>Liste jeux réservés</th>
            <th>Nombre de tables réservées</th>
            <th>Prix total négocié</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Editeur</th>
            <th>Année</th>
            <th>Liste jeux réservés</th>
            <th>Nombre de tables réservées</th>
            <th>Prix total négocié</th>
        </tr>
    </tfoot>
    <tbody>

        <!-- Insertion des données de manière dynamique -->
        <?php
                // Récupération des données
                $ligne = ''; // Stocke une ligne le temps de la créer

                foreach ($reservationAffichageCollection as $reservationAffichageDto) {
                    // Chaque tour de boucle crée une ligne pour la table, avec les informations d'un éditeur.
                    $ligne = '<tr>';
                    $ligne = $ligne . '<td><a  href="' . site_url('ficheEditeur?idFicheEditeur='. $reservationAffichageDto->getIdEditeur() ). '" >' . $reservationAffichageDto->getLibelleEditeur() . '</a></td>';
                    $ligne = $ligne . '<td>'.$reservationAffichageDto->getAnneeFestival().' </td>';
                    $ligne = $ligne . '<td>'.$reservationAffichageDto->getLibelleJeu().' </td>'; 
/*pour les jeux, il faudrait faire une liste de tous les jeux reservés car une reservation ne se fait pas que sur un seul jeu*/
                    $ligne = $ligne . '<td>'.$reservationAffichageDto->getNbEmplacement().' </td>';
                    $ligne = $ligne . '<td>'.$reservationAffichageDto->getPrixNegociationReservation().' </td>';

                    $ligne = $ligne . '</tr>';
                    
                    echo  $ligne;
                }
                
                ?>


            </tbody>
        </table>


<script type="text/javascript" >        
    $(document).ready(function() {
        // Javascript de la table de base
        $('#tabReservation').DataTable();
    });
</script>
