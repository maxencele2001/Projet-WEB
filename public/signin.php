<?php require_once '../layout/header.php'; 
require_once '../functions/db.php';
require_once '../functions/redirect.php';?>

<link rel="stylesheet" href="signUp.css"> 
<div class="signup" method="POST" enctype="multipart/form-data"> 
  <div class="container form">
    <form action="#">
    <div class="form-group">
      <label for="username">Photo de profil</label>
      <input type="file" name="profilePic" class="profilPic" required/>
    </div>
    <div class="form-group">
      <label for="username">Nom</label>
      <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom ..." required />
    </div>
    <div class="form-group">
      <label for="username">Prénom</label>
      <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Votre prénom ..." required />
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com" required/>
        </div>
        <div class="form-group">
          <label for="password">Mot de passe</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe ..." required/>
        </div>
        <div class="form-group">
          <label for="passwordRepeat">Confirmation de mot de passe</label>
          <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirmation ..." required />
        </div>
        <div class="form-group form-check">
          <input type="checkbox" class="form-check-input" id="is_hote" name='is_hote'>
          <label class="form-check-label" for="exampleCheck1">Je veux devenir un hôte</label>
        </div>
        <input class="btn btn--form" type="submit" value="Register" />
      </form>  
     </div>
</div>


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