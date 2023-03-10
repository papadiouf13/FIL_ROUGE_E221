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
    <link rel="stylesheet" href="css/stylearticleconfection.css">
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
                        <button class="breukh"><a href="<?= WEB_ROUTE . "?controller=articleConfectionController&view=add_article" ?>" style="color:aliceblue">Ajouter un Article</a>
                        </button>
                    </div>
                    <div class="barrederecherche">
                        <div class="rechercher">
                            <form action="<?= WEB_ROUTE ?>" method="get">
                                <input type="hidden" name="controller" value="articleConfectionController">
                                <input type="hidden" name="view" value="article_list">
                                <div class="form__controler__product">
                                    <input type="text" name="recherche" placeholder="Recherche" class="butt__product">
                                    <button class="butte__product" name="OK">OK</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="separation__box">
                    <?php foreach ($articleconfectionlist as $article) : ?>
                        <div class="box__product">
                            <div class="img">
                                <img src="<?= WEB_ROUTE . '/images/uploads/' . $article['photoAC'] ?>" alt="">
                            </div>
                            <div class="details__product">
                                <span class="title__product"><?= $article['libelleAC'] ?></span>
                                <span class="price__product"><?= $article['montantAC'] ?> CFA</span>
                            </div>
                            <div class="action__product">
                                <a href="<?= WEB_ROUTE . '?controller=articleConfectionController&view=move&idAC=' . $article['idAC'] ?>" class="edit__product">Modifier</a>
                                <a href="<?= WEB_ROUTE . '?controller=articleConfectionController&view=effacer&idAC=' . $article['idAC'] ?>" class="delete__product" onclick="confirm('Vouslez-vous vraiment supprimer ?')" class="text-white">Supprimer</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="nbrepage__product">
                <nav class="nav__pagination" aria-label="Page navigation example">
                    <ul class="justify__product">
                        <?php
                        if (isset($nbrPage)) :


                        ?>
                            <?php for ($i = 1; $i <= $nbrPage; $i++) : ?>
                                <li class="page__product"><a class="page-link" href="<?= WEB_ROUTE . '?controller=articleConfectionController&view=article_list&page=' . $i ?>">
                                        <?= $i ?></a></li>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>


</body>

</html>