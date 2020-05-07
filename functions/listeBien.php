<?php 
require_once __DIR__ . '/db.php';

function getListe():array{
    $pdo=getPdo();
    $query = 'SELECT * FROM annonces';
    $stmt = $pdo->prepare($query);
    $stmt = $pdo->query($query);
    return $stmt -> fetchAll(PDO::FETCH_ASSOC);
}

function getAnnonce(int $id): ?array
{
  $pdo = getPdo();
  $query = "SELECT * FROM annonces WHERE id = :id";
  $stmt = $pdo->prepare($query);
  $stmt->execute(['id' => $id]);

  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!$row) {
    return null;
  }

  return $row;
}

function getMyAnnonce(int $id_users):array{
  $pdo = getPdo();
  $query = "SELECT * FROM annonces WHERE id_users = :id_users";
  $stmt = $pdo->prepare($query);
  $query = $stmt->execute(['id_users' => $id_users]);
  return $stmt->fetchAll(PDO::FETCH_ASSOC); 
}

function updateAnnonce($titre,$adresse,$description,$nb_voyageurs,$nb_chambre,$prix,$photobdd,$id):bool{
  $pdo=getPdo();
  $query= "UPDATE annonces SET titre= :titre, adresse= :adresse, description= :description, nb_voyageurs= :nb_voyageurs, nb_chambre= :nb_chambre, prix= :prix, photo= :photo WHERE id=:id";
  $stmt = $pdo->prepare($query);
    return $stmt->execute([
    'titre' => $titre,
    'adresse' => $adresse,
    'description' => $description,  
    'nb_voyageurs' => $nb_voyageurs,
    'nb_chambre' => $nb_chambre,
    'prix' => $prix,
    'photo' => $photobdd,
    'id' => $id,
    ]);
}


