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
    
    <div class="container__f">
    <button class="mreukh"><a href="<?=WEB_ROUTE."?controller=catventeController&view=categorievente_list"?>" style="color:aliceblue">Liste Categorie Vente</a>
    </button>
        <form action="<?=WEB_ROUTE?>" method="post">
        <input type="hidden" name="controller" value="catventeController">
                <?php if(!isset($categorieconfectionventeEdit) || $categorieconfectionventeEdit['idCAV'] == null): ?>
                    <input type="hidden" name="action" value="add">
                <?php endif; ?>
                <?php if(isset($categorieconfectionventeEdit) && $categorieconfectionventeEdit['idCAV'] != null): ?>
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="idCAV" value="<?= $categorieconfectionventeEdit['idCAV'] ?>">
                <?php endif; ?>
            
            <div class="f-controler">
                <label for="libelle" class="form-label">Categorie Vente</label>
                <?php 
                    /* echo '<pre>';
                    var_dump($categorieconfectionEdit);die;
                    echo '</pre>'; */

                
                ?>
                <input type="text" class="form-control" name="libelleCAV" id="libelleCAV" value="<?= isset($categorieconfectionventeEdit) ? $categorieconfectionventeEdit['libelleCAV'] : '' ?>">
                <span class="erreur"><?=isset($arrayError) && isset($arrayError["libelleCAV"]) ? $arrayError["libelleCAV"] : '';?></span>
            </div>
            <div class="f-controler">
                <button type="submit">Enregistrer</button>
            </div>
        </form>
    </div>

</body>

</html>