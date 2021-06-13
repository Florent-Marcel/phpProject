
<?php ob_start(); ?>
<h2>S'inscrire</h2>
        <form enctype="multipart/form-data" method="post" action="index.php?uc=nouvelUtilisateur">
            <p>
                <?php $name = isset($_POST['lastname']) ? $_POST['lastname'] : null; ?>
                <label for="lastname">Nom</label>
                <input type="text" id="lastname" name="lastname" value=<?php echo '"' . $name . '"'; ?> required/>
            </p>

            <p>
                <?php $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : null; ?>
                <label for="firstname">Prénom</label>
                <input type="text" id="firstname" name="firstname" value=<?php echo '"' . $firstname . '"'; ?> required/>
            </p>

            <p>
                <?php $address = isset($_POST['address']) ? $_POST['address'] : null; ?>
                <label for="address">Adresse</label>
                <input type="text" id="address" name="address" value=<?php echo '"' . $address . '"'; ?> required/>
            </p>

            <p>
                <?php $postcode = isset($_POST['postcode']) ? $_POST['postcode'] : null; ?>
                <label for="postcode">Code postale</label>
                <input type="text" id="postcode" name="postcode" value=<?php echo '"' . $postcode . '"'; ?> required/>
            </p>

            <p>
                <?php $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : null; ?>
                <label for="birthdate">Date de naissance</label>
                <input type="date" id="birthdate" name="birthdate" value=<?php echo '"' . $birthdate . '"'; ?> required/>
            </p>

            <p>
                <label for="email">e-mail</label>
                <input type="email" id="email" name="email" required/>
            </p>

            <p>
                <label for="pseudo">Pseudo</label>
                <input type="text" id="pseudo" name="pseudo" required/>
            </p>

            <p>
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required/>
            </p>

            <p>
                <label for="passwordRepeat">Retapez le mot de passe</label>
                <input type="password" id="passwordRepeat" name="passwordRepeat" required/>
            </p>

            <p>
                <label for="avatar">Avatar</label>
                <input type="file" id="avatar" name="avatar"/>
            </p>
            <input type="submit" value="Envoyer" />

            <?php
            
            ?>
        </form>

<?php $content = ob_get_clean(); 

require("template.php"); ?>