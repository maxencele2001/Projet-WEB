<?php 
$title = "Je créer mon annonce";
$css = "../css/addAnnonce.css";
require_once '../../functions/db.php';
require_once '../../functions/edit.php';
require_once '../../layout/header.php';
require_once '../../functions/redirect.php';
if(isset($_SESSION['state']) && $_SESSION['state'] == 'connected'){
  $id_users = $_SESSION['user_id'];
}
else{
  ?>
  <div class="alert alert-danger" role="alert">

  <?php echo("Connectez vous pour créer une annonce");?>
  </div> <?php
}
?>

<form method="POST" enctype="multipart/form-data">
 <div class="form-group">
    <label for="titre">Titre</label>
    <input type="text" class="form-control" id="titre" name="titre">
 </div>
  <div class="form-group">
    <label for="adresse">Adresse</label>
    <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse + ZIP">
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
      <option>6</option>
      <option>7</option>
      <option>8</option>
    </select>
  </div>
  <div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="prix">Prix</label>
    <input type="number" min="0" class="form-control" id="prix" name="prix">
  </div>
  <div class="form-group">
    <label for="localisation">Localisation</label>
    <input  class="form-control" id="localisation" name="localisation">
  </div>
  <div class="form-group">
    <label for="photo">Photos</label>
    <input type="file" id="photo" name="photo[]" multiple />
  </div>
  <button type="submit" class="btn">Enregistrer</button>
</form>


<?php

function addAnnonce(string $titre,string $adresse, int $nb_chambre, int $nb_voyageurs, string $description, string $photobdd, int $prix, int $id_users, string $localisation ): bool
{
  $pdo = getPdo();// recup de ma bdd
  
  $query = "INSERT INTO annonces (titre, adresse, nb_chambre, nb_voyageurs, description, photo, prix, id_users, localisation) VALUES (:titre, :adresse, :nb_chambre, :nb_voyageurs, :description, :photo, :prix, :id_users, :localisation)";// formule pour l'ajout
  $stmt = $pdo->prepare($query);
  return $stmt->execute([
    'titre' => $titre,
    'adresse' => $adresse,
    'nb_chambre' => $nb_chambre,
    'nb_voyageurs' => $nb_voyageurs,
    'description' => $description,
    'photo' => $photobdd,
    'prix' => $prix,
    'id_users' => $id_users,
    'localisation' => $localisation,
  ]);
}



// Fichiers multiples
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
    }addAnnonce($titre, $adresse, $nb_chambre, $nb_voyageurs, $description, $photobdd, $prix, $id_users, $localisation);
    //redirect('../editAnnonce.php');
  }
}
?>
<?php require_once '../../layout/footer.php'; ?>