<?php
// if(!is_admin()) header("Location:".WEB_ROUTE."?controller=affaireController&view=affaire");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['view'])) {
        if ($_GET['view'] == "client") {
            require_once(ROUTE_DIR . 'view/client/client_add.html.php');
        } elseif ($_GET['view'] == "client_list") {
            $page = 1;
            if (isset($_GET['page'])) {
                $page = (int)$_GET['page'];
            }
            $totalList = show_all_client();
            $clientlist = get_list_per_page($totalList,$page, 3);
            $nbrPage = get_nbrpage($totalList, 3);
            require_once(ROUTE_DIR . 'view/client/client_list.html.php');
        } elseif ($_GET['view'] == "editer") {
            $idC = (int) $_GET["idC"];
            $clientEdit = get_client_by_id_bd($idC);
            require_once(ROUTE_DIR . 'view/client/client_add.html.php');
        } elseif ($_GET['view'] == "delete") {
            $idC = (int) $_GET["idC"];
            $clientDelet = get_client_by_idC_db($idC);

            header("Location:" . WEB_ROUTE . "?controller=client&view=client_list");
        } 
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['action'])) {
        if ($_POST["action"] == "add") {
            ajout_client($_POST, $_FILES);
        } elseif ($_POST["action"] == "editer") {
            edit_client($_POST, $_FILES);
        }
    }
}



function ajout_client($data , $files)
{
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "prenomC", $prenomC);
    valide_libelle($arrayError, "nomC", $nomC);
    valide_libelle($arrayError, "telephoneC", $telephoneC);
    valide_libelle($arrayError, "adresseC", $adresseC);
    if (empty($arrayError)) {
        $client = [
            "prenomC" => $prenomC,
            "nomC" => $nomC,
            "telephoneC" => $telephoneC,
            "adresseC" => $adresseC,
            "photoC" => $files['photoC']['name'],
        ];
        to_upload_Client($files, "photoC");
        $result = ajout_client_db($client);
        if ($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
            header("Location:" . WEB_ROUTE . "?controller=client&view=client_list");
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
    } else {

        $_SESSION["arrayError"] = $arrayError;
        header("Location:" . WEB_ROUTE . "?controller=client&view=client");

    }
}

function edit_client($data, $files)
{
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "prenomC", $prenomC);
    valide_libelle($arrayError, "nomC", $nomC);
    valide_libelle($arrayError, "telephoneC", $telephoneC);
    valide_libelle($arrayError, "adresseC", $adresseC);
    if (empty($arrayError)) {
        $client = [
            "prenomC" => $prenomC,
            "nomC" => $nomC,
            "telephoneC" => $telephoneC,
            "adresseC" => $adresseC,
            "photoC" => $files['photoC']['name'],
            "idC" => $idC
        ];
        to_upload_Client($files, "photoC");
        $result = edit_client_db($client);
        if ($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
    } else {
        $_SESSION["arrayError"] = $arrayError;
    }
    header("Location:" . WEB_ROUTE . "?controller=client&view=client_list");
}
function show_all_client()
{
    if (isset($_GET['OK'])) {
        $clientlist = filtre_by_prenoom($_GET['recherche']);
        return $clientlist;
        /* require_once(ROUTE_DIR . 'view/client/client_list.html.php'); */
    } else {
        $clientlist = get_all_client_db();
        return $clientlist;
/*         require_once(ROUTE_DIR . 'view/client/client_list.html.php');
 */    }
}
