<?php
?>
<p><table>
  <th><tr>
    <td>Login</td><td>Nom</td><td>Prénom</td><td>adresse</td><td>cp</td><td>email</td>Instription</th><td>Indésirable</td>
  </tr></th>
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
</table></p>