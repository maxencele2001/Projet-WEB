<?php 
$title = "Votre profil";
$css = "../css/profil.css";
require_once '../../functions/db.php';
require_once '../../functions/edit.php';
require_once '../../layout/header.php';

$id = $_SESSION['user_id'];
$profil = getProfil($id); ?>

<div class="card mb-3" style="max-width: 100%;">
  <div class="row no-gutters">
    <div class="col-md-4">
    <img src="../img/<?php echo $profil['profilePic']?>" class="card-img-top" alt="profilePic">
    </div>
    <div class="col-md-8">
      <div class="card-header">
        <h2>Droit : <?php if($profil['is_hote']==1){echo "Hôte";}else{echo "Client"; }?></h2> 
      </div>
      <div class="card-body">
      <h3 class="card-title"><?php echo $profil['nom']?> <?php echo $profil['prenom']?></h3>
        <h4 class="card-text"><?php echo $profil['email']?> </h4>
        <a href="editAnnonce.php/" class="btn btn-primary"> Mes annonces</a>
        <a type="button" class="btn btn-outline-dark" href="edit.php/"><i class="fas fa-user-edit"></i></a>
      </div>
    </div>
  </div>
</div>

<?php require_once '../../layout/footer.php'; ?>