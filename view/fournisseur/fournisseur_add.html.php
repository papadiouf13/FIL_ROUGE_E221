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
    <link rel="stylesheet" href="css/stylefournisseur.css">
</head>

<body>
    <?php
    require_once(ROUTE_DIR . "view/inc/menu.inc.html.php");
    ?>
    
    <div class="container___form">
    <button class="breukh"><a href="<?=WEB_ROUTE."?controller=fournisseur&view=fournisseur_list"?>" style="color:aliceblue">Liste Fournisseur</a>
    </button>
        <form action="<?=WEB_ROUTE?>" method="post">
        <input type="hidden" name="controller" value="fournisseur">
                <?php if(!isset($fournisseurEdit) || $fournisseurEdit['idF'] == null): ?>
                    <input type="hidden" name="action" value="add">
                <?php endif; ?>
                <?php if(isset($fournisseurEdit) && $fournisseurEdit['idF'] != null): ?>
                    <input type="hidden" name="action" value="editer">
                    <input type="hidden" name="idF" value="<?= $fournisseurEdit['idF'] ?>">
                <?php endif; ?>
            <div class="title__form">
                <h1>Ajouter un fournisseur</h1>
            </div>
            <div class="form-controler">
            <h2 class="titre">Ajouter un fournisseur</h2>
                <label for="libelle" class="form-label">Nom</label>
                <input type="text" class="form-control" name="nom" id="nom" value="<?= isset($fournisseurEdit) ? $fournisseurEdit['nom'] : '' ?>">
                <span  class="erreur"><?=isset($arrayError) && isset($arrayError["nom"]) ? $arrayError["nom"] : '';?></span>
                <label for="libelle" class="form-label">Prenom</label>
                <input type="text" class="form-control" name="prenom" id="prenom" value="<?= isset($fournisseurEdit) ? $fournisseurEdit['prenom'] : '' ?>">
                <span class="erreur"><?=isset($arrayError) && isset($arrayError["prenom"]) ? $arrayError["prenom"] : '';?></span>
                <label for="libelle" class="form-label">Telephone Portable</label>
                <input type="text" class="form-control" name="telephonePort" id="telephonePort" value="<?= isset($fournisseurEdit) ? $fournisseurEdit['telephonePort'] : '' ?>">
                <span class="erreur"><?=isset($arrayError) && isset($arrayError["telephonePort"]) ? $arrayError["telephonePort"] : '';?></span>
                <label for="libelle" class="form-label">Telephone fixe</label>
                <input type="text" class="form-control" name="telephonefixe" id="telephonefixe" value="<?= isset($fournisseurEdit) ? $fournisseurEdit['telephonefixe'] : '' ?>">
                <span class="erreur"><?=isset($arrayError) && isset($arrayError["telephonefixe"]) ? $arrayError["telephonefixe"] : '';?></span>
                <label for="libelle" class="form-label">Adresse</label>
                <input type="text" class="form-control" name="adresse" id="adresse" value="<?= isset($fournisseurEdit) ? $fournisseurEdit['adresse'] : '' ?>">
                <span class="erreur"><?=isset($arrayError) && isset($arrayError["adresse"]) ? $arrayError["adresse"] : '';?></span>
                <label for="libelle" class="form-label">Photo</label>
                <input type="file" class="form-control" name="photoF" id="photoF" value="<?= isset($fournisseurEdit) ? $fournisseurEdit['photoF'] : '' ?>">
                <span class="erreur"><?=isset($arrayError) && isset($arrayError["photoF"]) ? $arrayError["photoF"] : '';?></span>

            </div>
            <div class="form-controler">
                <button type="submit" class="bouroudj">Enregistrer</button>
            </div>
        </form>
    </div>

</body>

</html>