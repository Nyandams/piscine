<!-- Table Jeu -->
<!-- js pour les tableaux-->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

<?php
$javaScript = '';


foreach ($zoneReserverCollection as $key => $zoneReserverDTO) {
    // Parcours de toute les zones
    $zoneDTO = $zoneReserverDTO->getZoneDTO();
    
    $capsuleTableauDebut = '<div class="col-lg-6 col-md-12">';
    
    // Création d'un tableau pour chaque zone
    $nomZone = $zoneDTO->getNomZone();
    $tabId = 'tab' . $nomZone;
    $tabHead = '
<h3><label class="label label-default">' . $nomZone . '</label></h3>
<table id="'. $tabId . '" class="table table-striped table-bordered col-sm-12 text-left" cellspacing="0" width="100%">
        <!-- Entete du tableau -->
    <thead>
         <tr>
            <th>Jeu</th>
            <th>Editeur</th> 
         </tr>
     </thead>
     <tfoot>
         <tr>
            <th>Jeu</th>
            <th>Editeur</th>      
         </tr>
     </tfoot>
     <tbody>';
    
    // Pourcours de chaque jeu de la zone pour remplir le tableau
    $ligne = '';
    $ensembleJeuEditeurReserverCollection = $zoneReserverDTO->getEnsembleJeuEditeur();
    
    foreach ($ensembleJeuEditeurReserverCollection as $key => $JeuEditDTO) {
        $jeuDTO = $JeuEditDTO->getJeuDTO();
        $editeurDTO = $JeuEditDTO->getEditeurDTO();
        
        $ligne = $ligne . '
            <tr>';
        $ligne = $ligne . '
                <td>' . $jeuDTO->getLibelleJeu() . '</td>';
        $ligne = $ligne . '
                <td>' . $editeurDTO->getLibelleEditeur() . '</td>';
        $ligne = $ligne . '
            </tr>';

    }
    
    $tabEnd = ' 
    </tbody>
</table>';
    // La variable javascript se passe de tabaleau en tableau pour ne pas faire plusieurs fois l'entete javascript
    $javaScript = $javaScript . '
            $("#' . $tabId .'").DataTable();';
    $capsuleTableauFin = '
</div>

';
   
    echo ($capsuleTableauDebut . $tabHead . $ligne . $tabEnd . $capsuleTableauFin); 
}
// Affiche le javacript tout à la fin

$javaScriptFinal = '<script type="text/javascript" >
        $(document).ready(function() {
            
            '. $javaScript .'
        });
    </script>';

echo $javaScriptFinal;

?>