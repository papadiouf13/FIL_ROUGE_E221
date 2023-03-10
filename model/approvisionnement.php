<?php
function ajout_approvisionnement_db(array $newapprovisionnement) {
    $conn = get_connection();

    try {
        //var_dump($fournisseur);die;
        $sql = "INSERT INTO approvisionnement(montantAP,idF,dateAP,idU) VALUES(:montantAP,:idF,:dateAP,:idU)";
        $stmt = $conn->prepare($sql);
        //bindParam permet de lier les parametres donnees aux données qui doivent etre inserer dans la base de données
        $stmt-> bindParam(':montantAP', $newapprovisionnement['montantAP']);
        $stmt-> bindParam(':idF', $newapprovisionnement['idF']);
        $stmt-> bindParam(':dateAP', $newapprovisionnement['dateAP']);
        $stmt-> bindParam(':idU', $newapprovisionnement['idU']);
        $stmt->execute($newapprovisionnement);
/* var_dump($lastId);
die(); */
   
        return $conn->lastInsertId();
    } catch (\Throwable $th) {
        return false;
    }

}
function ajout_approarticleconfection_db(array $approvisionnement) {
    $conn = get_connection();

    try {
        $sql = "INSERT INTO aprroarticleconfection (idAPP,idAC,quantiteAP) VALUES(:idAPP,:idAC,:quantiteAP)";
        $stmt = $conn->prepare($sql);
        //bindParam permet de lier les parametres donnees aux données qui doivent etre inserer dans la base de données
        $stmt-> bindParam(':idAPP', $approvisionnement['idAPP']);
        $stmt-> bindParam(':idAC', $approvisionnement['idAC']);
        $stmt-> bindParam(':quantiteAP', $approvisionnement['quantiteAP']);
        $stmt->execute($approvisionnement);
        
   
        return true;
    } catch (\Throwable $th) {
        return false;
    }

}
function edit_approvisionnement_db(array $approvisionnement) {

    $conn = get_connection();
    try {
        $sql = "UPDATE fournisseur SET nom=:nom,prenom=:prenom,telephonePort=:telephonePort,telephonefixe=:telephonefixe,adresse=:adresse,photoF=:photoF WHERE idF=:idF";
        $stmt = $conn->prepare($sql);
        
        $stmt->execute($approvisionnement);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function get_all_approvisionnement_db() {
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM approvisionnement";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de categorieconfection
    return $stmt->fetchAll();
}

function get_approvisionnement_by_id_bd(int $idAPP) {
    $conn = get_connection();
    $sql = "SELECT * FROM approvisionnement WHERE idAPP =:idAPP";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['idAPP' => $idAPP]);
    $conn = null;
    return $stmt->fetch();
}
// Desactive une categorieconfection dans la bd (Supprimer)

function get_approvisionnement_by_idAPP_db(int $idAPP) {
    $conn = get_connection();
    try {
        $sql = "DELETE FROM approvisionnement WHERE idAPP=:idAPP";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':idAPP' => $idAPP]);
        return get_all_approvisionnement_db();
    } catch (\Throwable $th) {
        return false;
    }
}
function filtre_by_appro($filtre): array
{
    $conn = get_connection();
    $stmt =$conn->prepare("SELECT * FROM approvisionnement WHERE idF LIKE '%".$filtre."%' OR dateAP LIKE '%".$filtre."%' ");
    $stmt->execute();
    return $stmt->fetchAll();
}
function selection_categorie(int $idCC) {
    $conn = get_connection();
    $sql = "SELECT * FROM categorieconfection c , articleconfection a WHERE a.idCC = c.idCC AND a.idCC=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$idCC]);
    $conn = null;
    return $stmt->fetchAll();
}
function detail_produit(int $idAPP) {
    $conn = get_connection();
    $sql = "SELECT * FROM aprroarticleconfection aa, articleconfection ac,approvisionnement a
    where aa.idAC=ac.idAC and aa.idAPP=a.idAPP and a.idAPP=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$idAPP]);
    $conn = null;
    return $stmt->fetchAll();
}
