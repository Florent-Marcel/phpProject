<div class="sidebarheader">News</div>
<br>
<?php $title = "Dernières news";
?>


<?php 
if(isset($_SESSION['admin']) and $_SESSION['admin'] == 1){
    ?>
    <h1>Créer une news</h1>
    <form enctype="multipart/form-data" method="POST" action="index.php?uc=adminNews">
        <p>
            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre" required>
        </p>
        <p>
            <label>Corps</label>
            <textarea name="corps" id="coprs" required></textarea>
        </p>
        <p>
            <input type="submit" value="Envoyer">
        </p>
    </form>

    <?php
}
?>
<h1>Rechercher</h1>
<form enctype="multipart/form-data" method="POST" action="index.php?uc=rechercherNews">
    <p>
        <label for="aRechercher">Rechercher:</label>
        <input type="text" name="aRechercher" id="aRechercher">
    </p>
    <p>
        <input type="submit" value="envoyer">
    </p>
</form>

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