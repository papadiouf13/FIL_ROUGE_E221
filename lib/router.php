<?php
if (isset($_REQUEST['controller'])) {
    if($_REQUEST['controller'] == "connexion") {
        require_once(ROUTE_DIR.'controller/securityController.php');
    }elseif($_REQUEST['controller'] == "deconnexion") {
        require_once(ROUTE_DIR.'controller/securityController.php');
    }
    elseif($_REQUEST['controller'] == "categorieController") {
        require_once(ROUTE_DIR.'controller/categorieController.php');
    }elseif($_REQUEST['controller'] == "fournisseur") {
        require_once(ROUTE_DIR.'controller/fournisseurController.php');
    }elseif($_REQUEST['controller'] == "approvisionnement") {
        require_once(ROUTE_DIR.'controller/approvisionnementController.php');
    }elseif($_REQUEST['controller'] == "vente") {
        require_once(ROUTE_DIR.'controller/venteController.php');
    }elseif($_REQUEST['controller'] == "client") {
        require_once(ROUTE_DIR.'controller/clientController.php');
    } elseif ($_REQUEST['controller'] == "articleConfectionController") {
        require_once(ROUTE_DIR.'controller/articleConfectionController.php');
    } elseif ($_REQUEST['controller'] == "catventeController") {
        require_once(ROUTE_DIR.'controller/catventeController.php');
    } elseif ($_REQUEST['controller'] == "articleVenteController") {
        require_once(ROUTE_DIR.'controller/articleVenteController.php');
    }
}else {
   require_once(ROUTE_DIR.'controller/securityController.php');
}


/*if (isset($_REQUEST['controller'])) {
    
}else {
    require_once(ROUTE_DIR.'view/fournisseur/fournisseur_add.html.php');
}

if (isset($_REQUEST['controller'])) {
    if($_REQUEST['controller'] == "approvisionnement") {
        require_once(ROUTE_DIR.'controller/approvisionnementController.php');
    }
}else {
    require_once(ROUTE_DIR.'view/approvisionnement/approvisionnement_add.html.php');
}*/