<?php
session_start(); // formule pour initialiser une session
require_once '../layout/header.php';
require_once '../functions/db.php';
require_once '../functions/redirect.php';

$pdo = getPdo();
$email = ""; // Quoi qu'il arrive, $email sera toujours initialisée à une chaîne vide
$verif = false;

if (!empty($_POST['email']) && !empty($_POST['password'])) {// bien y mettre en post sinon les identifiants apparaissent dans l'url
  $password = $_POST['password'];
  $email = $_POST['email'];
  // Une fois l'utilisateur a rentre ses coordonnees on les assigne a nos variables, la plus importante étant le email qu'on va chercher dans la bdd et qu'on peut afficher sur les pages pour vérifier que c'est bel et bien cet user qui est co

  $query = "SELECT * FROM users WHERE email = :email"; // chercher une correspondance dans la bdd
  $stmt = $pdo->prepare($query);// tjr préparé c'est mieux
  $stmt->execute([
    'email' => $email
  ]);

  $row = $stmt->fetch(PDO::FETCH_ASSOC);// on ne veut que la ligne de mon utilisateur

  if ($row && password_verify($password, $row['password'])) {
    $_SESSION['state'] = 'connected';
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['user_is_hote'] = $row['is_hote'];
    redirect('/public'); // l'utilisateur est connecté et est redirigé la ou il a les droits
  } else {
    $verif = true; // si il n'a pas reussi a se connecter $verif devient true et active le if qui suit pour l'en informer
  }
}
?>
<h1>Connexion</h1>
<h4>Mets les bons identifiants bogoss</h4>

<?php if ($verif) { ?>
  <div class="alert alert-danger" role="alert">
    Mauvais identifiants bogoss
    <?php $_SESSION = []; ?>
  </div>
<?php } ?>

<form method="POST">
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Email ..."/>
  </div>
  <div class="form-group">
    <label for="password">Mot de passe</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe..." />
  </div>
  <button type="submit" class="btn btn-primary">Connexion</button>
</form>

<?php require_once '../layout/footer.php'; ?>