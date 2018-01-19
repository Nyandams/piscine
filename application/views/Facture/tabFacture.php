<h1 id="titreInterface">Factures : </h1>
<!-- js pour les tableaux-->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>


<!-- Table Facture -->
<div id="blocTabFacture">

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
        <tbody>

        <!-- Insertion des données de manière dynamique -->
        <?php
                // Récupération des données
                $ligne = ''; // Stocke une ligne le temps de la créer
                
                foreach ($factureAffichageCollection as $factureAffichageDto) {   
                    // Chaque tour de boucle crée une ligne pour la table, avec les informations d'un éditeur.
                    $ligne = '<tr>';

                    $ligne = $ligne . '<td><a  href="' . site_url('ficheEditeur?idFicheEditeur='. $factureAffichageDto->getIdEditeur() ). '" >' . $factureAffichageDto->getLibelleEditeur() . '</a></td>';
                    $ligne = $ligne . '<td>'.$factureAffichageDto->getAnneeFestival().' </td>';
                    $ligne = $ligne . '<td>'.$factureAffichageDto->dateEmissionFactureToString().' </td>';
                    $ligne = $ligne . '<td>'.$factureAffichageDto->datePaiementFactureToString().' </td>';
                    $ligne = $ligne . '<td>'.$factureAffichageDto->getPrixNegociationReservation().' € </td>';     
                    $ligne = $ligne . '</tr>';
                    
                    echo  $ligne;
                }
                

                ?>


       	</tbody>
	</table>
    
    <div class="prixFacture">

        <div class="panel panel-default pull-left">

                        <div class="panel-heading">Montant total factures</div>
                        <div class="panel-body">
                                <?php
                                $prixTotalFactures = 0;
                                foreach ($factureAffichageCollection as $factureAffichageDto) {
                                        $prixTotalFactures += ($factureAffichageDto->getPrixNegociationReservation());
                                } 
                                echo $prixTotalFactures . ' €';
                                ?>
                        </div>
        </div>

        <div class="panel panel-default pull-left">
                        <div class="panel-heading">Montant total payé</div>

                        <div class="panel-body">
                                <?php
                                $prixTotalPaye = 0;
                                foreach ($factureAffichageCollection as $factureAffichageDto) {
                                        $datePaiement = $factureAffichageDto->getdatePaiementFacture();
                                        if ($datePaiement!=null) {
 
                                                $prixTotalPaye += ($factureAffichageDto->getPrixNegociationReservation());
                                        } 
                                }
                                echo $prixTotalPaye . ' €';
                                ?>
                        </div>
        </div>


        <div class="panel panel-default pull-left">
                        <div class="panel-heading">Montant total NON payé</div>

                        <div class="panel-body">
				<?php 
				echo ($prixTotalFactures - $prixTotalPaye) . ' €';
				?>
			</div>
        </div>


    </div>
</div>

<script type="text/javascript" >        
    $(document).ready(function() {
        // Javascript de la table de base
        $('#tabFacture').DataTable();
    });
</script>
