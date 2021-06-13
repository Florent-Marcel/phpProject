<div class="sidebarheader">Factures</div>
<br>
<?php 
if(isset($factures)){
    while($facture = $factures->fetch()){
        ?>
        <h3>num facture: <?= $facture['idFacture'] ?></h3>
        <p>
        Date facture:  <?= $facture['dateFR'] ?>
        <br />
        Total: <?= $facture['prixTotal'] ?>€
        </p>
        
        <form method="POST" action="index.php?uc=detailsFacture">
            <p>
                <input type="hidden" name="idFacture" value=<?= $facture['idFacture'] ?>>
                <input type="submit" value="Voir détails">
            </p>
        </form>
        <?php
    }
}