<?php
// if(!is_admin()) header("Location:".WEB_ROUTE."?controller=affaireController&view=affaire");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['view'])) {
        if ($_GET['view'] == "vente") {
            $clientlist = get_all_client_db();
            $categories = get_all_categorieconfectionvente_db();
            $articleventelist = get_all_articlevente_db();
            
            require_once(ROUTE_DIR . 'view/vente/vente_add.html.php');
        } elseif ($_GET['view'] == "vente_list") {
            $page = 1;
            if (isset($_GET['page'])) {
                $page = (int)$_GET['page'];
            }
            $totalList = show_all_vente();
            $ventelist = get_list_per_page($totalList, $page, 5);
            $nbrPage = get_nbrpage($totalList, 5);
            require_once(ROUTE_DIR . 'view/vente/vente_list.html.php');
        } elseif ($_GET['view'] == "editer") {
            $idAPP = (int) $_GET["idAPP"];
            $venteEdit = get_vente_by_id_bd($idAPP);
            require_once(ROUTE_DIR . 'view/vente/vente_add.html.php');
        }elseif ($_GET['view'] == "detail") {
            $idV = $_GET['idV'];
            $vente = get_vente_by_id_bd($idV);
            $detailproduit = detail_produit_vente($vente["idV"]);
            require_once(ROUTE_DIR . 'view/vente/detailsproduitvente.html.php');
        }
         elseif ($_GET['view'] == "supprimer") {
            $idV = (int) $_GET["idV"];
            $venteDelet = get_vente_by_idV_db($idV);

            header("Location:" . WEB_ROUTE . "?controller=vente&view=vente_list");
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['action'])) {
        if ($_POST["action"] == "add") {
            if (isset($_POST['OK'])) {
                boutton_OK();
                var_dump($_POST);die;
            }elseif (isset($_POST['val'])) { 
                extract($_POST);  
                $result = get_articlevente_by_id_bd((int) $produitAP);
                $_SESSION['articlevente'] = $result;
                $_SESSION['articlevente']['produitAP'] = $result['libelleAV'];
                $_SESSION['articlevente']['prixAV'] = $result['prixAV'];
                
                header("Location:" . WEB_ROUTE . "?controller=vente&view=vente");
           } elseif (isset($_POST['save'])) {
                $save = $_POST['save'];
                if ($save == 'ajouter') {
                    getData($_POST);
                } elseif ($save == "ENREGISTRER") {
                    ajout_vente($_POST);
                    /* echo "<pre>";
                    var_dump($enregistrer);
                    die;
                    echo "</pre>"; */




                    /* ajout_vente($data); */
                    unset($_SESSION["array"]);
                }
            } elseif ($_POST["action"] == "editer") {
                edit_vente($_POST);
            }
        }
    }
}

function boutton_OK()
{
    $_SESSION['selection']['dateAP'] = $_POST['dateAP'];
    $_SESSION['selection']['idC'] = $_POST['idC'];
    $_SESSION['selection']['categorieAV'] = $_POST['categorieAV'];
    $typearticlevente = selection_categorie_vente((int) $_POST['categorieAV']);
    $_SESSION['selection']['typecategorieconfection'] = $typearticlevente;
    $_SESSION['selection']['produitAP'] = $_POST['produitAP'];
    $_SESSION['selection']['prixAP'] = $_POST['prixAP'];

    //var_dump($_SESSION['selection']['rawane']);die;
    header("Location:" . WEB_ROUTE . "?controller=vente&view=vente");
}

function ajout_vente($data)
{
    $arrayError = array();
    //extract($data);
    valide_libelle($arrayError, "montantAP",$data['valeur_total']);
    /*  valide_libelle($arrayError, "prixAP", $prixAP);
    valide_libelle($arrayError, "quantiteAP", $quantiteAP);
    est_entier($arrayError, "montantAP", $montantAP);
    valide_libelle($arrayError, "idF", $idF); */
    $userconnect = $_SESSION['userConnect'];
    if (empty($arrayError)) {
        $newvente = [
            "montantV" => $data['valeur_total'],
            'idC' => $data['idC'],
            'dateV' => $data['dateAP'],
            'idU' => $userconnect['idU']
        ];
        $result = ajout_vente_db($newvente);
        $arrayvente = $_SESSION['array'];
        foreach ($arrayvente as $value){
            $vente = [
                'idV'=> $result,
                'idAV'=>$value['produitAP'],
                'quantiteAP'=>$value['quantiteAP']     
            ];
            ajout_articledeventevente_db($vente);
        }
         header("Location:" . WEB_ROUTE . "?controller=vente&view=vente_list");
    } else {

        $_SESSION["arrayError"] = $arrayError;
         header("Location:" . WEB_ROUTE . "?controller=vente&view=vente");

    }
}

function edit_vente($data)
{
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "prixAP", $prixAP);
    valide_libelle($arrayError, "quantiteAP", $quantiteAP);
    valide_libelle($arrayError, "montantAP", $montantAP);
    valide_libelle($arrayError, "observation", $observation);
    valide_libelle($arrayError, "idF", $idF);
    valide_libelle($arrayError, "idU", $idU);

    if (empty($arrayError)) {
        $vente = [
            "prixAP" => $prixAP,
            "quantiteAP" => $quantiteAP,
            "montantAP" => $montantAP,
            "observation" => $observation,
            "idF" => $idF,
            "idU" => $idU,
            "idAPP" => $idAPP
        ];

        $result = edit_vente_db($vente);
        if ($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
    } else {
        $_SESSION["arrayError"] = $arrayError;
    }
    header("Location:" . WEB_ROUTE . "?controller=vente&view=vente_list");
}
function choix_categorie($data)
{
}
function getData($data)
{
    extract($data);
    if (isset($_SESSION["array"])) {
        //unset($_SESSION["array"]);die;
        $array = $_SESSION["array"];
        foreach ($array as $key => $value) {
            if ($value['produitAP'] == $produitAP) {
                $vente = [
                    "dateAP" => $_SESSION['selection']['dateAP'],
                    "idC" =>  $_SESSION['selection']['idC'],
                    "categorie" => $_SESSION['selection']['categorieAV'],
                    "prixAP" => $prixAP,
                    'idU' => $userconnect['idU'],
                    "quantiteAP" => $value['quantiteAP'] + $quantiteAP,
                    "produitAP" => $produitAP,
                    "montantAP" => (int) $prixAP * (int) ($value['produitAP'] + $quantiteAP)
                ];
                unset($array[$key]);
            } else {
                $vente = getArray($data);
            }
        }
    } else {
        $array = [];
        $vente = getArray($data);
    }
    array_push($array, $vente);

    $_SESSION["array"] = $array;

    header("Location:" . WEB_ROUTE . "?controller=vente&view=vente");
}
function getArray($post)
{
    extract($post);
    return  [
        "dateAP" => $_SESSION['selection']['dateAP'],
        "client" =>  $_SESSION['selection']['idC'],
        "categorie" => $_SESSION['selection']['categorieAV'],
        "prixAP" => $prixAP,
        'idU' => $userconnect['idU'],
        "quantiteAP" => $quantiteAP,
        "produitAP" => $produitAP,
        "montantAP" => (int) $prixAP * (int) $quantiteAP
    ];

}
function show_all_vente()
{
    if (isset($_GET['OK'])) {
        $ventelist = filtre_by_appro($_GET['recherche']);
        return $ventelist;
        /* require_once(ROUTE_DIR . 'view/client/client_list.html.php'); */
    } else {
        $ventelist = get_all_vente_db();
        return $ventelist;
        /*         require_once(ROUTE_DIR . 'view/client/client_list.html.php');
 */
    }
}
