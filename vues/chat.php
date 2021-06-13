<div class="sidebarheader">Chat</div>
<div class="widget"></div>        



        <script>
            //alert("ds");
            <?php require("scripts/Message.js"); ?>

            <?php require("scripts/Chat.js"); ?>
            
            var monChat = new Chat();

            function func(){
                event.preventDefault();
                var req = new XMLHttpRequest();
                var messageText = document.getElementById("messageToSend").value;
                var erreur = document.getElementById("erreur");
                document.getElementById("erreur").removeChild(erreur.firstChild);
                if(messageText.length >= 1000){
                    let pe = document.createElement("p");
                    pe.innerHTML = "<strong>Votre message est trop long</strong>";
                    document.getElementById("erreur").appendChild(pe);
                } else{
                    var login = "<?php echo (isset($_SESSION['login'])) ? $_SESSION['login'] : ''; ?>";
                    req.open("GET", "./ajax/ajax.php?AjaxUc=sendMessage&messageText="+messageText+"&login="+login, false);
                    req.send(null);
                    if(req.responseText != 0)
                    {
                        document.getElementById("messageToSend").value = "";
                        monChat.getData();
                    }
                }
            }

            
            
        </script>
        <div id="chat">
        </div>
        <div id="erreur">
        </div>
        <script>
        monChat.getData();
        var t=setInterval(function(){
            monChat.getData();
        },1000);
        </script>
        <?php
        if(isset($_SESSION['login']) and $_SESSION['indesirable'] == 0){
        ?>
        <form method="post" action="index.php?uc=chat">
            <p>
                <input type="submit" value="rafraichir">
            </p>
        </form>

        <form method="post" onsubmit="func()">
            <p>
                <textarea id="messageToSend" name="message" required></textarea>
            </p>
            <p>
                <input type="submit" value="envoyer message">
            </p>
        </form>
        
        <?php 
        } elseif(isset($_SESSION['indesirable']) and $_SESSION['indesirable'] == 1){
            ?>
            <p>
                Vous avez été jugé comme indsirable et n'avez donc plus accès à cette partie du site.
            </p>
            <?php
        } else{
            ?>
            <p>
                Pour devez être connecter pour envoyer des messages.
                <a href="index.php?uc=afficheConnexion">Se connecter</a>
            </p>
            <?php
        }
?>