<?php 
if(session_id() == ""){
    session_start();
}

if((isset($_SESSION['login'])) and isset($_SESSION['avatar'])){
    ?>
    <h3>Bienvenue <?php echo $_SESSION['login']; ?></h3>
    <br />
    <img src=<?php echo $_SESSION['avatar']; ?> alt="test"  >
    <?php
} 
$title = 'index';

ob_start(); 
define("serveur", "mysql:host=localhost");
//echo serveur;
//include 'vues/entete.php';
//include 'vues/menu.php';

require("vues/menu.php");

require("controleurs/connexionInscription.php");
require("controleurs/News.php");
require("controleurs/Chat.php");
require("controleurs/shop.php");
require("controleurs/administration.php");


    if(!isset($_REQUEST['uc']))
        $uc = 'accueil';
    else
        $uc = $_REQUEST['uc'];

    switch ($uc){
        case 'inscription':{
            inscription();
            break;
        }

        case 'nouvelUtilisateur':{
            $reussieInscription = false;
            if (isset($_POST['lastname'], $_POST['firstname'], $_POST['address'], $_POST['postcode'], $_POST['birthdate'], $_POST['email'], $_POST['pseudo'], $_POST['password'], $_POST['passwordRepeat'])) {
                if ($_POST['password'] == $_POST['passwordRepeat']) {
                    $reussieInscription = nouvelUtilisateur();
                } else{
                    
                    ?><p><strong>Les deux mots de passes ne sont pas égaux</strong></p><?php
                }
            } else{
                ?><p><strong>Les champs doivent être complétés</strong></p><?php
            }
            if(!$reussieInscription){
                inscription();
            }
            break;
        }

        case 'connexion':{
                connexion();
                
            break;
        }

        case 'afficheConnexion':{
                afficheConnexion();
            break;
        }

        case 'deconnexion':{
                deconnexion();
            break;
        }

        case 'profil':{
                profil();
            break;
        }

        case 'chat':{
            avoirchat();
            break;
        }

        case 'postMessage':{
            if(isset($_SESSION['login'], $_POST['message'])){
                if($_POST['message'] <> ""){
                    if(strlen($_POST['message']) < 1000){
                        ajouterMessage();
                    } else{
                        ?><p><strong>Votre message est trop long</strong></p><?php
                    }
                } else{
                    ?><p><strong>Votre message ne doit pas être vide</strong></p><?php
                }
            } else{
                if(!isset($_SESSION['login'])){
                    ?><p><strong>Vous devez être connecté pour poster un message</strong></p><?php
                } elseif(!isset($_POST['message'])){
                    ?><p><strong>Votre message ne doit pas être vide</strong></p><?php
                }
            }
            avoirchat();
            break;
        }

        case 'news':{
                listeDernierArticles();
            break;
        }

        case 'unarticle':{
            unArticle();
            break;
        }

        case 'nouveauCommentaire':{  
            if((isset($_SESSION['login'], $_POST['texteCommentaire'])) and ((!empty($_POST['texteCommentaire'])))){
                nouveauCommentaire();
            } else{
                if(!isset($_SESSION['login'])){
                    ?><p><strong>Vous devez être connecté pour poster un message</strong></p><?php
                } 
                if((!isset($_POST['texteCommentaire'])) or (empty($_POST['texteCommentaire']))){
                    ?><p><strong>Le commentaire ne peut pas être vide</strong></p><?php
                }
            }
            unArticle();
            
            break;
        }

        case 'shop':{
            if(isset($_POST['idArticle']) and isset($_POST['nbArticles'])){
                panier();
            } 
            shop();

            break;
        }

        case 'factures':{
            if(isset($_POST['payement']) and $_POST['payement'] = "ok"){
                facturer();
            }
            factures();

            break;
        }

        case 'detailsFacture':{
            detailsFacture();

            break;
        }
        case 'administration1':{
            //editBlog();
            break;
        }
        case 'administration2':{
            listprofils();
            break;
        }
        case 'administration21':{
            profil2();
            break;
        }
        case 'administration3':{
            adminGetFactures();
            break;
        }
        case 'administration4':{
            admincommentaires();
            break;
        }
        case 'adminNews':{
            adminNews();
            break;
        }
        case 'accueil': default:{
            $onIndex = true;
                //&&include("vues/accueil.php");
                break;
            }
            
        
    }

$content = ob_get_clean(); 

        require('template.php');


//include 'vues/fin.php';?>
