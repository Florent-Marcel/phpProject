<?php

require_once("modeles/data.php");
require_once("modeles/uploadImage.php");
require_once("controleurs/News.php");

//Modifie et affiche un utilisateur
function profil2()
{
    if (isset($_GET['idUtilisateur'])) {
        $user = getUserbyID($_GET['idUtilisateur']);
        $idUtilisateur = $user[('idUtilisateur')];
        $nom = $user['nom'];
        $prenom = $user['prenom'];
        $adresse = $user['adresse'];
        $cp = $user['cp'];
        $dateDeNaissance = $user['dateDeNaissance'];
        $email = $user['email'];
        $login = $user['login'];
        $avatar = $user['avatar'];
        $dateInscription = $user['dateInscription'];
        $indesirable = $user['indesirable'];
        $logToday = getLogUserToday($user['idUtilisateur']);
        $logPast7Days = getLogUserPastDays($user['idUtilisateur'], 7);

        $resultUpdate = updateProfilByAdmin();
        if ($resultUpdate == "La modification a réussi") {
            header("Refresh:1");
        }
    } else {
        $erreur = "Vous n'êtes pas connecté";
    }

    require("vues/profil.php");
}

//Liste les utilisateurs
function listProfils()
{
    $users = getUsers();
    require("vues/listprofils.php");
}

//Modifie un profil
function updateProfilByAdmin()
{
    if (isset($_POST['login']) and (($_POST['address']) or (isset($_POST['postcode'])) or (isset($_POST['email'])) or ((isset($_POST['password'])) and (isset($_POST['passwordRepeat']))))) {
        if ($_POST['password'] == $_POST['passwordRepeat']) {
            if(isset($_POST['indesirable'])){
                $indesirable = 1;
            } else {
                $indesirable = 0;
            }
            echo $indesirable;
            $result = updateUser($_POST['login'], $_POST['address'], $_POST['postcode'], $_POST['email'], $_POST['password'], $indesirable);
            if ($result) {
                return "La modification a réussi";
                header("Refresh:1");
            } else {
                return "La modification a échoué";
            }
        } else {
            return "Les deux mots de passes ne sont pas égaux";
        }
    }
}

//Récupère les factures d'un utilisateur
function adminGetFactures(){
    $factures = getFacturesByIDUtilisateur($_GET['idUtilisateur']);

    require('vues/factures.php');
}

//Active la vue d'un profil
function adminVueProf(){
    require("vues/profil.php");
}

//Récupère les commentaires d'un utilisateur
function admincommentaires(){
    if(isset($_GET['idUtilisateur'])){
        $commentaires = getCommentairesUser($_GET['idUtilisateur']);
    } else{
        $erreur = "Vous n'avez pas sélectionné d'utilisateur";
    }

    require('vues/unArtCom.php');
}

//Ajoute une news
function adminNews(){
    if(isset($_POST['titre'], $_POST['corps'], $_SESSION['idUtilisateur']) and $_SESSION['admin'] == 1){
        insertNews($_SESSION['idUtilisateur'], $_POST['titre'], $_POST['corps']);
        unset($_POST['titre'], $_POST['corps']);
    }

    header("LOCATION: index.php?uc=news");
}

//Supprime un article
function adminDeleteArticle(){
    if(isset($_GET['idArticle'], $_SESSION['admin']) and $_SESSION['admin'] == 1){
        deleteArticle($_GET['idArticle']);
    }

    header("LOCATION: index.php?uc=shop");
}

//Ajoute un article
function adminAddArticle(){
    if(isset($_POST['nom'], $_POST['categorie'], $_POST['prix'], $_POST['stock'], $_SESSION['admin']) and $_SESSION['admin'] == 1){
        insertArticle($_POST['nom'], $_POST['categorie'], $_POST['prix'], $_POST['stock']);
    }

    header("LOCATION: index.php?uc=shop");
}