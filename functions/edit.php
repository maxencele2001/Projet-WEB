<?php require_once __DIR__ . 'db.php';

function updateProfil(int $id, string $password, string $email, bool $is_hote):bool{
    $pdo=getPdo();
    $query= "UPDATE voiture SET password= :password, email= :email, is_hote= :is_hote WHERE id=:id";
    $stmt = $pdo->prepare($query);
    return $stmt->execute([
        ':password' => $password,
        ':email' => $email,
        ':is_hote' => $is_hote, 
        ':id' => $id
    ]);
}