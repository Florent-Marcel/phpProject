<div class="sidebarheader">News</div>
<br>
<?php $title = "Dernières news";
?>

<h1>Les dernières news !</h1>
<p>Les 3 dernières news: </p>

<?php 

while($donnees = $req->fetch()){
    ?>
    <div class="news">
        <h3>
            <?= ($donnees['titre']) ?>
        

        <em>le <?= $donnees['date_creation_fr'] ?></em>

        </h3>

        <p>
            <?= nl2br($donnees['corps']) ?>
            <br/>
            <em><a href="index.php?idNews=<?= $donnees['idNews'] ?>&uc=unarticle">Commentaires</a></em>
        </p>
    </div>
<?php    
}
?>