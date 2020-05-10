<?php //faire un foreach de tous les biens et mettre la card entiere en href plus pratique
require_once '../functions/listeBien.php';?>




<form method="POST">
<input class="form-control" type="date" name="date">
<input class="form-control" type="date" name="date2">
<input type="text" name="ville" id="ville">
<input type="number" name="prixmin" id="prixmin" min="0">
<input type="number" name="prixmax" id="prixmax" min="0">
<input type="submit" value="Envoyer" />
</form>






<?php
$prixmin = null;
$prixmax = null;
$ville = null;

/*if(isset($_POST['date']) && isset($_POST['date2'])){
  $date = $_POST['date'];
  $date2 = $_POST['date2'];
  var_dump($_POST);
  $liste=verif_reserve($date,$date2);
  var_dump($liste['id_annonce']);
  $id_add
}*/

/*if(isset($_POST['ville'])){
  $ville = $_POST['ville'];
  $liste=getListe($prixmin,$prixmax,$ville);
}*/

if(isset($_POST['prixmin']) && isset($_POST['prixmax']) && isset($_POST['ville'])){
  $prixmin = $_POST['prixmin'];
  $prixmax = $_POST['prixmax'];
  $ville = $_POST['ville'];
  #var_dump($_POST);
  $liste = getListe(intval($prixmin),intval($prixmax),$ville);
  var_dump($liste);
}else{
  $liste = getListe($prixmin,$prixmax,$ville);
}




#$liste = getListe();
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