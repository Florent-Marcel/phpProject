<div class="sidebarheader">Détails Factures</div>
<br>

<?php 


if(isset($detailsFacture)){
    $total = 0;
    while($detailFacture = $detailsFacture->fetch()){
        if($total == 0){
            ?>
            <h3>Facture numéro <?= $detailFacture['idFacture'] ?></h3>
            <?php
        }
        $total += $detailFacture['prixLigne'];
        ?>
        <p>
        <?= $detailFacture['nom'] ?> ➔ <?= $detailFacture['quantite'] ?> * <?= $detailFacture['prix'] ?>€ = <?= $detailFacture['prixLigne'] ?>
        </p>
        <?php
    }
    ?>
    <p>
        Total: <?= $total ?>€
    </p>
    <?php
} else{
    ?>
    <p>
        Vous ne pouvez pas accéder à cette facture
    </p>
    <?php
}
?>
<p>
    <a href="index.php?uc=factures">Retour</a>
</p>