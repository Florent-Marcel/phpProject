<?php
function listeDernierArticles(){
    $req = getArticles();

    require('vues/dernieresNews.php');
}

function rechercherArticles(){
    if(isset($_POST['aRechercher'])){
        $req = listeArticles($_POST['aRechercher']);
    }

    require('vues/dernieresNews.php');
}

function unArticle(){
    if(isset($_GET['idNews'])){
        $news = getUnArticle($_GET['idNews']);
        $commentaires = getCommentaires($_GET['idNews']);
    } else{
        $erreur = "Vous n'avez pas sélectionné de news";
    }

    require('vues/unArtCom.php');
}

function nouveauCommentaire(){
    if(addUnCommentaire($_GET['idNews'], $_POST['texteCommentaire'], $_SESSION['login'])){
        $resultCommentaire = "L'ajout du commentaire a réussi";
    } else {
        $resultCommentaire = "L'ajout du commentaire a échoué";
    }
}
?>