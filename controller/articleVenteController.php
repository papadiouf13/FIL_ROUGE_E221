<?php
// if(!is_admin()) header("Location:".WEB_ROUTE."?controller=affaireController&view=affaire");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['view'])) {
        if ($_GET['view'] == "add_article") {
            $categoriearticlevente = get_all_categorieconfectionvente_db();
            require_once(ROUTE_DIR . 'view/article_vente/article_vente_add.html.php');
        } elseif ($_GET['view'] == "article_list") {
            $page = 1;
            if (isset($_GET['page'])) {
                $page = (int)$_GET['page'];
            }
            $totalList = show_all_articlevente();
            $articleventelist = get_list_per_page($totalList,$page, 8);
            $nbrPage = get_nbrpage($totalList, 8);
            require_once(ROUTE_DIR . 'view/article_vente/article_vente_list.html.php');
        }elseif ($_GET['view'] == "move") {
            $idAV = (int) $_GET["idAV"];
            $articleventeEdit = get_articlevente_by_id_bd($idAV);
            $categoriearticlevente = get_all_categorieconfectionvente_db();
            require_once(ROUTE_DIR . 'view/article_vente/article_vente_add.html.php');
        } elseif ($_GET['view'] == "effacer") {
            $idAV = (int) $_GET["idAV"];
            $articleventeDelet = get_articlevente_by_idAV_db($idAV);
            
            header("Location:" . WEB_ROUTE . "?controller=articleVenteController&view=article_list");
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['action'])) {
        if($_POST["action"] == "add") {
            ajout_articlevente($_POST, $_FILES);
        } elseif ($_POST["action"] == "move") {
            edit_articlevente($_POST, $_FILES);

        }
    }
}



function ajout_articlevente($data, $files) {
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "libelleAV", $libelleAV);
    valide_champs($arrayError, "prixAV", $prixAV);
    valide_champs($arrayError, "quantiteAV", $quantiteAV);
    //valide_libelle($arrayError,"photoAV", $photoAV);

    if (empty($arrayError)) {
        $articlevente = [
            "libelleAV" => $libelleAV,
            "prixAV" => (int)$prixAV,
            "quantiteAV" => (int)$quantiteAV,
            "montantAV" => (int)$prixAV * (int)$quantiteAV,
            "idCAV" => (int)$categorieCAV,
            "photoAV" => $files['photoAV']['name'],
        ];
        to_uploads($files, "photoAV");
        $result = ajout_articlevente_db($articlevente);
        if($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
            header("Location:".WEB_ROUTE."?controller=articleVenteController&view=article_list");
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
    } else {
        
        $_SESSION["arrayError"] = $arrayError;
        header("Location:".WEB_ROUTE."?controller=articleVenteController&view=add_article");

    }
}

function edit_articlevente($data , $files) {
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "libelleAV", $libelleAV);
    valide_libelle($arrayError, "prixAV", $prixAV);
    valide_libelle($arrayError, "quantiteAV", $quantiteAV);
    valide_libelle($arrayError, "idCAV", $categorieCAV);

    if (empty($arrayError)) {
        $articlevente = [
            "libelleAV" => $libelleAV,
            "prixAV" => (int)$prixAV,
            "quantiteAV" => (int)$quantiteAV,
            "montantAV" => (int)$prixAV * (int)$quantiteAV,
            "idCAV" => (int)$categorieCAV,
            "photoAV" => $files['photoAV']['name'],
            "idAV" => $idAV
        ];
        to_uploads($files, "photoAV");
        $result = edit_articlevente_db($articlevente);
        if($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
    } else {
        
        $_SESSION["arrayError"] = $arrayError;
    }

    header("Location:".WEB_ROUTE."?controller=articleVenteController&view=article_list");
}
function show_all_articlevente()
{
    if (isset($_GET['OK'])) {
        $articleventelist = filtre_by_libellevente($_GET['recherche']);
        return $articleventelist;
        /* require_once(ROUTE_DIR . 'view/fournisseur/fournisseur_list.html.php'); */
    } else {
        $articleventelist = get_all_articlevente_db();
        return $articleventelist;
/*         require_once(ROUTE_DIR . 'view/fournisseur/fournisseur_list.html.php');
 */    }
}