<?php

if ($_SERVER['REQUEST_METHOD']=='GET') {
	if (isset($_GET['view'])) {
	   if ($_GET['view']=='connexion') {
	    require(ROUTE_DIR.'view/security/connexion.html.php');
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
function connexion(string $loginU, string $passwordU):void{
    //die('okkkkkkkkkkkkkkkkkk');
	
	$arrayError=array();
	
	validation_login($loginU,'loginU',$arrayError);
	validation_password($passwordU,'passwordU',$arrayError);
	
	if (form_valid($arrayError)) {
		$user=find_user_by_login_password($loginU, $passwordU);
			
		if (count($user)==0 ){
			$arrayError['erreur']='login ou password incorrect';
		    $_SESSION['arrayError']=$arrayError;
 	        header("location:".WEB_ROUTE.'?controlleurs=security&view=connexion');	
		    exit();
		}else {

			$_SESSION['userConnect']=$user;
			if ($user['libelleR']=='Gestionnaire') {
                header("Location:".WEB_ROUTE."?controller=articleVenteController&view=article_list");
			}else {
                header("location:".WEB_ROUTE.'?controlleurs=security&view=connexion');	

			}
		}
	}else {
		$_SESSION['arrayError']=$arrayError;
        header("location:".WEB_ROUTE.'?controlleurs=security&view=connexion');	
		exit();

}
}
 function deconnexion(){
	unset($_SESSION['userConnect']);
	session_destroy() ;
    header("location:".WEB_ROUTE.'?controlleur=connexion&view=connexion');	
	exit();
 }

?>