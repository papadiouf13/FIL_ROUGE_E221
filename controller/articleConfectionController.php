<?php
// if(!is_admin()) header("Location:".WEB_ROUTE."?controller=affaireController&view=affaire");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['view'])) {
        if ($_GET['view'] == "add_article") {
            $categories = get_all_categorieconfection_db();
            require_once(ROUTE_DIR . 'view/article_confection/article_confection_add.html.php');
        } elseif ($_GET['view'] == "article_list") {
            $page = 1;
            if (isset($_GET['page'])) {
                $page = (int)$_GET['page'];
            }
            $totalList = show_all_articleconfection();
            $articleconfectionlist = get_list_per_page($totalList,$page, 8);
            $nbrPage = get_nbrpage($totalList, 8);
            require_once(ROUTE_DIR . 'view/article_confection/article_confection_list.html.php');
        }elseif ($_GET['view'] == "move") {
            $idAC = (int) $_GET["idAC"];
            $articleconfectionEdit = get_articleconfection_by_id_bd($idAC);
            $categories = get_all_categorieconfection_db();
            require_once(ROUTE_DIR . 'view/article_confection/article_confection_add.html.php');
        } elseif ($_GET['view'] == "effacer") {
            $idAC = (int) $_GET["idAC"];
            $articleconfectionDelet = get_articleconfection_by_idAC_db($idAC);
            
            header("Location:" . WEB_ROUTE . "?controller=articleConfectionController&view=article_list");
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['action'])) {
        if($_POST["action"] == "add") {
            ajout_articleconfection($_POST, $_FILES);
        } elseif ($_POST["action"] == "move") {
            edit_articleconfection($_POST, $_FILES);
        }
    }
}



function ajout_articleconfection($data, $files) {
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "libelleAC", $libelleAC);
    valide_libelle($arrayError, "prixAC", $prixAC);
    valide_libelle($arrayError, "quantiteAC", $quantiteAC);
    //valide_libelle($arrayError, "photoAC", $photoAC);
    valide_libelle($arrayError, "idCC", $categorieAC);


    if (empty($arrayError)) {
        $articleconfection = [
            "libelleAC" => $libelleAC,
            "prixAC" => (int)$prixAC,
            "quantiteAC" => (int)$quantiteAC,
            "montantAC" => (int)$prixAC * (int)$quantiteAC,
            "idCC" => (int)$categorieAC,
            "photoAC" => $files['photoAC']['name'],
        ];
        to_uploads($files, "photoAC");
        $result = ajout_articleconfection_db($articleconfection);
        if($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
            header("Location:".WEB_ROUTE."?controller=articleConfectionController&view=article_list");
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
    } else {
        
        $_SESSION["arrayError"] = $arrayError;
        header("Location:".WEB_ROUTE."?controller=articleConfectionController&view=add_article");
    }

}

function edit_articleconfection($data, $files) {
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "libelleAC", $libelleAC);
    valide_libelle($arrayError, "prixAC", $prixAC);
    valide_libelle($arrayError, "quantiteAC", $quantiteAC);
    //valide_libelle($arrayError, "photoAC", $photoAC);
    valide_libelle($arrayError, "idCC", $categorieAC);

    if (empty($arrayError)) {
        $articleconfection = [
            "libelleAC" => $libelleAC,
            "prixAC" => (int)$prixAC,
            "quantiteAC" => (int)$quantiteAC,
            "montantAC" => (int)$prixAC * (int)$quantiteAC,
            "idCC" => (int)$categorieAC,
            "photoAC" => $files['photoAC']['name'],
        ];
    var_dump($articleconfection);die;
        $result = edit_articleconfection_db($articleconfection);
        if($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
            header("Location:".WEB_ROUTE."?controller=articleConfectionController&view=article_list");
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
    } else {
        
        $_SESSION["arrayError"] = $arrayError;
        header("Location:".WEB_ROUTE."?controller=articleVenteController&view=add_article");
    }
}
function show_all_articleconfection()
{
    if (isset($_GET['OK'])) {
        $articleconfectionlist = filtre_by_libelle($_GET['recherche']);
        return $articleconfectionlist;
        /* require_once(ROUTE_DIR . 'view/fournisseur/fournisseur_list.html.php'); */
    } else {
        $articleconfectionlist = get_all_articleconfection_db();
        return $articleconfectionlist;
/*         require_once(ROUTE_DIR . 'view/fournisseur/fournisseur_list.html.php');
 */    }
}