<div class="sidebarheader">Chat</div>
<div class="widget"></div>        
        <script>
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
                    var login = "<?= $_SESSION['login'] ?>";
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
        //}
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