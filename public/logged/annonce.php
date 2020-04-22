<?php require_once '../../functions/db.php';
require_once '../../functions/edit.php';
require_once '../../layout/header.php';
?>

<form method="POST" enctype="multipart/form-data">
<div class="form-group">
    <label for="exampleFormControlInput1">Titre</label>
    <input type="text" class="form-control" id="titre">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Adresse</label>
    <input type="text" class="form-control" id="adresse" placeholder="Adresse + ZIP">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Nombre de voyageurs</label>
    <select class="form-control" id="nb_voyageurs">
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
    <label for="exampleFormControlSelect1">Nombre de chambres</label>
    <select class="form-control" id="nb_chambre">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Description</label>
    <textarea class="form-control" id="descritpion" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="prix">prix</label>
    <input type="number" min="0" class="form-control" id="prix">
  </div>
  <div class="form-group">
    <input type="file" id="photo" name="photo[]" multiple />
    <input type="submit" value="Envoyer" />
</div>
</form>
<?php

function addAnnonce(string $titre,string $adresse, int $nb_chambre, int $nb_voyageurs, string $description, string $photo, int $prix): bool
{
  $pdo = getPdo();// recup de ma bdd
  
  $query = "INSERT INTO annonces (titre, adresse, nb_chambre, nb_voyageurs, description, photo, prix) VALUES (:titre, :adresse, :nb_chambre, :nb_voyageurs, :description, :photo, prix)";// formule pour l'ajout
  $stmt = $pdo->prepare($query);
  return $stmt->execute([
    'titre' => $titre,
    'adresse' => $adresse,
    'nb_chambre' => $nb_chambre,
    'nb_voyageurs' => $nb_voyageurs,
    'description' => $description,
    'photo' => $photo,
    'prix' => $prix
  ]);
}


// Fichiers multiples
if(isset($_POST['titre']) && isset($_POST['adresse']) && isset($_POST['nb_chambre']) && isset($_POST['nb_voyageurs']) && isset($_POST['description']) && isset($_POST['prix']) && !empty($_POST['titre']) && !empty($_POST['adresse']) && !empty($_POST['nb_chambre']) && !empty($_POST['nb_voyageurs']) && !empty($_POST['description']) && !empty($_POST['prix'])){
    echo "oui";
    $titre = $_POST['titre'];
    $adresse = $_POST['adresse'];
    $nb_chambre = $_POST['nb_chambre'];
    $nb_voyageurs = $_POST['nb_voyageurs'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    if (isset($_FILES['photo']) && !empty($_FILES['photo'])){
    foreach ($_FILES['photo']['error'] as $key => $error) {
      if ($error == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["photo"]["tmp_name"][$key];
        $photo = $_FILES["photo"]["name"][$key];
        $destination = __DIR__ . "/../img/annonce/" . $photo;

        if (move_uploaded_file($tmp_name, $destination)) {
          echo $photo . " correctement enregistré<br />";
          addAnnonce($titre, $adresse, $nb_chambre, $nb_voyageurs, $description, $photo, $prix);
        }
      }
    }
  }
}

?>


























<?php require_once '../../layout/footer.php';