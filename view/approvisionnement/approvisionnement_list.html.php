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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/styleapprovisionnement.css">
</head>

<body>
    <?php
    require_once(ROUTE_DIR . "view/inc/menu.inc.html.php");
    ?>

    <div class="container__form">


        <div class="form-controler">

            <div class="hauttableau">
                <div class="redirection">
                    <button class="breukh"><a href="<?= WEB_ROUTE . "?controller=approvisionnement&view=approvisionnement" ?>" style="color:aliceblue">Ajouter Approvisionnement</a>
                    </button>
                </div>
                <div class="barrederecherche">
                    <div class="rechercher">
                        <form action="<?= WEB_ROUTE ?>" method="get" class="form_recherche">
                            <input type="hidden" name="controller" value="approvisionnement">
                            <input type="hidden" name="view" value="approvisionnement_list">
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
                        <th>Montant</th>
                        <th>idF</th>
                        <th>Date</th>
                        <th>Details</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($approvisionnementlist as $key => $value) : ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $value["montantAP"] ?></td>
                            <td><?= $value["idF"] ?></td>
                            <td><?= $value["dateAP"] ?></td>
                            <td><button><a href="<?= WEB_ROUTE . "?controller=approvisionnement&view=detail&idAPP=".$value['idAPP'] ?>">DETAIL</a></button></td>
                            <td>
                                <a href="<?= WEB_ROUTE . '?controller=approvisionnement&view=editer&idAPP=' . $value['idAPP'] ?>" class="btn btn-secondary"><i class="fa fa-edit" style="font-size:25px;color:blue"></i></a>
                                &nbsp;&nbsp;
                                <a href="<?= WEB_ROUTE . '?controller=approvisionnement&view=supprimer&idAPP=' . $value['idAPP'] ?>" onclick="confirm('Vouslez-vous vraiment supprimer ?')" class="text-white">
                                    <i class="fa fa-trash" style="font-size:25px;color:red"></i></a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="nbrepage__product">
                <nav class="nav__pagination" aria-label="Page navigation example">
                    <ul class="justify__product">
                        <?php
                        if (isset($nbrPage)) :


                        ?>
                            <?php for ($i = 1; $i <= $nbrPage; $i++) : ?>
                                <li class="page__product"><a class="page-link" href="<?= WEB_ROUTE . '?controller=approvisionnement&view=approvisionnement_list&page=' . $i ?>">
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