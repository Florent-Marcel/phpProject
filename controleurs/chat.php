<?php 

function avoirLesMessages(){
    return getMessages(0);
}

function avoirchat(){
    $messages = getMessages(0);

    require("vues/chat.php");
}

function ajouterMessage(){
    addUnMessage($_SESSION['login'], $_POST['message']);

}