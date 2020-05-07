<?php require_once '../../functions/db.php';
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
    <div class="card mb-3" style="max-width: 540px;">
      <div class="row no-gutters">
        <div class="col-md-4">
        <?php echo "<img src='/../img/annonce/".$photo."' alt='".$photo."' class='card-img'/>"; ?>
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title"><?php echo $annonce['titre'] ?></h5>
            <p class="card-text"><?php echo $annonce['adresse'] ?></p>
            <p class="card-text"><a href="../confirmEdit.php?id=<?php echo $annonce['id']; ?>" class="btn btn-warning">Modifier</a></p>
          </div>
        </div>
      </div>
    </div>
<?php }
require_once '../../layout/footer.php'; ?>