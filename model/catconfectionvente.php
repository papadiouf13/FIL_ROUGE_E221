<?php

function ajout_categorieconfectionvente_db(array $categorieconfectionvente) {
    $conn = get_connection();
    try {
        $sql = "INSERT INTO categoriearticlevente(libelleCAV) VALUES(:libelleCAV)";
        $stmt = $conn->prepare($sql);
        $stmt->execute($categorieconfectionvente);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function edit_categorieconfectionvente_db(array $categorieconfectionvente) {
    $conn = get_connection();
    try {
        //var_dump($categorieconfection);die;
        $sql = "UPDATE categoriearticlevente SET libelleCAV=:libelleCAV WHERE idCAV=:idCAV";
        $stmt = $conn->prepare($sql);
        $stmt->execute($categorieconfectionvente);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function get_all_categorieconfectionvente_db() {
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM categoriearticlevente";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de categorieconfection
    return $stmt->fetchAll();
}

function get_categorieconfectionvente_by_id_bd(int $idCAV) {
    $conn = get_connection();
    $sql = "SELECT * FROM categoriearticlevente WHERE idCAV =:idCAV";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['idCAV' => $idCAV]);
    $conn = null;
    return $stmt->fetch();
}
function supprimerr($idCAV) {
    $conn = get_connection();
    try {
        $sql = "DELETE FROM categoriearticlevente WHERE idCAV=:idCAV";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($idCAV));
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}
// Desactive une categorieconfection dans la bd (Supprimer)

function get_categorieconfectionvente_by_idCAV_db(int $idCAV) {
    $conn = get_connection();
    try {
        $sql = "DELETE FROM categoriearticlevente WHERE idCAV=:idCAV";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':idCAV' => $idCAV]);
        return get_all_categorieconfectionvente_db();
    } catch (\Throwable $th) {
        return false;
    }
}
//-----------------------------------------------------------//
