<?php

function ajout_categorieconfection_db(array $categorieconfection) {
    $conn = get_connection();
    try {
        $sql = "INSERT INTO categorieconfection(libelleCC) VALUES(:libelleCC)";
        $stmt = $conn->prepare($sql);
        $stmt->execute($categorieconfection);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function edit_categorieconfection_db(array $categorieconfection) {
    $conn = get_connection();
    try {
        //var_dump($categorieconfection);die;
        $sql = "UPDATE categorieconfection SET libelleCC=:libelleCC WHERE idCC=:idCC";
        $stmt = $conn->prepare($sql);
        $stmt->execute($categorieconfection);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function get_all_categorieconfection_db() {
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM categorieconfection";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de categorieconfection
    return $stmt->fetchAll();
}

function get_categorieconfection_by_id_bd(int $idCC) {
    $conn = get_connection();
    $sql = "SELECT * FROM categorieconfection WHERE idCC =:idCC";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['idCC' => $idCC]);
    $conn = null;
    return $stmt->fetch();
}
function supprimer($idCC) {
    $conn = get_connection();
    try {
        $sql = "DELETE FROM categorieconfection WHERE idCC=:idCC";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($idCC));
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}
// Desactive une categorieconfection dans la bd (Supprimer)

function get_categorieconfection_by_idCC_db(int $idCC) {
    $conn = get_connection();
    try {
        $sql = "DELETE FROM categorieconfection WHERE idCC=:idCC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':idCC' => $idCC]);
        return get_all_categorieconfection_db();
    } catch (\Throwable $th) {
        return false;
    }
}
//-----------------------------------------------------------//
