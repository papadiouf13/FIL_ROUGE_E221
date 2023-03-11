<?php
function ajout_utilisateur_db(array $utilisateur)
{
    $conn = get_connection();

    try {
        //var_dump($utilisateur);die;
        $sql = "INSERT INTO user (prenomU,nomU,telephoneU,adresseU,salaireU,login,password,photoU,idR) VALUES(:prenomU,:nomU,:telephoneU,:adresseU,:salaireU,:login,:password,:photoU,:idR)";
        $stmt = $conn->prepare($sql);
        //bindParam permet de lier les parametres donnees aux données qui doivent etre inserer dans la base de données
        $stmt->bindParam(':prenomU', $utilisateur['prenomU']);
        $stmt->bindParam(':nomU', $utilisateur['nomU']);
        $stmt->bindParam(':telephoneU', $utilisateur['telephoneU']);
        $stmt->bindParam(':adresseU', $utilisateur['adresseU']);
        $stmt->bindParam(':photoU', $utilisateur['photoU']);
        $stmt->bindParam(':salaireU', $utilisateur['salaireU']);
        $stmt->bindParam(':login', $utilisateur['login']);
        $stmt->bindParam(':password', $utilisateur['password']);
        $stmt->bindParam(':idR', $utilisateur['idR']);
        $stmt->execute($utilisateur);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function edit_utilisateur_db(array $utilisateur)
{

    $conn = get_connection();
    try {
        $sql = "UPDATE user SET nomU=:nomU,prenomU=:prenomU,telephoneU=:telephoneU,adresseU=:adresseU,photoU=:photoU,salaireU=:salaireU,login=:login,password=:password WHERE idU=:idU";
        $stmt = $conn->prepare($sql);

        $stmt->execute($utilisateur);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function get_all_utilisateur_db()
{
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM user";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de categorieconfection
    return $stmt->fetchAll();
}
function get_all_role_db() {
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM role";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de categorieconfection
    return $stmt->fetchAll();
}

function get_utilisateur_by_id_bd(int $idU)
{
    $conn = get_connection();
    $sql = "SELECT * FROM user WHERE idU =:idU";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['idU' => $idU]);
    $conn = null;
    return $stmt->fetch();
}
// Desactive une categorieconfection dans la bd (Supprimer)

function get_utilisateur_by_idU_db(int $idU)
{
    $conn = get_connection();
    try {
        $sql = "DELETE FROM user WHERE idU=:idU";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':idU' => $idU]);
        return get_all_utilisateur_db();
    } catch (\Throwable $th) {
        return false;
    }
}

function filtre_by_preenoom($filtre): array
{
    $conn = get_connection();
    $stmt =$conn->prepare("SELECT * FROM utilisateur WHERE prenomC LIKE '%".$filtre."%' OR nomC LIKE '%".$filtre."%' ");
    $stmt->execute();
    return $stmt->fetchAll();
}
// fonction filtrer dans le model , puis aller dans le view et tester sur le [get] , 
/* 

function pagination(array $depart,$nbreElementPage)
{
   $conn = get_connection();
    $sql = "SELECT * FROM utilisateur ORDER BY (idC) DESC LIMIT {$depart},{$nbreElementPage}";
    $stmt = $conn->query($sql);
    $conn = null;
    return $stmt->fetchAll();
}
function count_all_utilisateur_db()
{
    $conn = get_connection();
    $sql = "SELECT COUNT(idC) as compte FROM utilisateur";
    $stmt = $conn->query($sql);
    $conn = null;
    return $stmt->fetchAll();
} */

function get_liste_per_pagee(array $list, int $page, int $nbrElementPerPage) {
    $totalElement = count($list);
    $nbrPage = get_nbrpage($list, $nbrElementPerPage);
    $iDepart = ($page -1) * $nbrElementPerPage;
    $iArrive = ($totalElement - $nbrPage) + $nbrElementPerPage;
    $listPerPage = array();
    for ($i=$iDepart; $i < $iDepart + $nbrElementPerPage; $i++) {
        if ($i >= $totalElement ) {
            return $listPerPage;
        } else {
            array_push($listPerPage, $list[$i]);
        }
    }

    return $listPerPage;
}

function get_nbrepagee(array $list, int $nbrElementPerPage) {
    $totalElement = count($list);
    return ceil($totalElement/$nbrElementPerPage);
}
