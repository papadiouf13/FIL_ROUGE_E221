<?php
function ajout_fournisseur_db(array $fournisseur)
{
    $conn = get_connection();

    try {
        //var_dump($fournisseur);die;
        $sql = "INSERT INTO fournisseur(prenom,nom,telephonePort,telephonefixe,adresse,photoF) VALUES(:prenom,:nom,:telephonePort,:telephonefixe,:adresse,:photoF)";
        $stmt = $conn->prepare($sql);
        //bindParam permet de lier les parametres donnees aux données qui doivent etre inserer dans la base de données
        $stmt->bindParam(':prenom', $fournisseur['prenom']);
        $stmt->bindParam(':nom', $fournisseur['nom']);
        $stmt->bindParam(':telephonePort', $fournisseur['telephonePort']);
        $stmt->bindParam(':telephonefixe', $fournisseur['telephonefixe']);
        $stmt->bindParam(':adresse', $fournisseur['adresse']);
        $stmt->bindParam(':photoF', $fournisseur['photoF']);

        $stmt->execute($fournisseur);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function edit_fournisseur_db(array $fournisseur)
{

    $conn = get_connection();
    try {
        $sql = "UPDATE fournisseur SET nom=:nom,prenom=:prenom,telephonePort=:telephonePort,telephonefixe=:telephonefixe,adresse=:adresse,photoF=:photoF WHERE idF=:idF";
        $stmt = $conn->prepare($sql);

        $stmt->execute($fournisseur);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function get_all_fournisseur_db()
{
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM fournisseur";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de categorieconfection
    return $stmt->fetchAll();
}

function get_fournisseur_by_id_bd(int $idF)
{
    $conn = get_connection();
    $sql = "SELECT * FROM fournisseur WHERE idF =:idF";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['idF' => $idF]);
    $conn = null;
    return $stmt->fetch();
}
// Desactive une categorieconfection dans la bd (Supprimer)

function get_fournisseur_by_idF_db(int $idF)
{
    $conn = get_connection();
    try {
        $sql = "DELETE FROM fournisseur WHERE idF=:idF";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':idF' => $idF]);
        return get_all_fournisseur_db();
    } catch (\Throwable $th) {
        return false;
    }
}

function filtre_by_prenom($filtre): array
{
    $conn = get_connection();
    $stmt =$conn->prepare("SELECT * FROM fournisseur WHERE prenom LIKE '%".$filtre."%' OR nom LIKE '%".$filtre."%' ");
    $stmt->execute();
    return $stmt->fetchAll();
}
// fonction filtrer dans le model , puis aller dans le view et tester sur le [get] , 
/* 

function pagination(array $depart,$nbreElementPage)
{
   $conn = get_connection();
    $sql = "SELECT * FROM fournisseur ORDER BY (idF) DESC LIMIT {$depart},{$nbreElementPage}";
    $stmt = $conn->query($sql);
    $conn = null;
    return $stmt->fetchAll();
}
function count_all_fournisseur_db()
{
    $conn = get_connection();
    $sql = "SELECT COUNT(idF) as compte FROM fournisseur";
    $stmt = $conn->query($sql);
    $conn = null;
    return $stmt->fetchAll();
} */

function get_list_per_page(array $list, int $page, int $nbrElementPerPage) {
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

function get_nbrpage(array $list, int $nbrElementPerPage) {
    $totalElement = count($list);
    return ceil($totalElement/$nbrElementPerPage);
}
