<?php

require_once("modeles/data.php");
require_once("modeles/uploadImage.php");
require_once("controleurs/News.php");


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

function listProfils()
{
    $users = getUsers();
    require("vues/listprofils.php");
}

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

function adminGetFactures(){
    $factures = getFacturesByIDUtilisateur($_GET['idUtilisateur']);

    require('vues/factures.php');
}

function adminVueProf(){
    require("vues/profil.php");
}

function admincommentaires(){
    if(isset($_GET['idUtilisateur'])){
        $commentaires = getCommentairesUser($_GET['idUtilisateur']);
    } else{
        $erreur = "Vous n'avez pas sélectionné d'utilisateur";
    }

    require('vues/unArtCom.php');
}

function adminNews(){
    if(isset($_POST['titre'], $_POST['corps'], $_SESSION['idUtilisateur']) and $_SESSION['admin'] == 1){
        insertNews($_SESSION['idUtilisateur'], $_POST['titre'], $_POST['corps']);
        unset($_POST['titre'], $_POST['corps']);
    }

    header("LOCATION: index.php?uc=news");
}