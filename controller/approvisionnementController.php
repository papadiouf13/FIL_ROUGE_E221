<?php
// if(!is_admin()) header("Location:".WEB_ROUTE."?controller=affaireController&view=affaire");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['view'])) {
        if ($_GET['view'] == "approvisionnement") {
            $fournisseurlist = get_all_fournisseur_db();
            $categories = get_all_categorieconfection_db();
            $articleconfectionlist = get_all_articleconfection_db();
            require_once(ROUTE_DIR . 'view/approvisionnement/approvisionnement_add.html.php');
        } elseif ($_GET['view'] == "approvisionnement_list") {
            $page = 1;
            if (isset($_GET['page'])) {
                $page = (int)$_GET['page'];
            }
            $totalList = show_all_approvisionnement();
            $approvisionnementlist = get_list_per_page($totalList, $page, 5);
            $nbrPage = get_nbrpage($totalList, 5);
            require_once(ROUTE_DIR . 'view/approvisionnement/approvisionnement_list.html.php');
        } elseif ($_GET['view'] == "editer") {
            $idAPP = (int) $_GET["idAPP"];
            $approvisionnementEdit = get_approvisionnement_by_id_bd($idAPP);
            require_once(ROUTE_DIR . 'view/approvisionnement/approvisionnement_add.html.php');
        }elseif ($_GET['view'] == "detail") {
            $idAPP = $_GET['idAPP'];
            $approvisionnement = get_approvisionnement_by_id_bd($idAPP);
            $detailproduit = detail_produit($approvisionnement["idAPP"]);
            require_once(ROUTE_DIR . 'view/approvisionnement/detailsproduit.html.php');
        }
         elseif ($_GET['view'] == "supprimer") {
            $idAPP = (int) $_GET["idAPP"];
            $approvisionnementDelet = get_approvisionnement_by_idAPP_db($idAPP);

            header("Location:" . WEB_ROUTE . "?controller=approvisionnement&view=approvisionnement_list");
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['action'])) {
        if ($_POST["action"] == "add") {
            if (isset($_POST['OK'])) {
                boutton_OK();
            }elseif (isset($_POST['val'])) { 
                extract($_POST);  
                $result = get_articleconfection_by_id_bd((int) $produitAP);
   
                $_SESSION['articleconfection'] = $result;
                $_SESSION['articleconfection']['produitAP'] = $result['libelleAC'];
                $_SESSION['articleconfection']['prixAC'] = $result['prixAC'];
                
                header("Location:" . WEB_ROUTE . "?controller=approvisionnement&view=approvisionnement");
           } elseif (isset($_POST['save'])) {
                $save = $_POST['save'];
                if ($save == 'ajouter') {
                    getData($_POST);
                } elseif ($save == "ENREGISTRER") {

                    ajout_approvisionnement($_POST);
                    /* echo "<pre>";
                    var_dump($enregistrer);
                    die;
                    echo "</pre>"; */




                    /* ajout_approvisionnement($data); */
                    unset($_SESSION["array"]);
                }
            } elseif ($_POST["action"] == "editer") {
                edit_approvisionnement($_POST);
            }
        }
    }
}

function boutton_OK()
{
    $_SESSION['selection']['dateAP'] = $_POST['dateAP'];
    $_SESSION['selection']['idF'] = $_POST['idF'];
    $_SESSION['selection']['categorieAC'] = $_POST['categorieAC'];
    $typearticleconfection = selection_categorie((int) $_POST['categorieAC']);
    $_SESSION['selection']['typecategorieconfection'] = $typearticleconfection;
    $_SESSION['selection']['produitAP'] = $_POST['produitAP'];
    $_SESSION['selection']['prixAP'] = $_POST['prixAP'];

    //var_dump($_SESSION['selection']['rawane']);die;
    header("Location:" . WEB_ROUTE . "?controller=approvisionnement&view=approvisionnement");
}

function ajout_approvisionnement($data)
{
    $arrayError = array();
    //extract($data);

    /*  valide_libelle($arrayError, "prixAP", $prixAP);
    valide_libelle($arrayError, "quantiteAP", $quantiteAP);
    est_entier($arrayError, "montantAP", $montantAP);
    valide_libelle($arrayError, "idF", $idF); */
    $userconnect = $_SESSION['userConnect'];
    if (empty($arrayError)) {
        $newapprovisionnement = [
            "montantAP" => $data['valeur_total'],
            'idF' => $data['idF'],
            'dateAP' => $data['dateAP'],
            'idU' => $userconnect['idU']
        ];
        $result = ajout_approvisionnement_db($newapprovisionnement);
        foreach ($_SESSION['array'] as $value){
            $approvisionnement = [
                'idAPP'=> $result,
                'idAC'=>$value['produitAP'],
                'quantiteAP'=>$value['quantiteAP']     
            ];
            ajout_approarticleconfection_db($approvisionnement);
        }
         header("Location:" . WEB_ROUTE . "?controller=approvisionnement&view=approvisionnement_list");
    } else {

        $_SESSION["arrayError"] = $arrayError;
         header("Location:" . WEB_ROUTE . "?controller=approvisionnement&view=approvisionnement");

    }
}

function edit_approvisionnement($data)
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
        $approvisionnement = [
            "prixAP" => $prixAP,
            "quantiteAP" => $quantiteAP,
            "montantAP" => $montantAP,
            "observation" => $observation,
            "idF" => $idF,
            "idU" => $idU,
            "idAPP" => $idAPP
        ];

        $result = edit_approvisionnement_db($approvisionnement);
        if ($result) {
            $_SESSION["success_operation"] = SUCCESS_MSG;
        } else {
            $_SESSION["error_operation"] = FAILED_MSG;
        }
    } else {
        $_SESSION["arrayError"] = $arrayError;
    }
    header("Location:" . WEB_ROUTE . "?controller=approvisionnement&view=approvisionnement_list");
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
                $approvisionnement = [
                    "dateAP" => $_SESSION['selection']['dateAP'],
                    "idF" =>  $_SESSION['selection']['idF'],
                    "categorie" => $_SESSION['selection']['categorieAC'],
                    "prixAP" => $prixAP,
                    "quantiteAP" => $value['quantiteAP'] + $quantiteAP,
                    "produitAP" => $produitAP,
                    "montantAP" => (int) $prixAP * (int) ($value['produitAP'] + $quantiteAP)
                ];
                unset($array[$key]);
            } else {
                $approvisionnement = getArray($data);
            }
        }
    } else {
        $array = [];
        $approvisionnement = getArray($data);
    }
    array_push($array, $approvisionnement);

    $_SESSION["array"] = $array;

    header("Location:" . WEB_ROUTE . "?controller=approvisionnement&view=approvisionnement");
}
function getArray($post)
{
    extract($post);
    return  [
        "dateAP" => $_SESSION['selection']['dateAP'],
        "fournisseur" =>  $_SESSION['selection']['idF'],
        "categorie" => $_SESSION['selection']['categorieAC'],
        "prixAP" => $prixAP,
        "quantiteAP" => $quantiteAP,
        "produitAP" => $produitAP,
        "montantAP" => (int) $prixAP * (int) $quantiteAP
    ];
}
function show_all_approvisionnement()
{
    if (isset($_GET['OK'])) {
        $approvisionnementlist = filtre_by_appro($_GET['recherche']);
        return $approvisionnementlist;
        /* require_once(ROUTE_DIR . 'view/fournisseur/fournisseur_list.html.php'); */
    } else {
        $approvisionnementlist = get_all_approvisionnement_db();
        return $approvisionnementlist;
        /*         require_once(ROUTE_DIR . 'view/fournisseur/fournisseur_list.html.php');
 */
    }
}
