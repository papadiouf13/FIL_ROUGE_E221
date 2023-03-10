<?php
$arrayError = [];

if (isset($_SESSION["error"])) {
    $arrayError = $_SESSION["error"];
    unset($_SESSION["error"]);
}

if (isset($_SESSION["val_temp"])) {
    $valtemp = $_SESSION["val_temp"];
    unset($_SESSION["val_temp"]);
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
    <button class="breukh"><a href="<?=WEB_ROUTE."?controller=categorieController&view=categorie_list"?>" style="color:aliceblue">Liste Categorie</a>
    </button>
        <form action="<?=WEB_ROUTE?>" method="post">
        <input type="hidden" name="controller" value="categorieController">
                <?php if(!isset($categorieconfectionEdit) || $categorieconfectionEdit['idCC'] == null): ?>
                    <input type="hidden" name="action" value="add">
                <?php endif; ?>
                <?php if(isset($categorieconfectionEdit) && $categorieconfectionEdit['idCC'] != null): ?>
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="idCC" value="<?= $categorieconfectionEdit['idCC'] ?>">
                <?php endif; ?>
            <div class="title__form">
                <h1>Ajouter une Categorie</h1>
            </div>
            <div class="form-controler">
            <h2 class="titre">Ajouter une categorie</h2>
                <label for="libelle" class="form-label">Categorie</label>
                <input type="text" class="form-control" name="libelleCC" id="libelleCC" value="<?= isset($categorieconfectionEdit) ? $categorieconfectionEdit['libelleCC'] : '' ?>">
                <span class="erreur"><?=isset($arrayError) && isset($arrayError["libelleCC"]) ? $arrayError["libelleCC"] : '';?></span>
            </div>
            <div class="form-controler">
                <button type="submit">Enregistrer</button>
            </div>
        </form>
    </div>

</body>

</html>