<?php 

//Récupérer les messages
function avoirLesMessages(){
    return getMessages(0);
}

//Affiche le chat
function avoirchat(){
    $messages = getMessages(0);

    require("vues/chat.php");
}

//Ajoute un message
function ajouterMessage(){
    addUnMessage($_SESSION['login'], $_POST['message']);

}