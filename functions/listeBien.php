<?php 
require_once __DIR__ . '/db.php';

function getListe(?int $prixmin = null,?int $prixmax = null,?string $ville=null){
    $pdo=getPdo();
    $query = "SELECT * FROM annonces";
    if($prixmin!== null && $prixmax !== null && $ville !== null){
      $query .= " WHERE prix BETWEEN :prixmin AND :prixmax AND adresse LIKE :adresse";
      $stmt = $pdo->prepare($query);
      $stmt->execute(array(
        'prixmin' => $prixmin,
        'prixmax' => $prixmax,
        'adresse' => "%$ville%"
      ));
    }else{
      if ($ville !== null) {
        $query .= " WHERE nom LIKE :adresse";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
          'adresse' => "%$ville%"
        ]);
      } else {
        $stmt = $pdo->query($query);
        echo("oui");
    }
    }
    return $stmt -> fetchAll(PDO::FETCH_ASSOC);
}


function verif_reserve($date,$date2){
  $pdo=getPdo();
  $query = "SELECT id_annonce FROM reservation WHERE :date BETWEEN arrivee AND depart OR :date2 BETWEEN arrivee AND depart";
  $stmt = $pdo->prepare($query);
  $stmt->execute(array(
    'date'=>$date,
    'date2'=> $date2
  ));
  return $stmt -> fetchAll(PDO::FETCH_COLUMN);
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

function getClient(int $id){
  $pdo = getPdo();
  $query = "SELECT * FROM users WHERE id=:id";
  $stmt = $pdo->prepare($query);
  $stmt->execute([
    'id'=> $id,
  ]);
  return $client = $stmt->fetch(PDO::FETCH_ASSOC);
};

function getHote(int $id_hote){
  $pdo = getPdo();
  $query = "SELECT * FROM users WHERE id=:id";
  $stmt = $pdo->prepare($query);
  $stmt->execute([
    'id'=> $id_hote,
  ]);
  return $hote = $stmt->fetch(PDO::FETCH_ASSOC);
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

function getCoup_Coeur(){
  $pdo = getPdo();
  $query = "SELECT id_annonce, COUNT(*) AS nb_reserve FROM reservation GROUP BY id_annonce HAVING nb_reserve>3 ORDER BY nb_reserve DESC LIMIT 4 ";
  $stmt = $pdo->prepare($query);
  $stmt = $pdo->query($query);
  return $stmt -> fetchAll(PDO::FETCH_COLUMN);
}
