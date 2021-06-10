<div class="sidebarheader">Factures</div>
<br>
<?php 
if(isset($factures)){
    while($facture = $factures->fetch()){
        ?>
        <p>
        <h3>num facture: <?= $facture['idFacture'] ?></h3>
        Date facture:  <?= $facture['dateFR'] ?>
        <br />
        Total: <?= $facture['prixTotal'] ?>€
        </p>
        <p>
        <form method="POST" action="index.php?uc=detailsFacture">
            <input type="hidden" name="idFacture" value=<?= $facture['idFacture'] ?>>
            <input type="submit" value="Voir détails">
        </form>
        </p>
        <?php
    }
}