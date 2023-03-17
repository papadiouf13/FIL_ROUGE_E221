<?php

 function ajout_productionvente_db(array $productionvente) {
    $conn = get_connection();
    try {
        $sql = "INSERT INTO productionarticlevente (datePAV, observationPAV, quantitePAV,idAV) VALUES(:datePAV, :observationPAV, :quantitePAV, :idAV)";
        $stmt = $conn->prepare($sql);
        $stmt->execute($productionvente);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function edit_productionvente_db(array $productionvente) {
    $conn = get_connection();
    try {
        $sql = "UPDATE productionarticlevente SET datePAV=:datePAV,observationPAV=:observationPAV,quantitePAV=:quantitePAV,idAV=:idAV WHERE idPAV=:idPAV";
        $stmt = $conn->prepare($sql);
        $stmt->execute($productionvente);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function get_all_productionvente_db() {
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM productionarticlevente";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de categorieconfection
    return $stmt->fetchAll();
}

function get_productionvente_by_id_bd(int $idPAV) {
    $conn = get_connection();
    $sql = "SELECT * FROM productionarticlevente WHERE idPAV =:idPAV";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['idPAV' => $idPAV]);
    $conn = null;
    return $stmt->fetch();
}
/* function filtre_by_libellevente($libelleAV): array
{
    $conn = get_connection();
    $stmt =$conn->prepare("SELECT * FROM productionvente WHERE libelleAV=?");
    $stmt->execute(array($libelleAV));
    return $stmt->fetchAll();
} */
function filtre_by_productionvente($filtre): array
{
    $conn = get_connection();
    $stmt =$conn->prepare("SELECT * FROM productionarticlevente WHERE quantitePAV LIKE '%".$filtre."%'");
    $stmt->execute();
    return $stmt->fetchAll();
}
function get_productionvente_by_idAV_db(int $idPAV)
{
    $conn = get_connection();
    try {
        $sql = "DELETE FROM productionarticlevente WHERE idPAV=:idPAV";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':idPAV' => $idPAV]);
        return get_all_productionvente_db();
    } catch (\Throwable $th) {
        return false;
    }
}
