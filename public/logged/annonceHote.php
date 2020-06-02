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



<a type="button" class="btn" href="pageAnnonce.php?id=<?php echo $annonce['id']; ?>";>
<div class="card" style="width: 18rem;">
  <?php echo "<img src='/../img/annonce/".$photo."' alt='".$photo."' class='card-img-top'/>"; ?>
  <div class="card-body">
    <h5 class="card-title"><h5 class="card-title"><?php echo $annonce['titre'] ?></h5>
    <p class="card-text"><small class="text-muted"><?php echo $annonce['nb_voyageurs'] ?> voyageurs · <?php echo $annonce['nb_chambre'] ?> lit |</small> <?php echo $annonce['prix'] ?>€/nuit</p></p>
    <p>
      <a href="../suppr.php?id=<?php echo $annonce['id']; ?>" class="btn btn-warning">Supprimer</a> 
      <a href="../editAnnonce.php?id=<?php echo $annonce['id']; ?>" class="btn btn-dark">Modifier</a> 
    </p>
  </div>
</div>
</a>

<?php }
require_once '../../layout/footer.php'; ?>