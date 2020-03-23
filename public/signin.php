<?php require_once '../layout/header.php'; 
require_once '../functions/db.php';
require_once '../functions/redirect.php';?>



<form method="POST">
    <div class="container">
    <div class="form-group"><?php //ajouter la pp ?>
    <label for="nom">Nom</label>
    <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom ..." />
  </div>
  <div class="form-group">
    <label for="prenom">Prenom</label>
    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Votre prénom ..." />
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com" />
  </div>
  <div class="form-group">
    <label for="password">Mot de passe</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe ..." />
  </div>
  <div class="form-group">
    <label for="password">Confirmation mot de passe</label>
    <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirmation ..." />
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="is_hote" name='is_hote'>
    <label class="form-check-label" for="exampleCheck1">Êtes-vous hôte ?</label>
  </div>
  <button type="submit" class="btn btn-primary">Enregistrer</button>
</div>
</form>
<?php
function inscrire(string $nom,string $prenom, string $password, string $email, bool $is_hote): bool
{
  $pdo = getPdo();// recup de ma bdd
  
  $query = "INSERT INTO users (nom, prenom, password, email, is_hote) VALUES (:nom, :prenom, :password, :email, :is_hote)";// formule pour l'ajout
  $stmt = $pdo->prepare($query);
  return $stmt->execute([
    'nom' => $nom,
    'prenom' => $prenom,
    'password' => password_hash($password, PASSWORD_BCRYPT, ['cost'=> 10]),
    'email' => $email,
    'is_hote' => $is_hote
  ]);
}
?>
<?php if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password2'])){// si l'utilisateur a tout rempli, ajout à la bdd
    if ($_POST['password'] == $_POST['password2']){// verif que les 2 mdp coincident
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $is_hote = $_POST['is_hote'];
        $ajout= inscrire($nom,$prenom,$password,$email,$is_hote);
        $_SESSION['state'] = 'connected';
        $_SESSION['user_id'] = $row['ID'];
        redirect('/public');?>
        <div class="alert alert-success" role="alert">
        Merci <?php echo($prenom) ?> pour votre inscription. Bienvenue à vous !
        </div><?php
    }
    else{?>
      <div class="alert alert-danger" role="alert">
        Mots de passe différents
      </div><?php
    }
}?>

<?php require_once '../layout/footer.php'; ?>x