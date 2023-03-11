<?php
$arrayError = [];

if (isset($_SESSION["arrayError"])) {
    $arrayError = $_SESSION["arrayError"];
    unset($_SESSION["arrayError"]);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FILE ROUGE</title>
    <link rel="stylesheet" href="css/styleclient.css">
</head>

<body>
    <?php
    require_once(ROUTE_DIR . "view/inc/menu.inc.html.php");
    ?>
    
    <div class="container___form">
    <button class="breukh"><a href="<?=WEB_ROUTE."?controller=client&view=client_list"?>" style="color:aliceblue">Liste client</a>
    </button>
    <form action="<?= WEB_ROUTE ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="controller" value="client">
                <?php if(!isset($clientEdit) || $clientEdit['idC'] == null): ?>
                    <input type="hidden" name="action" value="add">
                <?php endif; ?>
                <?php if(isset($clientEdit) && $clientEdit['idC'] != null): ?>
                    <input type="hidden" name="action" value="editer">
                    <input type="hidden" name="idC" value="<?= $clientEdit['idC'] ?>">
                <?php endif; ?>
            <div class="title__form">
                <h1>Ajouter un client</h1>
            </div>
            <div class="form-controler">
            <h2 class="titre">Ajouter un client</h2>
                <label for="libelle" class="form-label">Nom</label>
                <input type="text" class="form-control" name="nomC" id="nomC" value="<?= isset($clientEdit) ? $clientEdit['nomC'] : '' ?>">
                <span  class="erreur"><?=isset($arrayError) && isset($arrayError["nomC"]) ? $arrayError["nomC"] : '';?></span>
                <label for="libelle" class="form-label">Prenom</label>
                <input type="text" class="form-control" name="prenomC" id="prenomC" value="<?= isset($clientEdit) ? $clientEdit['prenomC'] : '' ?>">
                <span class="erreur"><?=isset($arrayError) && isset($arrayError["prenomC"]) ? $arrayError["prenomC"] : '';?></span>
                <label for="libelle" class="form-label">Telephone Portable</label>
                <input type="text" class="form-control" name="telephoneC" id="telephoneC" value="<?= isset($clientEdit) ? $clientEdit['telephoneC'] : '' ?>">
                <span class="erreur"><?=isset($arrayError) && isset($arrayError["telephoneC"]) ? $arrayError["telephoneC"] : '';?></span>
                <label for="libelle" class="form-label">Adresse</label>
                <input type="text" class="form-control" name="adresseC" id="adresseC" value="<?= isset($clientEdit) ? $clientEdit['adresseC'] : '' ?>">
                <span class="erreur"><?=isset($arrayError) && isset($arrayError["adresseC"]) ? $arrayError["adresseC"] : '';?></span>
                <label for="libelle" class="form-label">Photo</label>
                <input type="file" class="form-control" name="photoC" id="photoC" value="<?= isset($clientEdit) ? $clientEdit['photoC'] : '' ?>">
                <div>
                <img src="<?= WEB_ROUTE . '/images/uploads/' . $clientEdit['photoC'] ?>" alt="" class="update_image">
                </div>
                <!-- <label for="libelle" class="form-label">Photo</label>
                <input type="file" class="form-control" name="photoC" id="photoC" value="<?= isset($clientEdit) ? $clientEdit['photoC'] : '' ?>">
                <span class="erreur"><?=isset($arrayError) && isset($arrayError["photoC"]) ? $arrayError["photoC"] : '';?></span> -->

            </div>
            <div class="form-controler">
                <button type="submit" class="bouroudj">Enregistrer</button>
            </div>
        </form>
    </div>

</body>

</html>