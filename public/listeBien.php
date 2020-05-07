<?php //faire un foreach de tous les biens et mettre la card entiere en href plus pratique
require_once '../functions/listeBien.php';
$liste = getListe();
foreach ($liste as $annonce){
$id_add = $annonce['id'];
$photos = getAnnonce($id_add);
$photo = $photos['photo'];
$photo = explode (";", $photo);
$photo = $photo[0]?>
<div class="card mb-3" style="max-width: 540px;">
  <div class="row no-gutters">
    <div class="col-md-4">
    <?php echo "<img src='img/annonce/".$photo."' alt='".$photo."' class='card-img'/>"; ?>
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?php echo $annonce['titre'] ?></h5>
        <p class="card-text"><?php echo $annonce['adresse'] ?></p>
        <p class="card-text"><a href="pageAnnonce.php?id=<?php echo $annonce['id']; ?>" class="btn btn-warning">Voir</a></p>
      </div>
    </div>
  </div>
</div>
<?php } 