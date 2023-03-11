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
    <link rel="stylesheet" href="css/styleutilisateur.css">
</head>

<body>
    <?php
    require_once(ROUTE_DIR . "view/inc/menu.inc.html.php");
    ?>
    
    <div class="container___form">
    <button class="breukh"><a href="<?=WEB_ROUTE."?controller=utilisateur&view=utilisateur_list"?>" style="color:aliceblue">Liste utilisateur</a>
    </button>
    <form action="<?= WEB_ROUTE ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="controller" value="utilisateur">
                <?php if(!isset($utilisateurEdit) || $utilisateurEdit['idU'] == null): ?>
                    <input type="hidden" name="action" value="add">
                <?php endif; ?>
                <?php if(isset($utilisateurEdit) && $utilisateurEdit['idU'] != null): ?>
                    <input type="hidden" name="action" value="editer">
                    <input type="hidden" name="idU" value="<?= $utilisateurEdit['idU'] ?>">
                <?php endif; ?>
            <div class="title__form">
                <h1>Ajouter un utilisateur</h1>
            </div>
            <div class="form-controler">
            <h2 class="titre">Ajouter un utilisateur</h2>
                <label for="libelle" class="form-label">Nom</label>
                <input type="text" class="form-control" name="nomU" id="nomU" value="<?= isset($utilisateurEdit) ? $utilisateurEdit['nomU'] : '' ?>">
                <span  class="erreur"><?=isset($arrayError) && isset($arrayError["nomU"]) ? $arrayError["nomU"] : '';?></span>
                <label for="libelle" class="form-label">Prenom</label>
                <input type="text" class="form-control" name="prenomU" id="prenomU" value="<?= isset($utilisateurEdit) ? $utilisateurEdit['prenomU'] : '' ?>">
                <span class="erreur"><?=isset($arrayError) && isset($arrayError["prenomU"]) ? $arrayError["prenomU"] : '';?></span>
                <label for="libelle" class="form-label">Telephone Portable</label>
                <input type="text" class="form-control" name="telephoneU" id="telephoneU" value="<?= isset($utilisateurEdit) ? $utilisateurEdit['telephoneU'] : '' ?>">
                <span class="erreur"><?=isset($arrayError) && isset($arrayError["telephoneU"]) ? $arrayError["telephoneU"] : '';?></span>
                <label for="libelle" class="form-label">Adresse</label>
                <input type="text" class="form-control" name="adresseU" id="adresseU" value="<?= isset($utilisateurEdit) ? $utilisateurEdit['adresseU'] : '' ?>">
                <span class="erreur"><?=isset($arrayError) && isset($arrayError["adresseU"]) ? $arrayError["adresseU"] : '';?></span>
                <label for="libelle" class="form-label">Salaire</label>
                <input type="text" class="form-control" name="salaireU" id="salaireU" value="<?= isset($utilisateurEdit) ? $utilisateurEdit['salaireU'] : '' ?>">
                <span class="erreur"><?=isset($arrayError) && isset($arrayError["salaireU"]) ? $arrayError["salaireU"] : '';?></span>
                <label for="libelle" class="form-label">Login</label>
                <input type="email" class="form-control" name="login" id="login" value="<?= isset($utilisateurEdit) ? $utilisateurEdit['login'] : '' ?>">
                <span class="erreur"><?=isset($arrayError) && isset($arrayError["login"]) ? $arrayError["login"] : '';?></span>
                <label for="libelle" class="form-label">Mot de passe</label>
                <input type="text" class="form-control" name="password" id="password" value="<?= isset($utilisateurEdit) ? $utilisateurEdit['password'] : '' ?>">
                <span class="erreur"><?=isset($arrayError) && isset($arrayError["password"]) ? $arrayError["password"] : '';?></span>
                <label for="libelle" class="form-label">Role</label>
                <select name="idR" id="categorie" class="form-control">
                    <option value=" <?php ($utilisateurEdit['idU'])?> ">Selectionnez le role</option>
                    <?php foreach ($categories as $categorie) : ?>
                        <option value="<?= $categorie['idR'] ?>"><?= $categorie['libelleR'] ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="libelle" class="form-label">Photo</label>
                <input type="file" class="form-control" name="photoU" id="photoU" value="<?= isset($utilisateurEdit) ? $utilisateurEdit['photoU'] : '' ?>">
                <span class="erreur"><?=isset($arrayError) && isset($arrayError["photoU"]) ? $arrayError["photoU"] : '';?></span>

            </div>
            <div class="form-controler">
                <button type="submit" class="bouroudj">Enregistrer</button>
            </div>
        </form>
    </div>

</body>

</html>