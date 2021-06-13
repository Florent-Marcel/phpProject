<div id="contentarea">
<p>
    <form method="post" action="index.php?uc=shop">
        <select name="categorie" onchange="this.form.submit()">
        <?php 
        if(isset($categories)){
            while($categorie = $categories->fetch()){
                ?>
                <option valeur="<?=$categorie['categorie'] ?>" 
                <?php if((isset($_POST['categorie'])) and ($_POST['categorie'] == $categorie['categorie'])){
                    ?> selected="selected" <?php 
                } ?>
                ><?=$categorie['categorie'] ?></option>
                <?php
            }
        } ?>
        </select>
    </form>
</p>
<?php

if(isset($articles)){
    //echo $_POST['categorie'];
    ?>
    <?php
    while($article = $articles->fetch()){
        ?>
        <form method="post" action="index.php?uc=shop">
            <input type="hidden" name="categorie" value="<?= $_POST['categorie'] ?>" >
            <input type="hidden" name="idArticle" value="<?= $article['idArticle'] ?>"/> <?=$article['nom']?> - <?=$article['prix']?>€
            <select name="nbArticles">
                <?php
                if($article['disponible'] = 1){ 
                    $i = 0;
                    while($i <= 10 and $i <= $article['stock']){
                        ?>
                        <option value="<?=$i?>"><?=$i?></option>
                        <?php
                        $i++;
                    } 
                } else{
                    ?>- Non disponible <?php
                }
                ?>
            </select>
            <?php if (isset($_SESSION['idUtilisateur'])){ ?>
              <input type="submit" value="Ajouter au panier"> <?php } ?>
        </form>
        <?php
    }
}

if(isset($_SESSION['login']) and $_SESSION['indesirable'] == 0){ 
    if(isset($_SESSION['panier'])){
        //echo implode(",", array_keys($_SESSION['panier']));
        //print_r($_SESSION['panier']);
        ?>
        <h3>Panier</h3>
        <?php
        if(isset($articlesShop)){
            $total = 0;
            $calcul = 0;
            if($articlesShop->rowCount() > 0){
                while($articleShop = $articlesShop->fetch()){
                    $calcul = $articleShop['prix'] * $_SESSION['panier'][$articleShop['idArticle']];
                    $total += $calcul
                    ?>
                    <p>
                    <?= $articleShop['nom'] ?> 	➔ <?= $_SESSION['panier'][$articleShop['idArticle']] ?> * <?= $articleShop['prix'] ?>€ = <?= $calcul ?>€
                    </p>
                    <?php
                }
                $_SESSION['total'] = $total;
                ?>
                <p>
                
                Total: <?= $total ?>€
                </p>
                <p>
                    <form method="post" action="index.php?uc=factures&payement=1">
                        <input type="hidden" name="payement" value="ok">
                        <input type="submit">
                    </form>
                </p>
                <?php
            } else{
                ?><p><strong>Le panier est vide</strong></p><?php
            }
        }
    }
} elseif(isset($_SESSION['indesirable']) and $_SESSION['indesirable'] == 1){
    ?>
    <p>
        Vous avez été jugé comme indsirable et n'avez donc plus accès à cette partie du site.
    </p>
    <?php
} else{
    ?>
    <p>
        Pour devez être connecter pour pouvoir acheter.
        <a href="index.php?uc=afficheConnexion">Se connecter</a>
    </p>
    <?php
}

?>
</div>