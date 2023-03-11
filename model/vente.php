<?php
function ajout_vente_db(array $newvente) {
    $conn = get_connection();

    try {
        //var_dump($fournisseur);die;
        $sql = "INSERT INTO vente (montantV,idC,dateV,idU) VALUES (:montantV,:idC,:dateV,:idU)";
        $stmt = $conn->prepare($sql);
        //bindParam permet de lier les parametres donnees aux données qui doivent etre inserer dans la base de données
        $stmt-> bindParam(':montantV', $newvente['montantV']);
        $stmt-> bindParam(':idC', $newvente['idC']);
        $stmt-> bindParam(':dateV', $newvente['dateV']);
        $stmt-> bindParam(':idU', $newvente['idU']);
        $stmt->execute($newvente);
/* var_dump($lastId);
die(); */
   
        return $conn->lastInsertId();
    } catch (\Throwable $th) {
        return false;
    }

}
function ajout_articledeventevente_db(array $vente) {
    $conn = get_connection();

    try {
        $sql = "INSERT INTO articledeventevente (idV,idAV,quantiteAP) VALUES(:idV,:idAV,:quantiteAP)";
        $stmt = $conn->prepare($sql);
        //bindParam permet de lier les parametres donnees aux données qui doivent etre inserer dans la base de données
        $stmt-> bindParam(':idV', $vente['idV']);
        $stmt-> bindParam(':idAV', $vente['idAV']);
        $stmt-> bindParam(':quantiteAP', $vente['quantiteAP']);
        $stmt->execute($vente);
        
   
        return true;
    } catch (\Throwable $th) {
        return false;
    }

}
function edit_vente_db(array $vente) {

    $conn = get_connection();
    try {
        $sql = "UPDATE fournisseur SET nom=:nom,prenom=:prenom,telephonePort=:telephonePort,telephonefixe=:telephonefixe,adresse=:adresse,photoF=:photoF WHERE idF=:idF";
        $stmt = $conn->prepare($sql);
        
        $stmt->execute($vente);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function get_all_vente_db() {
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM vente";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de categorieconfection
    return $stmt->fetchAll();
}

function get_vente_by_id_bd(int $idV) {
    $conn = get_connection();
    $sql = "SELECT * FROM vente WHERE idV =:idV";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['idV' => $idV]);
    $conn = null;
    return $stmt->fetch();
}
// Desactive une categorieconfection dans la bd (Supprimer)

function get_vente_by_idV_db(int $idV) {
    $conn = get_connection();
    try {
        $sql = "DELETE FROM vente WHERE idV=:idV";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':idV' => $idV]);
        return get_all_vente_db();
    } catch (\Throwable $th) {
        return false;
    }
}
function filtre_by_vente($filtre): array
{
    $conn = get_connection();
    $stmt =$conn->prepare("SELECT * FROM vente WHERE idF LIKE '%".$filtre."%' OR dateAP LIKE '%".$filtre."%' ");
    $stmt->execute();
    return $stmt->fetchAll();
}
function selection_categorie_vente(int $idCAV) {
    $conn = get_connection();
    $sql = "SELECT * FROM categoriearticlevente c , articlevente a WHERE a.idCAV = c.idCAV AND a.idCAV=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$idCAV]);
    $conn = null;
    return $stmt->fetchAll();
}
function detail_produit_vente(int $idV) {
    $conn = get_connection();
    $sql = "SELECT * FROM articledeventevente aa, articlevente ac,vente a
    where aa.idAV=ac.idAV and aa.idV=a.idV and a.idV=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$idV]);
    $conn = null;
    return $stmt->fetchAll();
}