<?php
// if(!is_admin()) header("Location:".WEB_ROUTE."?controller=affaireController&view=affaire");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['view'])) {
        if ($_GET['view'] == "categorie") {
            require_once(ROUTE_DIR . 'view/categorie/categorie_add.html.php');
        } elseif ($_GET['view'] == "categorie_list") {
            $categorieconfectionlist = get_all_categorieconfection_db();
            require_once(ROUTE_DIR . 'view/categorie/categorie_list.html.php');
        } elseif ($_GET['view'] == "edit") {
            $idCC = (int) $_GET["idCC"];
            $categorieconfectionEdit = get_categorieconfection_by_id_bd($idCC);
            require_once(ROUTE_DIR . 'view/categorie/categorie_add.html.php');
        } elseif ($_GET['view'] == "delet") {
            $idCC = (int) $_GET["idCC"];
            $categorieconfectionDelet = get_categorieconfection_by_idCC_db($idCC);

            header("Location:" . WEB_ROUTE . "?controller=categorieController&view=categorie_list");
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['action'])) {
        if ($_POST["action"] == "add") {
            ajout_categorieconfection($_POST);
        } elseif ($_POST["action"] == "edit") {
            edit_categorieconfection($_POST);
        }
    }
}



function ajout_categorieconfection($data)
{

    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "libelleCC", $libelleCC);

    if (empty($arrayError)) {
        $categorieconfection = [
            "libelleCC" => $libelleCC
        ];
        $result = ajout_categorieconfection_db($categorieconfection);
        if ($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
            header("Location:" . WEB_ROUTE . "?controller=categorieController&view=categorie_list");
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
    } else {

        $_SESSION["arrayError"] = $arrayError;
        header("Location:" . WEB_ROUTE . "?controller=categorieController&view=categorie");
    }
}

function edit_categorieconfection($data)
{
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "libelleCC", $libelleCC);

    if (empty($arrayError)) {
        $categorieconfection = [
            "libelleCC" => $libelleCC,
            "idCC" => $idCC
        ];
        $result = edit_categorieconfection_db($categorieconfection);
        if ($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
    } else {

        $_SESSION["arrayError"] = $arrayError;
    }
    header("Location:" . WEB_ROUTE . "?controller=categorieController&view=categorie_list");
}
