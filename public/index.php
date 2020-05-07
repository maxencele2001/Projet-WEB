<?php require_once '../layout/header.php'; ?>

  <?php
  var_dump($_POST); // ne contient pas les fichiers
  var_dump($_FILES);

  // Fichier simple
  if (isset($_FILES['myFile'])) {
    // on met le fichier dans une variable pour une meilleure lisibilité
    $file = $_FILES['myFile'];

    // On récupère le nom du fichier
    $filename = $file['name'];

    // On construit le chemin de destination
    $destination = __DIR__ . "/img/" . $filename;

    // On bouge le fichier temporaire dans la destination
    if (move_uploaded_file($file['tmp_name'], $destination)) {
      echo $filename . " correctement enregistré<br />";
    }
  }

  // Fichiers multiples
  if (isset($_FILES['photos'])) {
    foreach ($_FILES['photos']['error'] as $key => $error) {
      if ($error == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["photos"]["tmp_name"][$key];
        $filename = $_FILES["photos"]["name"][$key];
        $destination = __DIR__ . "/img/" . $filename;

        if (move_uploaded_file($tmp_name, $destination)) {
          echo $filename . " correctement enregistré<br />";
        }
      }
    }
  }
  echo(date('d/m/Y'));
  if(isset($_POST['date']) && isset($_POST['date2'])){
    $date = $_POST['date'];
    $date2 = $_POST['date2'];
    echo($date . $date2);
  }
  
  ?>

  <!-- Ne pas oublier l'attribut enctype -->
  <form method="POST" enctype="multipart/form-data">
    <input type="file" name="myFile" />
    <input type="submit" value="Envoyer" />
  </form>

  <form method="POST" enctype="multipart/form-data">
    <input type="file" name="photos[]" multiple />
    <input type="submit" value="Envoyer" />
  </form>

  <form action="POST">
  <input class="form-control" type="date" name="date" >
  <input class="form-control" type="date" name="date2" >
  <input type="submit" value="Envoyer" />
  </form>
  <?php 

 ?>
</body>

</html>

<?php require_once __DIR__ . '/listeBien.php'; ?>
<?php require_once '../layout/footer.php'; ?>