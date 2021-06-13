<?php

//Liste les dernières news
function listeDernierArticles(){
    $req = getArticles();

    require('vues/dernieresNews.php');
}

//Recherche un article
function rechercherArticles(){
    if(isset($_POST['aRechercher'])){
        $req = listeArticles($_POST['aRechercher']);
    }

    require('vues/dernieresNews.php');
}

//Affiche les commentaires d'un article
function unArticle(){
    if(isset($_GET['idNews'])){
        $news = getUnArticle($_GET['idNews']);
        $commentaires = getCommentaires($_GET['idNews']);
    } else{
        $erreur = "Vous n'avez pas sélectionné de news";
    }

    require('vues/unArtCom.php');
}

//Ajoute un commentaire
function nouveauCommentaire(){
    if(addUnCommentaire($_GET['idNews'], $_POST['texteCommentaire'], $_SESSION['login'])){
        $resultCommentaire = "L'ajout du commentaire a réussi";
    } else {
        $resultCommentaire = "L'ajout du commentaire a échoué";
    }
}
?>