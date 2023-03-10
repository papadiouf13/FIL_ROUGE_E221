<?php

$arrayError = [];
$arraySelection = [];
//$arrayProduit = [];

if (isset($_SESSION["error"])) {
    $arrayError = $_SESSION["error"];
    unset($_SESSION["error"]);
}
if (isset($_SESSION['selection'])) {
    $arraySelection = $_SESSION["selection"];
   
    /* unset($_SESSION['selection']['categorieAC']);
    unset($_SESSION['typecategorieconfection']);
    unset($_SESSION['prixAP']);
    unset($_SESSION['quantiteAP']); */
}
if (isset($_SESSION['articleconfection'])) {
    $arrayArticleconfection = $_SESSION["articleconfection"];
    unset($_SESSION["articleconfection"]);
}
/* if (isset($_SESSION['produit'])) {
    $arrayProduit = $_SESSION["produit"];
    unset($_SESSION["produit"]);
    
} */

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FILE ROUGE</title>
    <link rel="stylesheet" href="css/styleapprovisionnement.css">
</head>

<body>
    <?php
    require_once(ROUTE_DIR . "view/inc/menu.inc.html.php");
    ?>
    <div class="redirection">
        <button class="jreukh"><a href="<?= WEB_ROUTE . "?controller=approvisionnement&view=approvisionnement_list" ?>" style="color:aliceblue">Liste Approvisionnement</a>
        </button>
    </div>
    <form action="<?= WEB_ROUTE ?>" method="post">
        <input type="hidden" name="controller" value="approvisionnement">
        <?php if (!isset($approvisionnementEdit) || $approvisionnementEdit['idAPP'] == null) : ?>
            <input type="hidden" name="action" value="add">
        <?php endif; ?>
        <?php if (isset($approvisionnementEdit) && $approvisionnementEdit['idAPP'] != null) : ?>
            <input type="hidden" name="action" value="editer">
            <input type="hidden" name="idAPP" value="<?= $approvisionnementEdit['idAPP'] ?>">
        <?php endif; ?>
        <div class="container__form">
            <div class="formulaire">


                <div class="ligne1">
                    <div class="inputs">
                        <label for="">Date</label>
                        <input type="date" name="dateAP" value="<?= isset($arraySelection['dateAP']) ? $arraySelection['dateAP'] : "" ?>">
                    </div>
                    <div class="inputs">
                        <label for="">Fournisseur</label>
                        <select name="idF" id="idF" class="form-control">
                            <option value="0">Selectionnez un fournisseur</option>
                            <?php foreach ($fournisseurlist as $fourni) : ?>
                                <?php if (isset($arraySelection) && isset($arraySelection["idF"]) && $arraySelection["idF"] == $fourni["idF"]) : ?>
                                    <option value="<?= $fourni['idF'] ?>" selected><?= $fourni['prenom'] . " " . $fourni['nom'] ?></option>
                                <?php endif; ?>
                                <?php if (!isset($arraySelection) || !isset($arraySelection["idF"]) || $arraySelection["idF"] != $fourni["idF"]) : ?>
                                    <option value="<?= $fourni['idF'] ?>"><?= $fourni['prenom'] . " "  . $fourni['nom'] ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="a">
                    <label for="">Categorie</label>
                    <select name="categorieAC" id="categorie" class="form-control">
                        <option value="0">Selectionnez une categorie</option>
                        <?php foreach ($categories as $categorie) : ?>
                            <?php if (isset($arraySelection) && isset($arraySelection["categorieAC"]) && $arraySelection["categorieAC"] == $categorie["idCC"]) : ?>
                                <option value="<?= $categorie['idCC'] ?>" selected><?= $categorie['libelleCC'] ?></option>
                            <?php endif; ?>
                            <?php if (!isset($arraySelection) || !isset($arraySelection["categorieAC"]) || $arraySelection["categorieAC"] != $categorie["idCC"]) : ?>
                                <option value="<?= $categorie['idCC'] ?>"><?= $categorie['libelleCC'] ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                    <button name="OK" value="OK">OK</button>
                </div>
                <div class="b">
                    <div class="for">
                        <label for="">Produit</label>
                        <select name="produitAP" id="produit" class="form-control">
                        <option value="0">Selectionnez un produit</option>
                        <?php foreach ($arraySelection['typecategorieconfection'] as $raw) : ?>
                            <?php if (isset($arrayArticleconfection) && isset($arrayArticleconfection["libelleAC"]) && $arrayArticleconfection["idAC"] == $raw['idAC']) : ?>
                                <option value="<?= $raw['idAC'] ?>" selected><?= $raw['libelleAC'] ?></option>
                            <?php endif; ?>
                            <?php if (!isset($arrayArticleconfection) || !isset($arrayArticleconfection["libelleAC"]) || $arrayArticleconfection["idAC"] != $raw['idAC']) : ?>
                                <option value="<?= $raw['idAC'] ?>"><?= $raw['libelleAC'] ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                        
                    </div>
                    <div class="boutonprix">
                    <button name="val" value="val">val</button>
                    </div>
                    <div class="for">
                        <label for="">Prix</label>
                        <input type="text" name="prixAP" value="<?= isset($arrayArticleconfection) && isset($arrayArticleconfection["prixAC"]) ? $arrayArticleconfection["prixAC"] : 0 ?>">
                    </div>
                    <div class="for">
                        <label for="">Quantite</label>
                        <input type="text" name="quantiteAP">
                        <span  class="erreur"><?=isset($arrayError) && isset($arrayError["quantiteAP"]) ? $arrayError["quantiteAP"] : '';?></span>
                    </div>
                    <!-- <button name="AJOUTER" value="AJOUTER">AJOUTER</button> -->
                    <input type="submit" name="save" value="ajouter" class="btn-ajouter">

                </div>

            </div>
            <div class="tableau">
                <table class="tableau-style">
                    <thead>
                        <tr>
                            <th>Produits</th>
                            <th>Prix</th>
                            <th>Quantite</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if (isset($_SESSION["array"])) :
                        ?>
                            <?php
                            $total = 0;
                            foreach ($_SESSION["array"]  as $key => $value) : ?>
                                <?php ?>
                                <tr>
                                    <td><?= $value['produitAP'] ?></td>
                                    <td><?= $value['prixAP'] ?></td>
                                    <td><?= $value['quantiteAP'] ?></td>
                                    <td><?= $value['montantAP'] ?></td>
                                    <?php $total += $value['montantAP'] ?>


                                     <td>
                                    <a href="" onclick="confirm('Vouslez-vous vraiment supprimer ?')" class="text-white">
                                        <i class="fa-solid fa-trash"></i>Supprimer</a>
                                </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="glototal">
                <div class="total">
                    <label for="">Total a payer</label>
                    <input type="text" value="<?= isset($total) ? $total : "0"  ?>" name="valeur_total" class="valeur_total">
                    <!-- <button>ENREGISTRER</button> -->
                    <input type="submit" name="save" value="ENREGISTRER" class="btn_enregistrer">
                </div>
            </div>
        </div>
    </form>

</body>

</html>