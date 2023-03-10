<?php
function ajout_client_db(array $client)
{
    $conn = get_connection();

    try {
        //var_dump($client);die;
        $sql = "INSERT INTO client (prenomC,nomC,telephoneC,adresseC,photoC) VALUES(:prenomC,:nomC,:telephoneC,:adresseC,:photoC)";
        $stmt = $conn->prepare($sql);
        //bindParam permet de lier les parametres donnees aux données qui doivent etre inserer dans la base de données
        $stmt->bindParam(':prenomC', $client['prenomC']);
        $stmt->bindParam(':nomC', $client['nomC']);
        $stmt->bindParam(':telephoneC', $client['telephoneC']);
        $stmt->bindParam(':adresseC', $client['adresseC']);
        $stmt->bindParam(':photoC', $client['photoC']);

        $stmt->execute($client);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function edit_client_db(array $client)
{

    $conn = get_connection();
    try {
        $sql = "UPDATE client SET nomC=:nomC,prenomC=:prenomC,telephoneC=:telephoneC,adresseC=:adresseC,photoC=:photoC WHERE idC=:idC";
        $stmt = $conn->prepare($sql);

        $stmt->execute($client);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function get_all_client_db()
{
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM client";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de categorieconfection
    return $stmt->fetchAll();
}

function get_client_by_id_bd(int $idC)
{
    $conn = get_connection();
    $sql = "SELECT * FROM client WHERE idC =:idC";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['idC' => $idC]);
    $conn = null;
    return $stmt->fetch();
}
// Desactive une categorieconfection dans la bd (Supprimer)

function get_client_by_idC_db(int $idC)
{
    $conn = get_connection();
    try {
        $sql = "DELETE FROM client WHERE idC=:idC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':idC' => $idC]);
        return get_all_client_db();
    } catch (\Throwable $th) {
        return false;
    }
}

function filtre_by_prenoom($filtre): array
{
    $conn = get_connection();
    $stmt =$conn->prepare("SELECT * FROM client WHERE prenomC LIKE '%".$filtre."%' OR nomC LIKE '%".$filtre."%' ");
    $stmt->execute();
    return $stmt->fetchAll();
}
// fonction filtrer dans le model , puis aller dans le view et tester sur le [get] , 
/* 

function pagination(array $depart,$nbreElementPage)
{
   $conn = get_connection();
    $sql = "SELECT * FROM client ORDER BY (idC) DESC LIMIT {$depart},{$nbreElementPage}";
    $stmt = $conn->query($sql);
    $conn = null;
    return $stmt->fetchAll();
}
function count_all_client_db()
{
    $conn = get_connection();
    $sql = "SELECT COUNT(idC) as compte FROM client";
    $stmt = $conn->query($sql);
    $conn = null;
    return $stmt->fetchAll();
} */

function get_list_per_pagee(array $list, int $page, int $nbrElementPerPage) {
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

function get_nbrpagee(array $list, int $nbrElementPerPage) {
    $totalElement = count($list);
    return ceil($totalElement/$nbrElementPerPage);
}
