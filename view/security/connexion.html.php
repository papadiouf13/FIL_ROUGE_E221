<?php

if (isset($_SESSION['arrayEror'])) {
	$arrayError=$_SESSION['arrayEror'];
	unset($_SESSION['arrayError']);
} 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styleConnexion.css">
</head>
<body>
<div class="wrapper">
    <section class="login-container">
        <div>
            <header>
                <h2>Identification</h2>
            </header>

            <form action="" method="post">
            <input type="hidden" name="controlleur" value="security">  
		<input type="hidden" name="action" value="connexion">  
              
                <input type="text" placeholder="Nom d'utilisateur" id="username" name="login"/>
                <?php echo isset($arrayError['login']) ? $arrayError['login'] : " "  ?>
                <input type="password" id="password" name="password" placeholder="Mot de passe" />
                <?php echo isset($arrayError['password']) ? $arrayError['password'] : " "  ?>
                <button type="submit">Connexion</button>

            </form>
        </div>
    </section>
</div>
</body>
</html>