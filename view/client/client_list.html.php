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
    <link rel="stylesheet" href="css/styleclient.css">
</head>

<body>
    <?php
    require_once(ROUTE_DIR . "view/inc/menu.inc.html.php");
    ?>



    <div class="container___form">



        <div class="form-controler">
            <div class="hauttableau">
                <div class="redirection">
                    <button class="breukh"><a href="<?= WEB_ROUTE . "?controller=client&view=client" ?>" style="color:aliceblue">Ajouter un client</a>
                    </button>
                </div>
                <div class="barrederecherche">
                    <div class="rechercher">
                        <form action="<?= WEB_ROUTE ?>" method="get" class="form_recherche">
                            <input type="hidden" name="controller" value="client">
                            <input type="hidden" name="view" value="client_list">
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
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Telephone</th>
                            <th>Adresse</th>
                            <th>Photo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        foreach ($clientlist as $key => $value) : ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $value["nomC"] ?></td>
                                <td><?= $value["prenomC"] ?></td>
                                <td><?= $value["telephoneC"] ?></td>
                                <td><?= $value["adresseC"] ?></td>
                                <td>
                                    <div class="imag">
                                         <img src="<?= WEB_ROUTE . '/images/client/' . $value['photoC'] ?>" alt="" class="imag">
                                    </div>
                                </td>
                                <td>
                                    <a href="<?= WEB_ROUTE . '?controller=client&view=editer&idC=' . $value['idC'] ?>" class="btn btn-secondary"><i class="fa fa-edit" style="font-size:30px;color:blue"></i></a>
                                    &nbsp;&nbsp;
                                    <a href="<?= WEB_ROUTE . '?controller=client&view=delete&idC=' . $value['idC'] ?>" onclick="confirm('Vouslez-vous vraiment supprimer ?')" class="text-white">
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
                            <li class="page__product"><a class="page-link" href="<?= WEB_ROUTE . '?controller=client&view=client_list&page=' . $i ?>">
                                    <?= $i ?></a></li>
                        <?php endfor; ?>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>

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
    .nbrepage{
        width: 50%;
        margin-left: 100%;
    }
</style> -->