<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIL ROUGE</title>
    <link rel="stylesheet" href="css/detail.css">
</head>

<body>
    <?php
    require_once(ROUTE_DIR . "view/inc/menu.inc.html.php");
    ?>
    <div class="redirection">
        <button class="jreukh"><a href="<?= WEB_ROUTE . "?controller=approvisionnement&view=approvisionnement_list" ?>" style="color:aliceblue">Liste Approvisionnement</a>
        </button>
    </div>
    <div class="engloge_categorie_vente">
        <div class="separation__box">
            <?php foreach ($detailproduit as $article) : ?>
                <div class="box__product">
                    <div class="img">

                        <img src="<?= WEB_ROUTE . '/images/uploads/' . $article['photoAC'] ?>" alt="">
                    </div>
                    <div class="details__product">
                        <span class="title__product"><?= $article['libelleAC'] ?></span>
                        <span class="title__product">Quantité : <?= $article['quantiteAP'] ?></span>
                        <span class="price__product">Prix Unitaire : <?= $article['prixAC'] ?> CFA</span>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>
<!-- <div class="product-image">
            <img src="images/profile.jpg.png" alt="" class="product-image">
        </div>
        <div class="product-quantity">Quantité : 1</div>
        <div class="product-price">10.000 FCFA</div> -->