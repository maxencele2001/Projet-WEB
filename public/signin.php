<?php require_once '../layout/header.php'; 
require_once '../functions/db.php';
require_once '../functions/redirect.php';?>


<form method="POST" enctype="multipart/form-data">
    <div class="container">
    <input type="file" name="profilePic" />
    <div class="form-group">
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
function inscrire(string $nom,string $prenom, string $password, string $email, string $profilePic, bool $is_hote): bool
{
  $pdo = getPdo();// recup de ma bdd
  
  $query = "INSERT INTO users (nom, prenom, password, email, profilePic, is_hote) VALUES (:nom, :prenom, :password, :email, :profilePic, :is_hote)";// formule pour l'ajout
  $stmt = $pdo->prepare($query);
  return $stmt->execute([
    'nom' => $nom,
    'prenom' => $prenom,
    'password' => password_hash($password, PASSWORD_BCRYPT, ['cost'=> 10]),
    'email' => $email,
    'profilePic' => $profilePic,
    'is_hote' => $is_hote

  ]);
}

function inscrire2(string $nom,string $prenom, string $password, string $email, string $profilePic): bool
{
  $pdo = getPdo();// recup de ma bdd
  
  $query = "INSERT INTO users (nom, prenom, password, email, profilePic, is_hote) VALUES (:nom, :prenom, :password, :email, :profilePic, 0)";// formule pour l'ajout
  $stmt = $pdo->prepare($query);
  return $stmt->execute([
    'nom' => $nom,
    'prenom' => $prenom,
    'password' => password_hash($password, PASSWORD_BCRYPT, ['cost'=> 10]),
    'email' => $email,
    'profilePic'=> $profilePic
  ]);
}
?>
<?php if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password2'])){// si l'utilisateur a tout rempli, ajout à la bdd
        if ($_POST['password'] == $_POST['password2']){// verif que les 2 mdp coincident  
          if (isset($_FILES['profilePic']) && !empty($_FILES['profilePic'])) {
            // on met le fichier dans une variable pour une meilleure lisibilité
            $file = $_FILES['profilePic'];
        
            // On récupère le nom du fichier
            $profilePic = $file['name'];
        
            // On construit le chemin de destination
            $destination = __DIR__ . "/img/" . $profilePic;
        
            // On bouge le fichier temporaire dans la destination
            if (move_uploaded_file($file['tmp_name'], $destination)) {
              echo $profilePic . " correctement enregistré<br />";
            }
            
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $password = $_POST['password'];
            $email = $_POST['email'];
              if(!empty($_POST['is_hote'])){
                $ajout = inscrire($nom,$prenom,$password,$email,$profilePic,1);
                echo("oui");
              }else{
              $ajout = inscrire2($nom,$prenom,$password,$email,$profilePic);
            }
            redirect('/login.php');
        }
      }
      
        else{?>
          <div class="alert alert-danger" role="alert">
            Mots de passe différents
          </div><?php
        }
    }?>

<?php require_once '../layout/footer.php'; ?>