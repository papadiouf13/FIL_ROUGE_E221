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
    <link rel="stylesheet" href="css/stylefournisseur.css">
</head>

<body>
    <?php
    require_once(ROUTE_DIR . "view/inc/menu.inc.html.php");
    ?>

<div class="container___form">



<div class="form-controler">
    <div class="hauttableau">
        <div class="redirection">
            <button class="breukh"><a href="<?= WEB_ROUTE . "?controller=productionventeController&view=add_article" ?>" style="color:aliceblue">Ajouter une Production</a>
            </button>
        </div>
        <div class="barrederecherche">
            <div class="rechercher">
                <form action="<?= WEB_ROUTE ?>" method="get" class="form_recherche">
                    <input type="hidden" name="controller" value="productionventeController">
                    <input type="hidden" name="view" value="article_list">
                    <label for="" style="font-size: 1.2em; font-weight: bold;">Recherche</label>
                    <input type="text" name="recherche" class="butt">
                    <button class="butte" name="OK">OK</button>
                </form>
            </div>
        </div>
    </div>
    <div class="responsivetableau">
        <table class="tableau-style">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>idAV</th>
                    <th>Quantite</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                foreach ($productionventelist as $key => $value) : ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $value["datePAV"] ?></td>
                        <td><?= $value["idAV"] ?></td>
                        <td><?= $value["quantitePAV"] ?></td>
                        
                        <td>
                            <a href="<?= WEB_ROUTE . '?controller=productionventeController&view=move&idPAV=' . $value['idPAV'] ?>" class="btn btn-secondary"><i class="fa fa-edit" style="font-size:30px;color:blue"></i></a>
                            &nbsp;&nbsp;
                            <a href="<?= WEB_ROUTE . '?controller=productionventeController&view=effacer&idPAV=' . $value['idPAV'] ?>" onclick="confirm('Vouslez-vous vraiment supprimer ?')" class="text-white">
                                <i class="fa fa-trash" style="font-size:30px;color:red"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>
<div class="nbrepage__product">
    <nav class="nav__pagination" aria-label="Page navigation example">
        <ul class="justify__product">
            <?php
            if (isset($nbrPage)) :


            ?>
                <?php for ($i = 1; $i <= $nbrPage; $i++) : ?>
                    <li class="page__product"><a class="page-link" href="<?= WEB_ROUTE . '?controller=productionventeController&view=article_list&page=' . $i ?>">
                            <?= $i ?></a></li>
                <?php endfor; ?>
            <?php endif; ?>
        </ul>
    </nav>
</div>
</div>


</body>
</html>