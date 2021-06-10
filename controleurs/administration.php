<?php

require_once("modeles/data.php");
require_once("modeles/uploadImage.php");


function profil2()
{
    if (isset($_GET['login'])) {
        $user = getUser($_GET['login']);
        $nom = $user['nom'];
        $prenom = $user['prenom'];
        $adresse = $user['adresse'];
        $cp = $user['cp'];
        $dateDeNaissance = $user['dateDeNaissance'];
        $email = $user['email'];
        $login = $user['login'];
        $avatar = $user['avatar'];
        $dateInscription = $user['dateInscription'];

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
            $result = updateUser($_POST['login'], $_POST['address'], $_POST['postcode'], $_POST['email'], $_POST['password']);
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

function viewLogs()
{
    if (isset($_SESSION['admin'])){
        if ($_SESSION['admin']='1') {
            $result = viewLogUser($user);
        }
    }
    require('vues/dernierslog.php');
}

function adminVueProf(){
    require("vues/profil.php");
}
