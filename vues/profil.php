<div class="sidebarheader">Profile</div>
<div class="widget"></div>
<?php
if(isset($login) and ($login == $_SESSION['login'] or (isset($_SESSION['admin']) and $_SESSION['admin'] == 1))){
    ?><p>
        <img src=<?php echo $avatar; ?> alt="Avatar" /><br/><?php
        echo "Nom: " .$nom; ?><br/><?php
        echo "Prenom: " .$prenom; ?><br/><?php
        echo "Adresse: " .$adresse; ?><br/><?php
        echo "Cp: " .$cp; ?><br/><?php
        echo "Date de naissance: " .$dateDeNaissance; ?><br/><?php
        echo "Email: " .$email; ?><br/><?php
        echo "Login: " .$login; ?><br/><?php
        echo "DateInscription: " .$dateInscription; ?><br/><?php
        if(isset($logToday, $logPast7Days) and $logToday != -1 and $logPast7Days != -1){
            echo "nombre de connexions aujourd'hui: " .$logToday; ?><br/><?php
            echo "nombre de connexions lors des 7 derniers jours: " .$logPast7Days; ?><br/><?php
        }
        if(isset($idUtilisateur)){ ?>
            <a href='index.php?uc=administration3&idUtilisateur=<?= $idUtilisateur ?>'>Voir les factures</a>
            <a href='index.php?uc=administration4&idUtilisateur=<?= $idUtilisateur ?>'>Voir les commentaires</a>
            <?php
        }
    ?></p>
    <form enctype="multipart/form-data" method="post" action="#">
            <?php 
            if(isset($_SESSION['admin']) and $_SESSION['admin'] == 1){
                ?>
                <p>
                    <label for="login">Login</label>
                    <input type="text" name="login" id="login" value="<?= $login ?>">
                </p><?php
            } else{
                ?><input type="hidden" name="login" value="<?= $login ?>"><?php
            } ?>
            
            <label for="address">Adresse</label>
            <input type="text" id="address" name="address" value="<?= $adresse ?>"/>

        <p>
            <label for="postcode">Code postale</label>
            <input type="text" id="postcode" name="postcode" value="<?= $cp ?>"/>
        </p>

        <p>
            <label for="email">e-mail</label>
            <input type="email" id="email" name="email" value="<?= $email ?>"/>
        </p>

        <p>
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password"/>
        </p>

        <p>
            <label for="passwordRepeat">Retapez le mot de passe</label>
            <input type="password" id="passwordRepeat" name="passwordRepeat"/>
        </p>

        <?php 
        if(isset($_SESSION['admin']) and $_SESSION['admin'] == 1){
            ?>
            <p>
                <label for="indesirable">Indésirable</label>
                <input type="checkbox" id="indesirable" name="indesirable" <?php echo (isset($indesirable) and $indesirable == '1') ? 'checked' : ''; ?> />
            </p>
            <?php 
        } ?>

        <input type="submit" value="Modifier" />
    </form>
    <?php 
    if(isset($resultUpdate)){
        echo $resultUpdate;
    }
} else{
    if(isset($erreur))
        echo $erreur;
    }?>