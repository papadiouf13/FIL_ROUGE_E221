<?php

 function ajout_articleconfection_db(array $articleconfection) {
    $conn = get_connection();
    try {
        $sql = "INSERT INTO articleconfection (libelleAC, prixAC, quantiteAC, montantAC, photoAC, idCC) VALUES (:libelleAC, :prixAC, :quantiteAC, :montantAC, :photoAC, :idCC)";
        $stmt = $conn->prepare($sql);
        $stmt->execute($articleconfection);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function edit_articleconfection_db(array $articleconfection) {
    
    $conn = get_connection();
    try {
        $sql = "UPDATE articleconfection SET libelleAC=:libelleAC,prixAC=:prixAC,quantiteAC=:quantiteAC,montantAC=:montantAC,photoAC=:photoAC,idCC=:idCC WHERE idAC=:idAC";
        $stmt = $conn->prepare($sql);
        $stmt->execute($articleconfection);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function get_all_articleconfection_db() {
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM articleconfection";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de categorieconfection
    return $stmt->fetchAll();
}

function get_articleconfection_by_id_bd(int $idAC) {
    $conn = get_connection();
    $sql = "SELECT * FROM articleconfection WHERE idAC =:idAC";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['idAC' => $idAC]);
    $conn = null;
    return $stmt->fetch();
}
/* function filtre_by_libelle($libelleAC): array
{
    $conn = get_connection();
    $stmt =$conn->prepare("SELECT * FROM articleconfection WHERE libelleAC");
    $stmt->execute(array($libelleAC));
    return $stmt->fetchAll();
} */
function filtre_by_libelle($filtre): array
{
    $conn = get_connection();
    $stmt =$conn->prepare("SELECT * FROM articleconfection WHERE libelleAC LIKE '%".$filtre."%'");
    $stmt->execute();
    return $stmt->fetchAll();
}
function get_articleconfection_by_idAC_db(int $idAC)
{
    $conn = get_connection();
    try {
        $sql = "DELETE FROM articleconfection WHERE idAC=:idAC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':idAC' => $idAC]);
        return get_all_articleconfection_db();
    } catch (\Throwable $th) {
        return false;
    }
}

function get_all_categoriearticleconfection_db(int $idAC)
{
    $conn = get_connection();
    try {
        $sql = "SELECT * FROM articleconfection a , categorieconfection c WHERE a.idCC=c.idCC AND a.idAC=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($idAC));
        return get_all_articleconfection_db();
    } catch (\Throwable $th) {
        return false;
    }
}
function get_all_type_categorieconfection_db(int $idCC)
{
    $conn = get_connection();
    try {
        $sql = "SELECT * FROM articleconfection a , categorieconfection c WHERE a.idCC=c.idCC AND c.idCC=? " ;
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($idCC));
        return get_all_articleconfection_db();
    } catch (\Throwable $th) {
        return false;
    }
}