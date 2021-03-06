<?php
define("server", "mysql:host=localhost");
define("bdd", "dbname=projetdevweb");
define("user", "root");

//Connecte à la base de donnée
function connect(){
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=projetdevweb;charset=utf8', 'root', 'root');
        $bdd->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(Exception $e){
        die('Erreur : '.$e->getMessage());
    }
    return $bdd;
}

//
//Utilisateur
//

//Vérifie s'il y a doublon utilisateur
function checkDuplicateUser($login, $email){
    $bdd = connect();
    $reponse = $bdd->prepare('Select login, email FROM utilisateurs');
    $reponse->execute();
    $doublon = false;
    while($donnes = $reponse->fetch()){
        if(strcmp($donnes['login'], $login) == 0 || strcmp($donnes['email'], $email) == 0){
            $doublon = true;
            break;
        }
    }
    return $doublon;
}

//Crée un nouvel utilisateur
function newUser($lastname, $firstname, $address, $postcode, $birthdate, $email, $pseudo, $password){
    $bdd = connect();
    $req = $bdd->prepare('INSERT INTO utilisateurs(nom, prenom, adresse, cp, dateDeNaissance, email, login, motDePasse) VALUES(:lastname, :firstname, :address, :postcode, :birthdate, :email, :pseudo, :password)');
    $check = $req->execute(array(
        'lastname' => htmlentities($lastname),
        'firstname' => htmlentities($firstname),
        'address' => htmlentities($address),
        'postcode' => htmlentities($postcode),
        'birthdate' => htmlentities($birthdate),
        'email' => htmlentities($email),
        'pseudo' => htmlentities($pseudo),
        'password' => password_hash(htmlentities($password), PASSWORD_DEFAULT)
    )) or die(print_r($req->errorInfo()));

    return $check;
}

//Modifie un utilisateur
function updateUser($login, $address = "", $postcode = "", $email = "", $password = "", $indesirable = ""){
    $bdd = connect();
    $user = getUser($login);
    if($user){
        if($address == ""){
            $address = $user['adresse'];
        }
        if($postcode == ""){
            $postcode = $user['cp'];
        }
        if($email == ""){
            $email = $user['email'];
        }
        if($password == ""){
            $password = $user['motDePasse'];
        } else{
            $password = password_hash($password, PASSWORD_DEFAULT);
        }
        if($indesirable === ""){
            $indesirable = $user['indesirable'];
        }
        $req = $bdd->prepare('UPDATE utilisateurs 
                                set adresse=:address, cp=:cp, email=:email, motDePasse=:password, indesirable=:indesirable 
                                where login=:login ');
        $check = $req->execute(array(
            'address' => htmlentities($address),
            'cp' => htmlentities($postcode),
            'email' => htmlentities($email),
            'login' => htmlentities($login),
            'password' => htmlentities($password),
            'indesirable' => htmlentities($indesirable),
        )) or die(print_r($req->errorInfo()));
        
        return $check;
    }
}

//Relie une image à un utilisateur
function linkImage($img, $login){
    $bdd = connect();

    $req = $bdd->prepare('UPDATE utilisateurs set avatar=:avatar where login=:login ');
    $check = $req->execute(array(
        'avatar' => htmlentities(getTargetFile($img, $login)),
        'login' => htmlentities($login)
    )) or die(print_r($req->errorInfo()));
    
    return $check;
}

//Connecte un utilisateur
function connectUser($login, $mdp){
    //$mdp = "1";
    $user = getUser($login);
    if($user){
        if ($user) {
            if (($mdp == $user['motDePasse']) or (password_verify($mdp, $user['motDePasse']))){
                
                //$result = [$row['login'], $row['avatar']];
                return $user;
            }
        }
    }
    return false;
}

//Enregistre la connexion d'un utilisateur dans les logs
function addLog($login){
    $bdd = connect();
    $user = getUser($login);
    if ($user) {
        $id = $user['idUtilisateur'];
        $req = $bdd->prepare("INSERT into logconnexions(idUtilisateur, dateConnexion) VALUES(:idUtilisateur, :dateConnexion)");
        $check = $req->execute(array(
        ':idUtilisateur' => htmlentities($id),
        ':dateConnexion' => date("Y-m-d H:i:s"),
    )) or die(print_r($req->errorInfo()));
    }

    if(isset($check)){
        return $check;
    }
    return false;
}

//Récupère un utilisateur sur base de son login
function getUser($login){
    $bdd = connect();
    $req = $bdd->prepare("SELECT * FROM utilisateurs WHERE login=:login");
    $check = $req->execute(array(
        ':login' => $login,
    )) or die(print_r($req->errorInfo()));

    if ($req->rowCount() > 0) {
        $row = $req->fetch();
        return $row;
    }
    return false;
}

//Récupère un utilisateur sur base de son ID
function getUserbyID($idUtilisateur){
    $bdd = connect();
    $req = $bdd->prepare("SELECT * FROM utilisateurs WHERE idUtilisateur=:idUtilisateur");
    $check = $req->execute(array(
        ':idUtilisateur' => $idUtilisateur,
    )) or die(print_r($req->errorInfo()));

    if ($req->rowCount() > 0) {
        $row = $req->fetch();
        return $row;
    }
    return false;
}

//
//News
//

//Récupère les articles
function getArticles(){
    $bdd = connect();
    $req = $bdd->query('SELECT idNews, titre, corps, DATE_FORMAT(dateCreation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr 
                            FROM News 
                            ORDER BY dateCreation desc limit 0, 3 ');

    return $req;
}

//Recherche des articles
function listeArticles($recherche){
    $bdd = connect();
    $recherche =  "%" . htmlentities($recherche) . "%";
    echo $recherche;
    $req = $bdd->prepare('SELECT idNews, titre, corps, DATE_FORMAT(dateCreation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr 
                            FROM News 
                            where titre like :recherche1 OR corps like :recherche2
                            ORDER BY dateCreation desc limit 0, 3 ');
    $req->execute(array(
        ':recherche1' => $recherche,
        ':recherche2' => $recherche,
    ));

    return $req;
}

//Récupérer un article
function getUnArticle($idNews){
    $bdd = connect();

    $req = $bdd->prepare('SELECT idNews, titre, corps, DATE_FORMAT(dateCreation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr 
                            FROM News 
                            where idNews=:idNews 
                            ORDER BY dateCreation desc limit 0, 3 ');
    $req->execute(array(
        ':idNews' => htmlentities($idNews),
    ));

    $news = $req->fetch();
    return $news;
}

//Récupérer les commentaires d'un article
function getCommentaires($idNews){
    $bdd = connect();

    $req = $bdd->prepare('SELECT idNews, login, commentaire, DATE_FORMAT(commentaires.dateCreation, \'%d/%m/%Y à %Hh%imin%ss\') AS dateCom
                             FROM Commentaires
                             join Utilisateurs on Utilisateurs.idUtilisateur = Commentaires.idUtilisateur
                             where idNews=:idNews order by commentaires.dateCreation asc');
    $req->execute(array(
        ':idNews' => htmlentities($idNews),
    ));

    return $req;
}

//Ajoute un commentaire
function addUnCommentaire($idNews, $texte, $login){
    $bdd = connect();
    $user = getUser($login);
    $req = $bdd->prepare('INSERT INTO Commentaires (idNews, idUtilisateur, commentaire) VALUES (:idNews, :idUtilisateur, :commentaire)');
    $result = $req->execute(array(
        ':idNews' => htmlspecialchars($idNews),
        ':idUtilisateur' => htmlentities($user['idUtilisateur']),
        ':commentaire' => htmlentities($texte),
    ));
    return $result;
}

//
//Chat
//

//Récupérer les messages
function getMessages($id){
    $bdd = connect();
    $req = $bdd->query('SELECT idChatMessage, login, message, DATE_FORMAT(dateMessage, \'%d/%m/%Y à %Hh%imin%ss\') AS dateFR 
                            FROM ChatMessages 
                            join Utilisateurs on ChatMessages.idUtilisateur = Utilisateurs.idUtilisateur
                            where idChatMessage > ' . $id . '
                            ORDER BY dateMessage desc limit 10');
    return $req;
}

//Ajoute un message
function addUnMessage($login, $message){
    $bdd = connect();
    $user = getUser($login);

    $req = $bdd->prepare('INSERT INTO chatMessages (idUtilisateur, message) VALUES (:idUtilisateur, :message)');
    $result = $req->execute(array(
        ':idUtilisateur' => htmlentities($user['idUtilisateur']),
        ':message' => htmlentities($message),
    ));
    return $result;
}

//
//Shop
//

//Récupères les catégories des articles
function getCategoriesArticles(){
    $bdd = connect();

    $req = $bdd->query('SELECT distinct categorie FROM articles');

    return $req;
}

//Récupére les articles d'une catégorie
function getArticlesShop($categorie){
    $bdd = connect();
    $req = $bdd->prepare('SELECT idArticle, nom, categorie, prix, disponible, stock 
                                FROM articles 
                                where categorie = :categorie and actif = 1');

    $req->execute(array(
        ':categorie' => htmlentities($categorie),
    ));                            
    return $req;
}

//Récupére les articles d'un tableau
function getArticlesShopByID($idArticles){
    $idArticlesStr =  htmlentities($idArticles);
    $bdd = connect();
    $req = $bdd->query('SELECT idArticle, nom, categorie, prix, disponible, stock 
                                FROM articles 
                                where idArticle in  (' . $idArticlesStr . ') ');          

    return $req;
}

//Crée une facture
function createFacture($idUtilisateur, $prixTotal){
    $bdd = connect();
    $req = $bdd->prepare('INSERT INTO factures (idUtilisateur, prixTotal) values(:idUtilisateur, :prixTotal)');

    $req->execute(array(
        ':idUtilisateur' => htmlentities($idUtilisateur),
        ':prixTotal' => htmlentities($prixTotal),
    ));        
    
    $bdd2 = connect();

    $req2 = $bdd2->query('SELECT max(idFacture) as maxIdFacture FROM factures');

    return $req2;
}

//Crée une ligne de facture
function createLigneFacture($idFacture, $idArticle, $quantite, $prixLigne){
    $bdd = connect();
    $req = $bdd->prepare('INSERT INTO lignesFacture (idFacture, idArticle, quantite, prixLigne) values(:idFacture, :idArticle, :quantite, :prixLigne)');

    $req->execute(array(
        ':idFacture' => htmlentities($idFacture),
        ':idArticle' => htmlentities($idArticle),
        ':quantite' => htmlentities($quantite),
        ':prixLigne' => htmlentities($prixLigne),
    ));    
}  

//Met à jour le stock
function majStock($idArticle, $quantite){
    $bdd = connect();

    $reqStock = $bdd->prepare('SELECT stock
                                FROM articles
                                WHERE idArticle = :idArticle');
    
    $reqStock->execute(array(
        ':idArticle' => htmlentities($idArticle),
    ));  

    $stock = $reqStock->fetch();

    $newStock = $stock['stock'] - $quantite;

    $req = $bdd->prepare('UPDATE articles 
                                set stock = :newStock
                                WHERE idArticle = :idArticle');


    $req->execute(array(
        ':newStock' => htmlentities($newStock),
        ':idArticle' => htmlentities($idArticle),
    ));    
}

//Récupére les factures d'un utilisateur
function getFacturesByIDUtilisateur($idUtilisateur){
    $bdd = connect();
    $req = $bdd->prepare('SELECT idFacture, prixTotal, DATE_FORMAT(dateCreation, \'%d/%m/%Y à %Hh%imin%ss\') AS dateFR
                                FROM factures 
                                where idUtilisateur = :idUtilisateur
                                ORDER BY dateCreation desc');

    $req->execute(array(
        ':idUtilisateur' => htmlentities($idUtilisateur),
    ));                            
    return $req;
}

//Récupére une facture sur son id
function getFacturesByIDFacture($idFacture){
    $bdd = connect();
    $req = $bdd->prepare('SELECT idUtilisateur, idFacture, prixTotal, DATE_FORMAT(dateCreation, \'%d/%m/%Y à %Hh%imin%ss\') AS dateFR
                                FROM factures 
                                where idFacture = :idFacture');

    $req->execute(array(
        ':idFacture' => htmlentities($idFacture),
    ));                            
    return $req;
}

//Récupére les détails d'une facture
function getDetailsFacture($idFacture){
    $bdd = connect();
    $req = $bdd->prepare('SELECT nom, categorie, prix, quantite, prixLigne, idFacture
                                FROM lignesFacture
                                JOIN articles on lignesFacture.idArticle = articles.idArticle
                                WHERE idFacture = :idFacture ');

    $req->execute(array(
        ':idFacture' => htmlentities($idFacture),
    ));                            
    return $req;
}

//
//Administration
//

//Récupére les logs de connexions d'un utilisateur
function getLogUserPastDays($user, $nbDays){
    $bdd = connect();
    $req = $bdd->prepare("SELECT count(*) as nbConnexions from logconnexions where DateConnexion between adddate(now(),-:nbDays) and now()  AND idUtilisateur=:id");
    $check = $req->execute(array(
        ':nbDays' => $nbDays,
        ':id' => $user,
    )) or die(print_r($req->errorInfo()));

    if ($req->rowCount() > 0) {
        $row = $req->fetch();
        return $row['nbConnexions'];
    }

    return -1;
    }

//Récupére les utilisateurs
function getusers(){
    $bdd = connect();
    $req = $bdd->query("SELECT * from utilisateurs");
    return $req;
}

//Récupére les logs du jour d'une utilisateur
function getLogUserToday($user){
    $bdd = connect();
    $req = $bdd->prepare("SELECT count(*) as nbConnexions from logconnexions where DateConnexion > CURDATE() AND idUtilisateur=:id");
    $check = $req->execute(array(
        ':id' => $user,
    )) or die(print_r($req->errorInfo()));


    if ($req->rowCount() > 0) {
        $row = $req->fetch();
        return $row['nbConnexions'];
    }

    return -1;
}

//Récupére les commentaire d'un utilisateur
function getCommentairesUser($user){
    $bdd = connect();
    echo $user;
    $req = $bdd->prepare('SELECT idNews, login, commentaire, DATE_FORMAT(commentaires.dateCreation, \'%d/%m/%Y à %Hh%imin%ss\') AS dateCom
                             FROM Commentaires
                             join Utilisateurs on Utilisateurs.idUtilisateur = Commentaires.idUtilisateur
                             where Commentaires.idUtilisateur=:idUtilisateur order by commentaires.dateCreation desc LIMIT 5');
    $req->execute(array(
        ':idUtilisateur' => htmlentities($user),
    ));

    return $req;
}

//Ajoute une news
function insertNews($user, $titre, $corps){
    $bdd = connect();
    $req = $bdd->prepare('INSERT INTO news (idUtilisateur, titre, corps) values(:idUtilisateur, :titre, :corps)');

    $req->execute(array(
        ':idUtilisateur' => htmlentities($user),
        ':titre' => htmlentities($titre),
        ':corps' => htmlentities($corps),
    ));    
} 

//Supprime un article
function deleteArticle($idArticle){
    $bdd = connect();
    echo $idArticle;
    $req = $bdd->prepare('UPDATE articles set actif=0 where idArticle=:idArticle');

    $req->execute(array(
        ':idArticle' => $idArticle,
    ));
}

//Crée un article
function insertArticle($nom, $categorie, $prix, $stock){
    $bdd = connect();
    $req = $bdd->prepare('INSERT INTO articles (nom, categorie, prix, stock) values(:nom, :categorie, :prix, :stock)');

    $req->execute(array(
        ':nom' => htmlentities($nom),
        ':categorie' => htmlentities($categorie),
        ':prix' => htmlentities($prix),
        ':stock' => htmlentities($stock),
    ));    
} 
?>