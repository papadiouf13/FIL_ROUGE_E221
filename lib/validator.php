<?php
function est_vide($valeur) {
    return empty($valeur);
}

function est_entier($valeur) {
    return is_numeric($valeur);
}

function valide_libelle(array &$arrayError, string $key, $valeur) {
    if (est_vide(trim($valeur))) {
        $arrayError[$key] = "Champ obligatoire";
    }
}
// VALIDATION CONNEXION
function validation_login(string $valeur, string  $key, array &$arrayError){
    if (est_vide($valeur)) {
       $arrayError[$key] = "le login est obligatoire";
    }elseif (!is_email($valeur)) {
       $arrayError[$key] = "le login doit être un email (exemple123@gmail.com)";
    }
       
        }
    function validation_password(string $valeur, string $key , array &$arrayError, $min = 6, $max = 10){
        if (est_vide($valeur)) {
            $arrayError[$key] = "le password est obligatoire";
        }elseif ((strlen($valeur) < $min)||(strlen($valeur) > $max)) {
            $arrayError[$key] = "le password doit être compris entre $min et $max";
        }
           
    }
    function is_email($valeur):bool{
        if (filter_var($valeur, FILTER_VALIDATE_EMAIL)) {
            return true;
          }else {
            return false;
          }
}   
function form_valid($arrayError):bool{
    if (count($arrayError)==0) {
        return true;
    }
    return false;
} 
// FIN VALIDATION CONNEXION
function valide_champs(array &$arrayError, string $key, $valeur) {
    if (est_vide(trim($valeur))) {
        $arrayError[$key] = "Champ obligatoire";
    } elseif(!est_entier($valeur)) {
        $arrayError[$key] = "Veuillez saisir un nombre";
    }
}

function valide_email_regex(array &$arrayError, string $key, $valeur) {
    $pattern = "/@+\.+";
    if (est_vide(trim($valeur))) {
        $arrayError[$key] = "Champ obligatoire";
    } elseif(preg_match($pattern, $valeur) == 0) {
        $arrayError[$key] = "Veuillez saisir une adresse mail valide";
    }
}
function valide_image(array $files,string $key,array &$arrayError,$target_file):void{
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" ) {

      $arrayError[$key] = "Désolé,seuls les fichiers: JPG, JPEG, PNG & GIF sont autorisés.";

    }elseif ($files["image"]["size"] > 1000000000) {
        $arrayError[$key] = "la tailee ne doit pas depasser 500kb.";
    }
  }
?>

