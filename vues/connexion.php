<?php 
if(!isset($_SESSION['login'], $_SESSION['mdp'])){?>
    <h2>Se connecter</h2>
    <form enctype="multipart/form-data" method="post" action="index.php?uc=connexion">
        <p>
            <label for="pseudo">Pseudo</label>
            <input type="text" id="pseudo" name="pseudo" required/>
        </p>

        <p>
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required/>
        </p>
        <input type="submit" value="Envoyer" />
    </form>
    <?php
}
if (isset($resultConnexion)){
    ?><p><strong><?= $resultConnexion ?></strong></p><?php
}
?>
        