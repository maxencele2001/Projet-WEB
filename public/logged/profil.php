<?php require_once '../../functions/db.php';
require_once '../../functions/edit.php';
require_once '../../layout/header.php';

$id = $_SESSION['user_id'];
$profil = getProfil($id); ?>

<div class="card" style="width: 18rem;">
  <img src="../img/<?php echo $profil['profilePic']?>" class="card-img-top" alt="profilePic">
  <div class="card-body">
    <h4 class="card-title">Titre : <?php if($profil['is_hote']==1){
      echo "Hôte";
    }else{
      echo "Client";
    }
    ?></h4>
    <h5 class="card-title"><?php echo $profil['nom']?> <?php echo $profil['prenom']?></h5>
    <p class="card-text"><?php echo $profil['email']?> </p>
    <a href="#" class="btn btn-primary">Modifier le profil</a>
  </div>
</div>