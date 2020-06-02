<?php
$title = "Connexion";
$css ="css/login.css";
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

<?php if ($verif) { ?>
  <div class="alert alert-danger" role="alert">
    Mauvais identifiants bogoss
    <?php $_SESSION = []; ?>
  </div>
<?php } ?>

<form method="POST">
  <div class="container">
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Email ..."/>
   </div>
   <div class="form-group">
     <label for="password">Mot de passe</label>
     <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe..." />
   </div>
   <button type="submit" class="btn">Connexion</button>
  </div>
</form>

</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>

