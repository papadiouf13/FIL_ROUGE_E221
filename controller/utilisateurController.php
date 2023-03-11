<?php
// if(!is_admin()) header("Location:".WEB_ROUTE."?controller=affaireController&view=affaire");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['view'])) {
        if ($_GET['view'] == "utilisateur") {
            $categories = get_all_role_db();
            require_once(ROUTE_DIR . 'view/utilisateur/utilisateur_add.html.php');
        } elseif ($_GET['view'] == "utilisateur_list") {
            $page = 1;
            if (isset($_GET['page'])) {
                $page = (int)$_GET['page'];
            }
            $totalList = show_all_utilisateur();
            $utilisateurlist = get_list_per_page($totalList,$page, 5);
            $nbrPage = get_nbrpage($totalList, 5);
            require_once(ROUTE_DIR . 'view/utilisateur/utilisateur_list.html.php');
        } elseif ($_GET['view'] == "editer") {
            $idU = (int) $_GET["idU"];
            $utilisateurEdit = get_utilisateur_by_id_bd($idU);
            require_once(ROUTE_DIR . 'view/utilisateur/utilisateur_add.html.php');
        } elseif ($_GET['view'] == "delete") {
            $idU = (int) $_GET["idU"];
            $utilisateurDelet = get_utilisateur_by_idU_db($idU);

            header("Location:" . WEB_ROUTE . "?controller=utilisateur&view=utilisateur_list");
        } 
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['action'])) {
        if ($_POST["action"] == "add") {
            ajout_utilisateur($_POST, $_FILES);
        } elseif ($_POST["action"] == "editer") {
            edit_utilisateur($_POST, $_FILES);
        }
    }
}



function ajout_utilisateur($data, $files)
{

    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "prenomU", $prenomU);
    valide_libelle($arrayError, "nomU", $nomU);
    valide_libelle($arrayError, "telephoneU", $telephoneU);
    valide_libelle($arrayError, "adresseU", $adresseU);
    valide_libelle($arrayError, "salaireU", $salaireU);
    valide_libelle($arrayError, "loginU", $loginU);
    valide_libelle($arrayError, "passwordU", $passwordU);
    valide_libelle($arrayError, "idR", $idR);

    if (empty($arrayError)) {
        $utilisateur = [
            "prenomU" => $prenomU,
            "nomU" => $nomU,
            "telephoneU" => $telephoneU,
            "adresseU" => $adresseU,
            "salaireU" => $salaireU,
            "loginU" => $loginU,
            "passwordU" => $passwordU,
            "idR" => $idR,
            "photoU" => $files['photoU']['name'],
        ];
        to_upload_Utilisateur($files, "photoU");
        //var_dump($utilisateur);die;
        $result = ajout_utilisateur_db($utilisateur);
        if ($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
            header("Location:" . WEB_ROUTE . "?controller=utilisateur&view=utilisateur_list");
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
    } else {

        $_SESSION["arrayError"] = $arrayError;
        header("Location:" . WEB_ROUTE . "?controller=utilisateur&view=utilisateur");

    }
}

function edit_utilisateur($data, $files)
{
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "prenomU", $prenomU);
    valide_libelle($arrayError, "nomU", $nomU);
    valide_libelle($arrayError, "telephoneU", $telephoneU);
    valide_libelle($arrayError, "adresseU", $adresseU);
    valide_libelle($arrayError, "salaireU", $salaireU);
    valide_libelle($arrayError, "loginU", $loginU);
    valide_libelle($arrayError, "passwordU", $passwordU);
    //valide_libelle($arrayError, "idR", $idR);

    if (empty($arrayError)) {
        $utilisateur = [
            "prenomU" => $prenomU,
            "nomU" => $nomU,
            "telephoneU" => $telephoneU,
            "adresseU" => $adresseU,
            "salaireU" => $salaireU,
            "loginU" => $loginU,
            "passwordU" => $passwordU,
            "photoU" => $files['photoU']['name'],
            "idU" => $idU
        ];
        to_upload_Utilisateur($files, "photoU");
        $result = edit_utilisateur_db($utilisateur);
        //var_dump($result);die;
        if ($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
    } else {
        $_SESSION["arrayError"] = $arrayError;
    }
    header("Location:" . WEB_ROUTE . "?controller=utilisateur&view=utilisateur_list");
}
function show_all_utilisateur()
{
    if (isset($_GET['OK'])) {
        $utilisateurlist = filtre_by_preenoom($_GET['recherche']);
        return $utilisateurlist;
        /* require_once(ROUTE_DIR . 'view/utilisateur/utilisateur_list.html.php'); */
    } else {
        $utilisateurlist = get_all_utilisateur_db();
        return $utilisateurlist;
/*         require_once(ROUTE_DIR . 'view/utilisateur/utilisateur_list.html.php');
 */    }
}
