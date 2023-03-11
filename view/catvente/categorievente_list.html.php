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
    <link rel="stylesheet" href="css/stylecategorievente.css">
</head>

<body>
    <?php
    require_once(ROUTE_DIR . "view/inc/menu.inc.html.php");
    ?>
    <div class=".container__f">
        <!-- <button class="breukh"><a href="<?= WEB_ROUTE . "?controller=catventeController&view=categorievente" ?>"style="color:aliceblue">Ajouter categorie</a>
        </button> -->


            <div class=".f-controler">
            <div class="hauttableau">
                <div class="redirection">
                    <button class="breukh"><a href="<?= WEB_ROUTE . "?controller=catventeController&view=categorievente" ?>" style="color:aliceblue">Ajouter une Categorie Vente</a>
                    </button>
                </div>
                <div class="barrederecherche">
                    <div class="rechercher">
                        <form action="<?= WEB_ROUTE ?>" method="get" class="form_recherche">
                            <input type="hidden" name="controller" value="catventeController">
                            <input type="hidden" name="view" value="categorievente_list">
                            <label for="" style="font-size: 1.2em; font-weight: bold;">Recherche</label>
                            <input type="text" name="recherche" class="butt">
                            <button class="butte" name="OK">OK</button>
                        </form>
                    </div>
                </div>
            </div>
                <table class="tableau-style">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Categorie Article</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categorieventelist as $key => $value): ?>
                        <tr>
                            <td><?= $key+1 ?></td>
                            <td><?= $value["libelleCAV"] ?></td>
                            <td>
                                <a href="<?=WEB_ROUTE.'?controller=catventeController&view=edit&idCAV='.$value['idCAV']?>" 
                                class="btn btn-secondary">Modifier</a>
                                &nbsp;&nbsp;
                                <a href="<?=WEB_ROUTE.'?controller=catventeController&view=delet&idCAV='.$value['idCAV']?>" 
                                onclick="confirm('Vouslez-vous vraiment supprimer ?')"
                                 class="text-white" >Supprimer</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="nbrepage__product">
            <nav class="nav__pagination" aria-label="Page navigation example">
                <ul class="justify__product">
                    <?php
                    if (isset($nbrPage)) :


                    ?>
                        <?php for ($i = 1; $i <= $nbrPage; $i++) : ?>
                            <li class="page__product"><a class="page-link" href="<?= WEB_ROUTE . '?controller=catventeController&view=categorievente_list&page=' . $i ?>">
                                    <?= $i ?></a></li>
                        <?php endfor; ?>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>

</body>

</html>