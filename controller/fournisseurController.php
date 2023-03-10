<?php
// if(!is_admin()) header("Location:".WEB_ROUTE."?controller=affaireController&view=affaire");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['view'])) {
        if ($_GET['view'] == "fournisseur") {
            require_once(ROUTE_DIR . 'view/fournisseur/fournisseur_add.html.php');
        } elseif ($_GET['view'] == "fournisseur_list") {
            $page = 1;
            if (isset($_GET['page'])) {
                $page = (int)$_GET['page'];
            }
            $totalList = show_all_fournisseur();
            $fournisseurlist = get_list_per_page($totalList,$page, 3);
            $nbrPage = get_nbrpage($totalList, 3);
            require_once(ROUTE_DIR . 'view/fournisseur/fournisseur_list.html.php');
        } elseif ($_GET['view'] == "editer") {
            $idF = (int) $_GET["idF"];
            $fournisseurEdit = get_fournisseur_by_id_bd($idF);
            require_once(ROUTE_DIR . 'view/fournisseur/fournisseur_add.html.php');
        } elseif ($_GET['view'] == "delete") {
            $idF = (int) $_GET["idF"];
            $fournisseurDelet = get_fournisseur_by_idF_db($idF);

            header("Location:" . WEB_ROUTE . "?controller=fournisseur&view=fournisseur_list");
        } 
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['action'])) {
        if ($_POST["action"] == "add") {
            ajout_fournisseur($_POST);
        } elseif ($_POST["action"] == "editer") {
            edit_fournisseur($_POST);
        }
    }
}



function ajout_fournisseur($data)
{
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "prenom", $prenom);
    valide_libelle($arrayError, "nom", $nom);
    valide_libelle($arrayError, "telephonePort", $telephonePort);
    valide_libelle($arrayError, "telephonefixe", $telephonefixe);
    valide_libelle($arrayError, "adresse", $adresse);

    if (empty($arrayError)) {
        $fournisseur = [
            "prenom" => $prenom,
            "nom" => $nom,
            "telephonePort" => $telephonePort,
            "telephonefixe" => $telephonefixe,
            "adresse" => $adresse,
            "photoF" => $photoF,
        ];

        $result = ajout_fournisseur_db($fournisseur);
        if ($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
            header("Location:" . WEB_ROUTE . "?controller=fournisseur&view=fournisseur_list");
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
    } else {

        $_SESSION["arrayError"] = $arrayError;
        header("Location:" . WEB_ROUTE . "?controller=fournisseur&view=fournisseur");

    }
}

function edit_fournisseur($data)
{
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "prenom", $prenom);
    valide_libelle($arrayError, "nom", $nom);
    valide_libelle($arrayError, "telephonePort", $telephonePort);
    valide_libelle($arrayError, "telephonefixe", $telephonefixe);
    valide_libelle($arrayError, "adresse", $adresse);

    if (empty($arrayError)) {
        $fournisseur = [
            "nom" => $nom,
            "prenom" => $prenom,
            "telephonePort" => $telephonePort,
            "telephonefixe" => $telephonefixe,
            "adresse" => $adresse,
            "photoF" => $photoF,
            "idF" => $idF
        ];

        $result = edit_fournisseur_db($fournisseur);
        if ($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
    } else {
        $_SESSION["arrayError"] = $arrayError;
    }
    header("Location:" . WEB_ROUTE . "?controller=fournisseur&view=fournisseur_list");
}
function show_all_fournisseur()
{
    if (isset($_GET['OK'])) {
        $fournisseurlist = filtre_by_prenom($_GET['recherche']);
        return $fournisseurlist;
        /* require_once(ROUTE_DIR . 'view/fournisseur/fournisseur_list.html.php'); */
    } else {
        $fournisseurlist = get_all_fournisseur_db();
        return $fournisseurlist;
/*         require_once(ROUTE_DIR . 'view/fournisseur/fournisseur_list.html.php');
 */    }
}
