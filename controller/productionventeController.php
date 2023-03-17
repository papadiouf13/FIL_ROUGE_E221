<?php
// if(!is_admin()) header("Location:".WEB_ROUTE."?controller=affaireController&view=affaire");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['view'])) {
        if ($_GET['view'] == "add_article") {
            $categorieproductionvente = get_all_articlevente_db();
            require_once(ROUTE_DIR . 'view/production_vente/production_vente_add.html.php');
        } elseif ($_GET['view'] == "article_list") {
            $page = 1;
            if (isset($_GET['page'])) {
                $page = (int)$_GET['page'];
            }
            $totalList = show_all_productionvente();
            $productionventelist = get_list_per_page($totalList,$page, 8);
            $nbrPage = get_nbrpage($totalList, 8);
            require_once(ROUTE_DIR . 'view/production_vente/production_vente_list.html.php');
        }elseif ($_GET['view'] == "move") {
            $idPAV = (int) $_GET["idPAV"];
            $productionventeEdit = get_productionvente_by_id_bd($idPAV);
            $categorieproductionvente = get_all_articlevente_db();
            require_once(ROUTE_DIR . 'view/production_vente/production_vente_add.html.php');
        } elseif ($_GET['view'] == "effacer") {
            $idPAV = (int) $_GET["idPAV"];
            $productionventeDelet = get_productionvente_by_idAV_db($idPAV);
            
            header("Location:" . WEB_ROUTE . "?controller=productionventeController&view=article_list");
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['action'])) {
        if($_POST["action"] == "add") {
            ajout_productionvente($_POST);
        } elseif ($_POST["action"] == "move") {
            edit_productionvente($_POST);

        }
    }
}



function ajout_productionvente($data) {

    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "datePAV", $datePAV);
    valide_champs($arrayError, "quantitePAV", $quantitePAV);
    valide_libelle($arrayError, "observationPAV", $observationPAV);
    valide_libelle($arrayError, "idAV", $idAV);

    if (empty($arrayError)) {
        $productionvente = [
            "datePAV" => $datePAV,
            "quantitePAV" => (int)$quantitePAV,
            "observationPAV" => $observationPAV,
            "idAV" => $idAV
        ];
        $result = ajout_productionvente_db($productionvente);
        if($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
            header("Location:".WEB_ROUTE."?controller=productionventeController&view=article_list");
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
    } else {
        
        $_SESSION["arrayError"] = $arrayError;
    var_dump($arrayError);die;
        header("Location:".WEB_ROUTE."?controller=productionventeController&view=add_article");

    }
}

function edit_productionvente($data) {
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "datePAV", $datePAV);
    valide_champs($arrayError, "quantitePAV", $quantitePAV);
    valide_libelle($arrayError, "observationPAV", $observationPAV);
    valide_libelle($arrayError, "idAV", $idAV);

    if (empty($arrayError)) {
        $productionvente = [
            "datePAV" => $datePAV,
            "quantitePAV" => (int)$quantitePAV,
            "observationPAV" => $observationPAV,
            "idAV" => $idAV,
            "idPAV" => $idPAV
        ];
        $result = edit_productionvente_db($productionvente);
        if($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
    } else {
        
        $_SESSION["arrayError"] = $arrayError;
    }

    header("Location:".WEB_ROUTE."?controller=productionventeController&view=article_list");
}
function show_all_productionvente()
{
    if (isset($_GET['OK'])) {
        $productionventelist = filtre_by_productionvente($_GET['recherche']);
        return $productionventelist;
        /* require_once(ROUTE_DIR . 'view/fournisseur/fournisseur_list.html.php'); */
    } else {
        $productionventelist = get_all_productionvente_db();
        return $productionventelist;
/*         require_once(ROUTE_DIR . 'view/fournisseur/fournisseur_list.html.php');
 */    }
}