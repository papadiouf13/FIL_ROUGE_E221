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
    <link rel="stylesheet" href="css/styleproductionvente.css">
</head>

<body>
    <?php
    require_once(ROUTE_DIR . "view/inc/menu.inc.html.php");
    ?>
  
    <div class="container__former">
    </button>
<a href="<?=WEB_ROUTE."?controller=productionventeController&view=article_list"?>" class="preukh">Liste article vente</a>
    </button>
        <form action="<?= WEB_ROUTE ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="controller" value="productionventeController">
            <?php if (!isset($productionventeEdit) || $productionventeEdit['idPAV'] == null) : ?>
                <input type="hidden" name="action" value="add">
            <?php endif; ?>
            <?php if (isset($productionventeEdit) && $productionventeEdit['idPAV'] != null) : ?>
                <input type="hidden" name="action" value="move">
                <input type="hidden" name="idPAV" value="<?= $productionventeEdit['idPAV'] ?>">
            <?php endif; ?>
           
            <div class="former-controler">
            <h2 class="titre">Ajouter un article de vente</h2>
                <label for="libelle" class="form-label">Date</label>
                <input type="date" class="form-control" name="datePAV" id="datePAV" value="<?= isset($productionventeEdit) ? $productionventeEdit['datePAV'] : '' ?>">
                <span class="erreur"><?= isset($arrayError) && isset($arrayError["datePAV"]) ? $arrayError["datePAV"] : ''; ?></span>
                <label for="libelle" class="form-label">Observation</label>
                <input type="text" class="form-control" name="observationPAV" id="observation" value="<?= isset($productionventeEdit) ? $productionventeEdit['observationPAV'] : '' ?>">
                <span class="erreur"><?= isset($arrayError) && isset($arrayError["observationPAV"]) ? $arrayError["observationPAV"] : ''; ?></span>
                <label for="libelle" class="form-label">Quantite</label>
                <input type="text" class="form-control" name="quantitePAV" id="quantite" value="<?= isset($productionventeEdit) ? $productionventeEdit['quantitePAV'] : '' ?>">
                <span class="erreur"><?= isset($arrayError) && isset($arrayError["quantitePAV"]) ? $arrayError["quantitePAV"] : ''; ?></span>
                
                <label for="libelle" class="form-label">Article Vente</label>
                <select name="idAV" id="categorie" class="form-control">
                    <option value="0">Selectionnez une categorie</option>
                    <?php foreach ($categorieproductionvente as $categorie) : ?>
                    <?php if (isset($productionventeEdit)&&$categorie["idAV"] == $productionventeEdit['idAV']): ?>
                        <option value="<?= $categorie['idAV'] ?>" selected><?= $categorie['libelleAV'] ?></option>
                    <?php endif ?>
                    <?php if (!isset($productionventeEdit) || $categorie["idAV"] != $productionventeEdit['idAV']): ?>
                        <option value="<?= $categorie['idAV'] ?>"><?= $categorie['libelleAV'] ?></option>
                    <?php endif ?>
                        
                        
                    <?php endforeach; ?>
                </select>
                <!-- <label for="libelle" class="form-label">Photo</label>
                <input type="file" class="form-control" name="photoAV" id="photo" value="<?= isset($productionventeEdit) ? $productionventeEdit['photoAV'] : '' ?>">
                <div>
                <img src="<?= WEB_ROUTE . '/images/uploads/' . $productionventeEdit['photoAV'] ?>" alt="" class="update_image">
                </div>
                <span class="erreur"><?= isset($arrayError) && isset($arrayError["photoAV"]) ? $arrayError["photoAV"] : ''; ?></span>
                 -->
            </div>
            <div class="former-controler">
                <button type="submit">Enregistrer</button>
            </div>
        </form>
    </div>

</body>

</html>
