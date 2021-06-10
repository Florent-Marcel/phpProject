<div id="contentarea">

<?php $title = "Un article"; ?>

<p><a href="index.php?uc=news">Retour à la liste des news</a></p>

<?php 
if(isset($commentaires, $news)){ ?>
    <div class="news">
        <h3>
            <?= $news['titre'] ?> <em>le <?= $news['date_creation_fr'] ?></em>
        </h3>
        <p>
            <?= $news['corps'] ?>
        </p>
    </div>

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
    } ?>
    <form method="POST" action="index.php?idNews=<?= $news['idNews'] ?>&amp;uc=nouveauCommentaire">
        <h3>Ajouter un commentaire:</h3>
        <p>
            Commentaire: <br />
            <textarea name="texteCommentaire" required></textarea>
        </p>
        <p>
            <input type="submit" value="enregistrer le commentaire" />
        </p>
    </form>
    <?php
} else {
    if(isset($erreur)){
        ?><p><?= $erreur ?></p><?php
    }
}
?>
</div>