<?php 
$title = "Editer votre annonce";
require_once '../../functions/db.php';
require_once '../../functions/edit.php';
require_once '../../layout/header.php';
require_once '../../functions/listeBien.php';

$id_users = $_SESSION['user_id'];
$myAnnonce = getMyAnnonce($id_users);

foreach ($myAnnonce as $annonce){
    $id_add = $annonce['id'];
    $photos = getAnnonce($id_add);
    $photo = $photos['photo'];
    $photo = explode (";", $photo);
    $photo = $photo[0]?>

    

<a type="button" class="btn" href="pageAnnonce.php?id=<?php echo $annonce['id']; ?>" style="width:620px";>
<div class="card mb-3" >
  <div class="row no-gutters">
    <div class="col-md-4">
    <?php echo "<img src='/../img/annonce/".$photo."' alt='".$photo."' class='card-img-top'/>"; ?> 
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><h5 class="card-title"><?php echo $annonce['titre'] ?></h5>
        <p class="card-text"><small class="text-muted"><?php echo $annonce['nb_voyageurs'] ?> voyageurs · <?php echo $annonce['nb_chambre'] ?> lit |</small> <?php echo $annonce['prix'] ?>€/nuit</p>
      </div>
    </div>
  </div>
</div>
</a>
<!-- <a href="../editAnnonce.php?id=<?php echo $annonce['id']; ?>" class="btn btn-dark">Modifier</a>
  <a href="../suppr.php?id=<?php echo $annonce['id']; ?>" class="btn btn-warning">Supprimer</a> --> 
 

<?php }
require_once '../../layout/footer.php'; ?>