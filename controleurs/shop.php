<?php 

    //Affiche le shop
    function shop(){
        
        $categories = getCategoriesArticles();

        if(isset($_POST['categorie'])){
            $articles = getArticlesShop($_POST['categorie']);
        }

        if(isset($_SESSION['panier'])) {
            $idArticles = implode(", ", array_keys($_SESSION['panier']));
            $articlesShop = getArticlesShopByID($idArticles);
        }

        require "vues/shop.php";
    }

    //Ajoute/modifie un article au panier
    function panier(){

        if(isset($_POST['idArticle'], $_POST['nbArticles']) and $_POST['nbArticles'] <= 10 ){

            $articles = getArticlesShopByID($_POST['idArticle']);
            $article = $articles->fetch();

            if($_POST['nbArticles'] <= $article['stock']){
                $id = $_POST['idArticle'];

                if($_POST['nbArticles'] > 0){
                    $_SESSION['panier']["$id"] = $_POST['nbArticles'];

                }else if(isset($_SESSION['panier'])){
                    unset($_SESSION['panier']["$id"]);

                    if(count($_SESSION['panier']) < 1 ){
                        unset($_SESSION['panier']);
                    }
                }
            }
        }
    }

    //Affiche les facture
    function factures(){
        if(isset($_SESSION['idUtilisateur']))
            $factures = getFacturesByIDUtilisateur($_SESSION['idUtilisateur']);

        require "vues/factures.php";
    }

    //Facture le panier
    function facturer(){
        if(isset($_SESSION['panier'], $_SESSION['total'])){
            $idArticles = implode(", ", array_keys($_SESSION['panier']));
            $articlesShop = getArticlesShopByID($idArticles);

            $idFacture = createFacture($_SESSION['idUtilisateur'], $_SESSION['total']);
            $idFacture = $idFacture->fetch();

            echo $idFacture['maxIdFacture'];
            while($articleShop = $articlesShop->fetch()){
                $prixLigne = $articleShop['prix'] * $_SESSION['panier'][$articleShop['idArticle']];
                createLigneFacture($idFacture['maxIdFacture'], $articleShop['idArticle'], $_SESSION['panier'][$articleShop['idArticle']], $prixLigne);
                majStock($articleShop['idArticle'], $_SESSION['panier'][$articleShop['idArticle']]);
            }
            unset($_SESSION['panier']);
            unset($_SESSION['total']);
        }
    }

    //Affiche les détails d'une facture
    function detailsFacture(){
        if(isset($_POST['idFacture'], $_SESSION['login'])){
            $facturetmp = getFacturesByIDFacture($_POST['idFacture']);
            $facture = $facturetmp->fetch();

            if($_SESSION['idUtilisateur'] = $facture['idUtilisateur']){
                $detailsFacture = getDetailsFacture($_POST['idFacture']);
            }
            
        }

        require "vues/detailsFacture.php";
    }

?>