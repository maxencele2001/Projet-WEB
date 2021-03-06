<?php 
$title = "Editer votre profil";
$css="";
require_once '../../functions/db.php';
require_once '../../functions/edit.php';
require_once '../../layout/header.php';
?>
<?php
@session_start();
$id = $_SESSION['user_id'];
if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password2'])){
    if ($_POST['password'] == $_POST['password2']){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $is_hote = $_POST['is_hote'];
    updateProfil($id, $password, $email,  $is_hote);
}else{?>
    <div class="alert alert-danger" role="alert">
      Mots de passe différents
    </div><?php
  }  
}
?>

<form method="POST" class="form">
    <div class="container">
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
    <label class="form-check-label" for="exampleCheck1">Je veux devenir hôte</label>
  </div>
  <button type="submit" class="btn btn-dark">Modifier</button>
</div>
</form>

<?php require_once '../../layout/footer.php';