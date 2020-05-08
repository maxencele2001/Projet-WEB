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

function updateAnnonce(string $titre,string $adresse,string $description,int $nb_voyageurs,int $nb_chambre,int $prix,string $photobdd,int $id_annonce) {
  $pdo=getPdo();
  $query= "UPDATE annonces SET titre=:titre, adresse=:adresse, description=:description, nb_voyageurs=:nb_voyageurs, nb_chambre=:nb_chambre, prix=:prix, photo=:photo WHERE id=:id;";
  $stmt = $pdo->prepare($query);
    return $stmt->execute(array(
    'titre' => $titre,
    'adresse' => $adresse,
    'description' => $description,  
    'nb_voyageurs' => $nb_voyageurs,
    'nb_chambre' => $nb_chambre,
    'prix' => $prix,
    'photo' => $photobdd,
    'id' => $id_annonce
    ));
};

function updateSoldeClient(int $solde, int $id_users){
  $pdo = getPdo();
  $query = "UPDATE users SET solde=:solde WHERE id=:id";
  $stmt = $pdo->prepare($query);
  return $stmt->execute(array(
    'solde'=>$solde,
    'id'=>$id_users,
  ));
};

function getSolde_client(int $id){
  $pdo = getPdo();
  $query = "SELECT solde FROM users WHERE id=:id";
  $stmt = $pdo->prepare($query);
  $stmt->execute([
    'id'=> $id,
  ]);
  return $solde_client = $stmt->fetch(PDO::FETCH_ASSOC);
};

function getSolde_hote(int $id_hote){
  $pdo = getPdo();
  $query = "SELECT solde FROM users WHERE id=:id";
  $stmt = $pdo->prepare($query);
  $stmt->execute([
    'id'=> $id_hote,
  ]);
  return $solde_hote = $stmt->fetch(PDO::FETCH_ASSOC);
};

function getId_hote(int $id_annonce){
  $pdo = getPdo();
  $query = "SELECT id_users FROM annonces WHERE id=:id";
  $stmt = $pdo->prepare($query);
  $stmt->execute([
    'id'=> $id_annonce,
  ]);
  return $id_hote = $stmt->fetch(PDO::FETCH_ASSOC);
};
function updateSoldeHote(int $solde, int $id_hote){
  $pdo = getPdo();
  $query = "UPDATE users SET solde=:solde WHERE id=:id";
  $stmt = $pdo->prepare($query);
  return $stmt->execute(array(
    'solde'=>$solde,
    'id'=>$id_hote,
  ));
};
