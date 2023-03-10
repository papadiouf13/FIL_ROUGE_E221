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
    <link rel="stylesheet" href="css/stylearticlevente.css">
</head>

<body>
    <?php
    require_once(ROUTE_DIR . "view/inc/menu.inc.html.php");
    ?>
  
    <div class="container__former">
    </button>
<a href="<?=WEB_ROUTE."?controller=articleVenteController&view=article_list"?>" class="preukh">Liste article vente</a>
    </button>
        <form action="<?= WEB_ROUTE ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="controller" value="articleVenteController">
            <?php if (!isset($articleventeEdit) || $articleventeEdit['idAV'] == null) : ?>
                <input type="hidden" name="action" value="add">
            <?php endif; ?>
            <?php if (isset($articleventeEdit) && $articleventeEdit['idAV'] != null) : ?>
                <input type="hidden" name="action" value="move">
                <input type="hidden" name="idAV" value="<?= $articleventeEdit['idAV'] ?>">
            <?php endif; ?>
           
            <div class="former-controler">
            <h2 class="titre">Ajouter un article de vente</h2>
                <label for="libelle" class="form-label">Libelle</label>
                <input type="text" class="form-control" name="libelleAV" id="libelle" value="<?= isset($articleventeEdit) ? $articleventeEdit['libelleAV'] : '' ?>">
                <span class="erreur"><?= isset($arrayError) && isset($arrayError["libelleAV"]) ? $arrayError["libelleAV"] : ''; ?></span>
                <label for="libelle" class="form-label">Prix</label>
                <input type="text" class="form-control" name="prixAV" id="prix" value="<?= isset($articleventeEdit) ? $articleventeEdit['prixAV'] : '' ?>">
                <span class="erreur"><?= isset($arrayError) && isset($arrayError["prixAV"]) ? $arrayError["prixAV"] : ''; ?></span>
                <label for="libelle" class="form-label">Quantite</label>
                <input type="text" class="form-control" name="quantiteAV" id="quantite" value="<?= isset($articleventeEdit) ? $articleventeEdit['quantiteAV'] : '' ?>">
                <span class="erreur"><?= isset($arrayError) && isset($arrayError["quantiteAV"]) ? $arrayError["quantiteAV"] : ''; ?></span>
                
                <label for="libelle" class="form-label">Categorie</label>
                <select name="categorieCAV" id="categorie" class="form-control">
                    <option value="0">Selectionnez une categorie</option>
                    <?php foreach ($categoriearticlevente as $categorie) : ?>
                    <?php if (isset($articleventeEdit)&&$categorie["idCAV"] == $articleventeEdit['idCAV']): ?>
                        <option value="<?= $categorie['idCAV'] ?>" selected><?= $categorie['libelleCAV'] ?></option>
                    <?php endif ?>
                    <?php if (!isset($articleventeEdit) || $categorie["idCAV"] != $articleventeEdit['idCAV']): ?>
                        <option value="<?= $categorie['idCAV'] ?>"><?= $categorie['libelleCAV'] ?></option>
                    <?php endif ?>
                        
                        
                    <?php endforeach; ?>
                </select>
                <label for="libelle" class="form-label">Photo</label>
                <input type="file" class="form-control" name="photoAV" id="photo" value="<?= isset($articleventeEdit) ? $articleventeEdit['photoAV'] : '' ?>">
                <div>
                <img src="<?= WEB_ROUTE . '/images/uploads/' . $articleventeEdit['photoAV'] ?>" alt="" class="update_image">
                </div>
                <span class="erreur"><?= isset($arrayError) && isset($arrayError["photoAV"]) ? $arrayError["photoAV"] : ''; ?></span>
                
            </div>
            <div class="former-controler">
                <button type="submit">Enregistrer</button>
            </div>
        </form>
    </div>

</body>

</html>
