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