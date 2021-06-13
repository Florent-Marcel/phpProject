

<?php $title = "Un article"; ?>



<?php 
if(isset($commentaires)){ 
    if(isset($news)){ ?>
        <p><a href="index.php?uc=news">Retour à la liste des news</a></p>
        <div class="news">
            <h3>
                <?= $news['titre'] ?> <em>le <?= $news['date_creation_fr'] ?></em>
            </h3>
            <p>
                <?= $news['corps'] ?>
            </p>
        </div> <?php
    } else { ?>
        <p><a href="index.php?uc=news">Retour au profil</a></p> <?php
    }
 ?>
    <h2>Commentaires</h2>

    <?php 
    $nbCom = 1;
    if($commentaires->rowCount() > 0){
        while($comment = $commentaires->fetch()){?>
            <p><?= $nbCom ?> - <strong><?= $comment['login'] ?></strong> le <?= $comment['dateCom'] ?></p>
            <p><?= nl2br($comment['commentaire']) ?></p>
            <?php $nbCom ++; ?>
            <?php
        } ?>
        <?php
        $commentaires->closeCursor();
    } else{
        ?><p>Il n'y a pas de commentaires</p><?php
    } 
    
    if(isset($news)){ ?>
        <h3>Ajouter un commentaire:</h3><?php
        if(isset($_SESSION['login']) and $_SESSION['indesirable'] == 0){ ?>
            <form method="POST" action="index.php?idNews=<?= $news['idNews'] ?>&amp;uc=nouveauCommentaire">
                <p>
                    Commentaire: <br />
                    <textarea name="texteCommentaire" required></textarea>
                </p>
                <p>
                    <input type="submit" value="enregistrer le commentaire" />
                </p>
            </form>
            <?php
        } elseif(isset($_SESSION['indesirable']) and $_SESSION['indesirable'] == 1){
            ?>
            <p>
                Vous avez été jugé comme indsirable et n'avez donc plus accès à cette partie du site.
            </p>
            <?php
        } else{
            ?>
            <p>
                Pour devez être connecter pour envoyer des commentaires.
                <a href="index.php?uc=afficheConnexion">Se connecter</a>
            </p>
            <?php
        }
    }
} else {
    if(isset($erreur)){
        ?><p><?= $erreur ?></p><?php
    }
}
?>
