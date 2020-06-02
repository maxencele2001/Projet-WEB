<?php 
$title = "Annonce supprimée";
require_once '../layout/header.php'; 
require_once '../../functions/db.php';
require_once '../../functions/redirect.php';
$id_annonce = $_GET['id'];
function deleteAdd($id_annonce){
    $pdo = getPdo();
    $query = "DELETE FROM annonces WHERE id=:id";
    $stmt = $pdo->prepare($query);
    return $stmt->execute([
        'id' => $id_annonce,
    ]);
};

deleteAdd($id_annonce);

echo("Annonce Supprimée avec succès");
#redirect('/logged/editAnnonce.php');