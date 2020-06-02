<?php 
$title = "Trouvez votre bonheur";
$css = "../css/listeBien.css"; 
//faire un foreach de tous les biens et mettre la card entiere en href plus pratique
require_once '../functions/listeBien.php';
require_once '../layout/header.php';
?>

<form method="POST" class="recherche">

  <div class="input-group input-group-lg">

    <div class="input-group-prepend">
 
      <span class="form-control" id="inputGroup-sizing-default">€ -</span>
      <input type="number" class="form-control" name="prixmin" id="prixmin" min="0">

      <span class="form-control" id="inputGroup-sizing-default">€ +</span>
      <input type="number" class="form-control" name="prixmax" id="prixmax" min="0">

     <span class="form-control" id="inputGroup-sizing-default">Voyageurs</span>
     <input type="number" class="form-control" name="nb_voyageurs" id="nb_voyageurs" min="0">

     <span class="form-control btn-dark" id="inputGroup-sizing-default">Ville</span>
     <input class="form-control" id="ville" type="text" name="ville" placeholder="Entrer une destination">

     <input type="submit" value="Envoyer" class="btn btn-dark" />
  
    </div>

  </div>

</form>

<?php
$prixmin = null;
$prixmax = null;
$ville = null;
$nb_voyageurs = null;

/*if(isset($_POST['date']) && isset($_POST['date2'])){
  $date = $_POST['date'];
  $date2 = $_POST['date2'];
  var_dump($_POST);
  $liste=verif_reserve($date,$date2);
  var_dump($liste['id_annonce']);
  $id_add
}*/



if(!empty($_POST['prixmin']) && !empty($_POST['prixmax']) && !empty($_POST['nb_voyageurs']) && isset($_POST['ville'])){
  $prixmin = $_POST['prixmin'];
  $prixmax = $_POST['prixmax'];
  $ville = $_POST['ville'];
  $nb_voyageurs = $_POST['nb_voyageurs'];
  #var_dump($_POST);
  $liste = getListe(intval($prixmin),intval($prixmax),$ville,$nb_voyageurs);
}else{
  if(isset($_POST['ville'])){
    $ville = $_POST['ville'];
    $liste=getVille($ville);
  }
  else{
    $liste = getListe($prixmin,$prixmax,$ville,$nb_voyageurs);
  }
}

#$liste = getListe();
foreach ($liste as $annonce){
$id_add = $annonce['id'];
$photos = getAnnonce($id_add);
$photo = $photos['photo'];
$photo = explode (";", $photo);
$photo = $photo[0]?>

<a type="button" class="btn " href="pageAnnonce.php?id=<?php echo $annonce['id']; ?>" style="width:620px";>
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

<?php } 

?>