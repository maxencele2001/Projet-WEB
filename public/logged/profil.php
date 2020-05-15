<?php require_once '../../functions/db.php';
require_once '../../functions/edit.php';
require_once '../../layout/header.php';

$id = $_SESSION['user_id'];
$profil = getProfil($id); ?>

<link rel="stylesheet" href="../css/profil.css"> 
<section class="profil">
      <div class="card-deck">
        <div>
        <img src="../img/<?php echo $profil['profilePic']?>" class="card-img" alt="profilePic"> 
        </div>
        <div class="card border-dark mb-3" style="max-width: 18rem;">
        <h4 class="card-title">Titre : <?php if($profil['is_hote']==1){
      echo "Hôte";
    }else{
      echo "Client";
    }
    ?></h4>
          <div class="card-body text-dark">
          <h5 class="card-title"><?php echo $profil['nom']?> <?php echo $profil['prenom']?></h5>
            <p class="card-text"><?php echo $profil['email']?> </p>
          </div>
        </div>
        <div class="card-footer bg-transparent border-success">
          <a href="editAnnonce.php/" class="btn btn-primary"> Mes annonces</a>
          <a href="editAnnonce.php/" class="btn btn-primary"> Modifier mes annonces</a>
        </div>
      </div>
    </section>

<?php require_once '../../layout/footer.php';