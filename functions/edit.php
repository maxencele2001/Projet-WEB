<?php require_once __DIR__ . '/db.php';

function getProfil(int $id):array{
    $pdo = getPdo();
    $query = "SELECT * FROM users WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id]);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        return null;
    }

  return $row;
}
function updateProfil(int $id, string $password, string $email, bool $is_hote):bool{
    $pdo=getPdo();
    $query= "UPDATE users SET password= :password, email= :email, is_hote= :is_hote WHERE id=:id";
    $stmt = $pdo->prepare($query);
    return $stmt->execute([
        ':password' => password_hash($password, PASSWORD_BCRYPT, ['cost'=> 10]),
        ':email' => $email,
        ':is_hote' => $is_hote,
        ':id' => $id
    ]);
}