<?php
$arrayError = [];

if (isset($_SESSION["error"])) {
    $arrayError = $_SESSION["error"];
    unset($_SESSION["error"]);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FILE ROUGE</title>
    <link rel="stylesheet" href="css/stylearticlevente.css">
</head>

<body>
    <?php
    require_once(ROUTE_DIR . "view/inc/menu.inc.html.php");
    ?>


    <div class="container__form__generic_product">
        <div class="row_product">

            <div class="element__content">
                <div class="hauttableau">
                    <div class="redirection">
                        <button class="preukh"><a href="<?= WEB_ROUTE . "?controller=articleVenteController&view=add_article" ?>" style="color:aliceblue">Ajouter un Article de vente</a>
                        </button>
                    </div>
                    <div class="barrederecherche">
                        <div class="rechercher">
                            <form action="<?= WEB_ROUTE ?>" method="get">
                                <input type="hidden" name="controller" value="articleVenteController">
                                <input type="hidden" name="view" value="article_list">
                                <div class="form__controler__product">
                                    <input type="text" name="recherche" placeholder="Recherche" class="butt__product">
                                    <button class="butte__product" name="OK">OK</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="engloge_categorie_vente">
                    <div class="separation__box">

                        <?php foreach ($articleventelist as $article) : ?>
                            <div class="box__product">
                                <div class="img">
                                    
                                    <img src="<?= WEB_ROUTE . '/images/uploads/' . $article['photoAV'] ?>" alt="">
                                </div>
                                <div class="details__product">
                                    <span class="title__product"><?= $article['libelleAV'] ?></span>
                                    <span class="price__product"><?= $article['montantAV'] ?> CFA</span>
                                </div>
                                <div class="action__product">
                                    <a href="<?= WEB_ROUTE . '?controller=articleVenteController&view=move&idAV=' . $article['idAV'] ?>" class="edit__product">Modifier</a>
                                    <a href="<?= WEB_ROUTE . '?controller=articleVenteController&view=effacer&idAV=' . $article['idAV'] ?>" class="delete__product" onclick="confirm('Vouslez-vous vraiment supprimer ?')" class="text-white">Supprimer</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="nbrepage__product">
                <nav class="nav__pagination" aria-label="Page navigation example">
                    <ul class="justify__product">
                        <?php
                        if (isset($nbrPage)) :


                        ?>
                            <?php for ($i = 1; $i <= $nbrPage; $i++) : ?>
                                <li class="page__product"><a class="page-link" href="<?= WEB_ROUTE . '?controller=articleVenteController&view=article_list&page=' . $i ?>">
                                        <?= $i ?></a></li>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!--         PARTIE DE LE PAGINATION-->


</body>

</html>
<!-- <style>
    .page {
        background-color: black;
        width: 15%;
        height: 4%;
        display: inline-block;

    }

    .page-link {
        display: flex;
        justify-content: center;
        justify-content: center;
        font-size: 30px;
        text-decoration: none;
        color: white;
    }

    .justify {
        display: flex;
        justify-content: space-around;
    }

    .nbrepage {
        width: 50%;
        margin-left: 100%;
    }
</style> -->