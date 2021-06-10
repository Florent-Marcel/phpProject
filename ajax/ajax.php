<?php 
header('Content-Type: text/xml');
require('../modeles/data.php');

function avoirLesMessages($id){
    return getMessages($id);
}

function ajouterMessage($login, $message){
    return addUnMessage($login, $message);

}

switch($_GET['AjaxUc']){
    case 'getMessages' :{
        if(isset($_GET['id'])){
            echo '<?xml version="1.0" encoding="utf-8" ?>';
            $messages =  avoirLesMessages($_GET['id']);
            echo "<result>";
            echo "<messages>";
            $nbMessages = 0;
            while($donnees = $messages->fetch()){
                echo "<message>";
                echo "<login>";
                echo $donnees['login']; 
                echo "</login>";

                echo "<text>";
                echo $donnees['message']; 
                echo "</text>";

                echo "<dateFR>";
                echo $donnees['dateFR']; 
                echo "</dateFR>";

                echo "<id>";
                echo $donnees['idChatMessage']; 
                echo "</id>";

                echo "</message>";
                $nbMessages++;
            }
            echo "</messages>";
            echo "<nbMessages>";
            echo $nbMessages; 
            echo "</nbMessages>";
            echo "</result>";
        }
    }  break;

    case 'sendMessage' :{
        if(isset($_GET['messageText'], $_GET['login'])){
            if(addUnMessage($_GET['login'], $_GET['messageText'])){
                echo "réussi";
            }
        }
        break;
    }
}
?>