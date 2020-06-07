<?php 
$css="";
require_once '../../functions/db.php';
require_once '../../functions/edit.php';
require_once '../../layout/header.php';
require_once '../../functions/listeBien.php';
$id_annonce = $_GET['id'];
$uneAnnonce = getAnnonce($id_annonce);
?>

<form method="POST" enctype="multipart/form-data">
<div class="form-group">
    <label for="titre">Titre</label>
    <input type="text" class="form-control" id="titre" name="titre" value="<?php echo $uneAnnonce['titre'] ?>">
  </div>
  <div class="form-group">
    <label for="adresse">Adresse</label>
    <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse + ZIP" value="<?php echo $uneAnnonce['adresse'] ?>" >
  </div>
  <div class="form-group">
    <label for="nb_voyageurs">Nombre de voyageurs</label>
    <select class="form-control" id="nb_voyageurs" name="nb_voyageurs">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
      <option>6</option>
      <option>7</option>
      <option>8</option>
      <option>9</option>
      <option>10</option>
    </select>
  </div>
  <div class="form-group">
    <label for="nb_chambre">Nombre de chambres</label>
    <select class="form-control" id="nb_chambre" name="nb_chambre">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>
  <div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" name="description" rows="3" placeholder="<?php echo $uneAnnonce['description'] ?>"></textarea>
  </div>
  <div class="form-group">
    <label for="localisation">Localisation</label>
    <input  class="form-control" id="localisation" name="localisation">
  </div>
  <div class="form-group">
    <label for="prix">Prix</label>
    <input type="number" min="0" class="form-control" id="prix" name="prix" value="<?php echo $uneAnnonce['prix'] ?>">
  </div>
  <div class="form-group">
    <input type="file" id="photo" name="photo[]" multiple/>
</div>
<button type="submit" class="btn btn-primary">Enregistrer</button>
</form>
<?php
if(isset($_POST['titre']) && isset($_POST['adresse']) && isset($_POST['nb_chambre']) && isset($_POST['nb_voyageurs']) && isset($_POST['description']) && isset($_POST['prix']) && isset($_POST['localisation']) && !empty($_POST['titre']) && !empty($_POST['adresse']) && !empty($_POST['nb_chambre']) && !empty($_POST['nb_voyageurs']) && !empty($_POST['description']) && !empty($_POST['prix']) && !empty($_POST['localisation'])){
    echo "oui";
    $titre = $_POST['titre'];
    $adresse = $_POST['adresse'];
    $nb_chambre = $_POST['nb_chambre'];
    $nb_voyageurs = $_POST['nb_voyageurs'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $localisation = $_POST['localisation'];
    if (isset($_FILES['photo']) && !empty($_FILES['photo'])){
      echo "photo";
      $photobdd = "";
    foreach ($_FILES['photo']['error'] as $key => $error) {
      if ($error == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["photo"]["tmp_name"][$key];
        $photo = $_FILES["photo"]["name"][$key];
        $destination = __DIR__ . "/../img/annonce/" . $photo;
        if($photobdd == ""){
          $photobdd = $photo;
        }
        else{
        $photobdd = $photobdd.";".$photo;
        }
        if (move_uploaded_file($tmp_name, $destination)) {
          echo $photo . " correctement enregistré<br />";
          
        }
      }
    }
    updateAnnonce($titre, $adresse, $description, intval($nb_voyageurs), intval($nb_chambre),intval($prix), $photobdd, intval($id_annonce), $localisation);
  }
}

?>
<?php require_once '../../layout/footer.php';