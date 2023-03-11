<?php
//define('WEB_ROUTE', "http://momedrone.alwaysdata.net");
define('WEB_ROUTE', "http://localhost:8000");
define("ROUTE_DIR" , str_replace('public', '', $_SERVER['DOCUMENT_ROOT']));
define("UPLOAD_DIR" , ROUTE_DIR. 'public/images/uploads/');
define("UPLOAD_CLIENT" , ROUTE_DIR. 'public/images/client/');
define('SUCCESS_MSG', "Operation effectue avec succes");
define('FAILED_MSG', "Echec de l'operation");

?>
