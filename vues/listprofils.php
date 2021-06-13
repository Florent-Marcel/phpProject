<?php
?>
<table>
  <thead>
    <tr>
      <th>Login</th><th>Nom</th><th>Prénom</th><th>adresse</th><th>cp</th><th>email</th><th>Instription</th><th>Indésirable</th><th>Consulter</th>
    </tr>
  </thead>
    <?php
        while ($donnees = $users->fetch()) {?>
            <tr>
              <td><?=($donnees['login'])?></td>
              <td><?=($donnees['nom'])?></td>
              <td><?=($donnees['prenom'])?></td>
              <td><?=($donnees['adresse'])?></td>
              <td><?=($donnees['cp'])?></td>
              <td><?=($donnees['email'])?></td>
              <td><?=($donnees['dateInscription'])?></td>
              <td><?=($donnees['indesirable'])?></td>
              <td><a href="index.php?uc=administration21&idUtilisateur=<?=$donnees['idUtilisateur']?>">Consulter</a></td>
            </tr>
    <?php
    }
    ?>
</table>