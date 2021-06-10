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
    ?></p>
    <form enctype="multipart/form-data" method="post" action="#">
        <p>
            <input type="hidden" name="login" value="<?=$login?>">
            <?php $address = isset($_POST['address']) ? $_POST['address'] : null; ?>
            <label for="address">Adresse</label>
            <input type="text" id="address" name="address" value=<?php echo '"' . $address . '"'; ?>/>
        </p>

        <p>
            <?php $postcode = isset($_POST['postcode']) ? $_POST['postcode'] : null; ?>
            <label for="postcode">Code postale</label>
            <input type="text" id="postcode" name="postcode" value=<?php echo '"' . $postcode . '"'; ?>/>
        </p>

        <p>
            <label for="email">e-mail</label>
            <input type="email" id="email" name="email"/>
        </p>

        <p>
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password"/>
        </p>

        <p>
            <label for="passwordRepeat">Retapez le mot de passe</label>
            <input type="password" id="passwordRepeat" name="passwordRepeat"/>
        </p>
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