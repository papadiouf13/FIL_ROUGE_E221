<?php

 function ajout_articlevente_db(array $articlevente) {
    $conn = get_connection();
    try {
        $sql = "INSERT INTO articlevente(libelleAV, prixAV, quantiteAV, montantAV, photoAV, idCAV) VALUES(:libelleAV, :prixAV, :quantiteAV, :montantAV, :photoAV, :idCAV)";
        $stmt = $conn->prepare($sql);
        $stmt->execute($articlevente);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function edit_articlevente_db(array $articlevente) {
    $conn = get_connection();
    try {
        $sql = "UPDATE articlevente SET libelleAV=:libelleAV,prixAV=:prixAV,quantiteAV=:quantiteAV,montantAV=:montantAV,photoAV=:photoAV,idCAV=:idCAV WHERE idAV=:idAV";
        $stmt = $conn->prepare($sql);
        $stmt->execute($articlevente);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function get_all_articlevente_db() {
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM articlevente";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de categorieconfection
    return $stmt->fetchAll();
}

function get_articlevente_by_id_bd(int $idAV) {
    $conn = get_connection();
    $sql = "SELECT * FROM articlevente WHERE idAV =:idAV";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['idAV' => $idAV]);
    $conn = null;
    return $stmt->fetch();
}
/* function filtre_by_libellevente($libelleAV): array
{
    $conn = get_connection();
    $stmt =$conn->prepare("SELECT * FROM articlevente WHERE libelleAV=?");
    $stmt->execute(array($libelleAV));
    return $stmt->fetchAll();
} */
function filtre_by_libellevente($filtre): array
{
    $conn = get_connection();
    $stmt =$conn->prepare("SELECT * FROM articlevente WHERE libelleAV LIKE '%".$filtre."%'");
    $stmt->execute();
    return $stmt->fetchAll();
}
function get_articlevente_by_idAV_db(int $idAV)
{
    $conn = get_connection();
    try {
        $sql = "DELETE FROM articlevente WHERE idAV=:idAV";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':idAV' => $idAV]);
        return get_all_articlevente_db();
    } catch (\Throwable $th) {
        return false;
    }
}
