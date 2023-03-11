<?php
// if(!is_admin()) header("Location:".WEB_ROUTE."?controller=affaireController&view=affaire");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['view'])) {
        if ($_GET['view'] == "categorievente") {
            require_once(ROUTE_DIR . 'view/catvente/categorievente_add.html.php');
        }elseif ($_GET['view'] == "categorievente_list") {
            $page = 1;
            if (isset($_GET['page'])) {
                $page = (int)$_GET['page'];
            }
            $totalList = show_all_categorievente();
            $categorieventelist = get_list_per_page($totalList,$page, 8);
            $nbrPage = get_nbrpage($totalList, 8);
            require_once(ROUTE_DIR . 'view/catvente/categorievente_list.html.php');
        } elseif ($_GET['view'] == "edit") {
            $idCAV = (int) $_GET["idCAV"];
            $categorieconfectionventeEdit = get_categorieconfectionvente_by_id_bd($idCAV);
            require_once(ROUTE_DIR . 'view/catvente/categorievente_add.html.php');
        } elseif ($_GET['view'] == "delet") {
            $idCAV = (int) $_GET["idCAV"];
            $categorieconfectionDelet = get_categorieconfectionvente_by_idCAV_db($idCAV);

            header("Location:" . WEB_ROUTE . "??controller=catventeController&view=categorievente_list");
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['action'])) {
        if ($_POST["action"] == "add") {
            ajout_categorieconfectionvente($_POST);
        } elseif ($_POST["action"] == "edit") {
            edit_categorieconfectionvente($_POST);
        }
    }
}



function ajout_categorieconfectionvente($data)
{

    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "libelleCAV", $libelleCAV);

    if (empty($arrayError)) {
        $categorieconfectionvente = [
            "libelleCAV" => $libelleCAV
        ];
        $result = ajout_categorieconfectionvente_db($categorieconfectionvente);
        if ($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
            header("Location:" . WEB_ROUTE . "?controller=catventeController&view=categorievente_list");
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
    } else {

        $_SESSION["arrayError"] = $arrayError;
        header("Location:" . WEB_ROUTE . "?controller=catventeController&view=categorievente");
    }
}

function edit_categorieconfectionvente($data)
{
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "libelleCAV", $libelleCAV);

    if (empty($arrayError)) {
        $categorieconfectionvente = [
            "libelleCAV" => $libelleCAV,
            "idCAV" => $idCAV
        ];
        $result = edit_categorieconfectionvente_db($categorieconfectionvente);
        if ($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
    } else {

        $_SESSION["arrayError"] = $arrayError;
    }
    header("Location:" . WEB_ROUTE . "?controller=catventeController&view=categorievente_list");
}
function show_all_categorievente()
{
    if (isset($_GET['OK'])) {
        $categorieventelist = filtre_by_categorievente($_GET['recherche']);
        return $categorieventelist;
    } else {
        $categorieventelist = get_all_categorieconfectionvente_db();
        return $categorieventelist;
   }
}