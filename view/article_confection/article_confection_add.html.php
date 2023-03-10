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
    <link rel="stylesheet" href="css/stylearticleconfection.css">
</head>

<body>
    <?php
    require_once(ROUTE_DIR . "view/inc/menu.inc.html.php");
    ?>
    <div class="cont_form">
    <button class="preukh"><a href="<?=WEB_ROUTE."?controller=articleConfectionController&view=article_list"?>" style="color:aliceblue">Liste des articles</a>
    </button>
        <form action="<?= WEB_ROUTE ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="controller" value="articleConfectionController">
            <?php if (!isset($articleconfectionEdit) || $articleconfectionEdit['idAC'] == null) : ?>
                <input type="hidden" name="action" value="add">
            <?php endif; ?>
            <?php if (isset($articleconfectionEdit) && $articleconfectionEdit['idAC'] != null) : ?>
                <input type="hidden" name="action" value="move">
                <input type="hidden" name="idAC" value="<?= $articleconfectionEdit['idAC'] ?>">
            <?php endif; ?>
           
            <div class="forme-controler">
                <h2 class="titre">Ajouter un article</h2>
                <label for="libelle" class="form-label">Libelle</label>
                <input type="text" class="form-control" name="libelleAC" id="libelle" value="<?= isset($articleconfectionEdit) ? $articleconfectionEdit['libelleAC'] : '' ?>">
                <span class="erreur"><?= isset($arrayError) && isset($arrayError["libelleAC"]) ? $arrayError["libelleAC"] : ''; ?></span>
                <label for="libelle" class="form-label">Prix</label>
                <input type="text" class="form-control" name="prixAC" id="prix" value="<?= isset($articleconfectionEdit) ? $articleconfectionEdit['prixAC'] : '' ?>">
                <span class="erreur"><?= isset($arrayError) && isset($arrayError["prixAC"]) ? $arrayError["prixAC"] : ''; ?></span>
                <label for="libelle" class="form-label">Quantite</label>
                <input type="text" class="form-control" name="quantiteAC" id="quantite" value="<?= isset($articleconfectionEdit) ? $articleconfectionEdit['quantiteAC'] : '' ?>">
                <span class="erreur"><?= isset($arrayError) && isset($arrayError["quantiteAC"]) ? $arrayError["quantiteAC"] : ''; ?></span>
                <label for="libelle" class="form-label">Categorie</label>
                <select name="categorieAC" id="categorie" class="form-control">
                    <option value=" <?php ($articleconfectionEdit['idCC'])?> ">Selectionnez une categorie</option>
                    <?php foreach ($categories as $categorie) : ?>
                        <option value="<?= $categorie['idCC'] ?>"><?= $categorie['libelleCC'] ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="libelle" class="form-label">Photo</label>
                <input type="file" class="form-control" name="photoAC" id="photo" value="<?= isset($articleconfectionEdit) ? $articleconfectionEdit['photoAC'] : '' ?>">
                <div>
                <img src="<?= WEB_ROUTE . '/images/uploads/' . $articleconfectionEdit['photoAC'] ?>" alt="" class="update_image">
                </div>
                <span class="erreur"><?= isset($arrayError) && isset($arrayError["photoAC"]) ? $arrayError["photoAC"] : ''; ?></span>
                
                
            </div>
            <div class="forme-controler">
                <button type="submit">Enregistrer</button>
            </div>
        </form>
    </div>

</body>

</html>
