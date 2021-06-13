<?php

require("modeles/data.php");
require("modeles/uploadImage.php");

function nouvelUtilisateur(){
    $reussieInscription = false;
    $doublon = checkDuplicateUser($_POST['pseudo'], $_POST['email']);
    if (!$doublon) {
        $check = newUser($_POST['lastname'], $_POST['firstname'], $_POST['address'], $_POST['postcode'], $_POST['birthdate'], $_POST['email'], $_POST['pseudo'], $_POST['password']);
        if ($check) {
            $messageInscription = "L'inscription a réussi";
            $reussieInscription = true;
            if (!empty($_FILES["avatar"]["name"])) {
                if (uploadImageAndLink($_FILES["avatar"], $_POST['pseudo'])) {
                    $messageImage = "Votre image a été uploadé avec succès";
                } else {
                    $messageImage = "Il y a eu une erreur avec votre image";
                }
            }
        } else {
            $messageInscription = "L'inscription a échoué";
        }
    } else {
        $messageInscription = "Le pseudo ou l'adresse email est déja utilisée, veuillez recommencer.";
    }

    require("vues/resultatInscription.php");
    return $reussieInscription;
}

function inscription()
{
    require("vues/inscription.php");
}

function connexion()
{
    if (isset($_POST['pseudo'], $_POST['password'])) {
        $user = connectUser($_POST['pseudo'], $_POST['password']);
        if ($user) {
            $_SESSION['login'] = $user['login'];
            $_SESSION['avatar'] = $user['avatar'];
            $_SESSION['idUtilisateur'] = $user['idUtilisateur'];
            $_SESSION['admin'] = $user['admin'];
            $_SESSION['indesirable'] = $user['indesirable'];
            addLog($_SESSION['login']);
            $resultConnexion = "Connexion réussie, bienvenue " . $_SESSION['login'];
        } else {
            $resultConnexion = "Connexion échouée, mauvais mot de passe ou login";
        }
    } else {
        $resultConnexion = "Les champs doivent être complétés";
    }
    if (!isset($_SESSION['login'])) {
        require("vues/connexion.php");
    } elseif (isset($_POST['pseudo'], $_POST['password'])){
        header("Refresh:0");
    }
}

function afficheConnexion(){
    require("vues/connexion.php");
}

function deconnexion()
{
    if (isset($_SESSION['login'])) {
        unset($_SESSION['login']);
        unset($_SESSION['avatar']);
        unset($_SESSION['panier']);
        unset($_SESSION['idUtilisateur']);
        unset($_SESSION['admin']);
        unset($_SESSION['indesirable']);
        $resultdeco = "Déconnexion réussie";
        header("Refresh:1");
    }
    require("vues/deconnexion.php");
}

function profil()
{
    if (isset($_SESSION['login'])) {
        $user = getUser($_SESSION['login']);
        $nom = $user['nom'];
        $prenom = $user['prenom'];
        $adresse = $user['adresse'];
        $cp = $user['cp'];
        $dateDeNaissance = $user['dateDeNaissance'];
        $email = $user['email'];
        $login = $user['login'];
        $avatar = $user['avatar'];
        $dateInscription = $user['dateInscription'];

        $resultUpdate = updateProfil();
        if ($resultUpdate == "La modification a réussi") {
            header("Refresh:1");
        }
    } else {
        $erreur = "Vous n'êtes pas connecté";
    }

    require("vues/profil.php");
}

function updateProfil()
{
    if (isset($_POST['address']) or (isset($_POST['postcode'])) or (isset($_POST['email'])) or ((isset($_POST['password'])) and (isset($_POST['passwordRepeat'])))) {
        if ($_POST['password'] == $_POST['passwordRepeat']) {
            $result = updateUser($_SESSION['login'], $_POST['address'], $_POST['postcode'], $_POST['email'], $_POST['password']);
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
