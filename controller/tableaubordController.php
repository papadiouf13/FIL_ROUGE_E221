<?php

if ($_SERVER['REQUEST_METHOD']=='GET') {
	if (isset($_GET['view'])) {
	   if ($_GET['view']=='tableaubord') {
		
		$page = 1;
		if (isset($_GET['page'])) {
			$page = (int)$_GET['page'];
		}
		$totalList = get_all_utilisateur_db();
		$user = get_list_per_page($totalList,$page, 4);
		$nbrPage = get_nbrpage($totalList, 4);
	    require(ROUTE_DIR.'view/tableaubord/tableaubord.html.php');
	   }/* elseif($_GET['view']=='inscription')  {
	    require(ROUTE_DIR.'view/security/inscription.html.php');
	   } */
	   elseif($_GET['view']=='dehors')  {
	       deconnexion();
	   }
	}else {
	    // require(ROUTE_DIR.'view/bien/catalogue.html.php');
	    require(ROUTE_DIR.'view/security/connexion.html.php');
	}
}elseif ($_SERVER['REQUEST_METHOD']=='POST') {
	if (isset($_POST['action'])) {
		if ($_POST['action']=='connexion') {
			connexion($_POST['login'], $_POST['password']);
		}
	} else {
		// require(ROUTE_DIR.'view/bien/catalogue.html.php');
		require(ROUTE_DIR.'view/security/connexion.html.php');
	    }
}