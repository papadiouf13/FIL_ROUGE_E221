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
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    require_once(ROUTE_DIR . "view/inc/menu.inc.html.php");
    ?>
   
    <div class="container__form">
    <button class="breukh"><a href="<?= WEB_ROUTE . "?controller=categorieController&view=categorie_list" ?>"style="color:aliceblue">Liste categories</a>
    </button>
        
            
            <div class="form-controler">
                <div class="responsivetableau">
                <table class="tableau-style">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Categorie</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categorieconfectionlist as $key => $value): ?>
                        <tr>
                            <td class="ttd"><?= $key+1 ?></td>
                            <td><?= $value["libelleCC"] ?></td>
                            <td>
                                <a href="<?=WEB_ROUTE.'?controller=categorieController&view=edit&idCC='.$value['idCC']?>" 
                                class="btn btn-secondary">Modifier</a>
                                &nbsp;&nbsp;
                                <a href="<?=WEB_ROUTE.'?controller=categorieController&view=delet&idCC='.$value['idCC']?>" 
                                onclick="confirm('Vouslez-vous vraiment supprimer ?')"
                                 class="text-white" >Supprimer</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                </div>
            </div>
       
    </div>

</body>

</html>