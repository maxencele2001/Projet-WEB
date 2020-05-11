<?php require_once '../layout/header.php'; ?>

  <?php
  /*
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
  */
  ?>
  
  <!-- Ne pas oublier l'attribut enctype -->
<!--
  <form method="POST" enctype="multipart/form-data">
    <input type="file" name="myFile" />
    <input type="submit" value="Envoyer" />
  </form>

  <form method="POST" enctype="multipart/form-data">
    <input type="file" name="photos[]" multiple />
    <input type="submit" value="Envoyer" />
  </form>
  -->
  <link rel="stylesheet" href='style.css'> 
  <figcaption class="section">
		<div class="section-center">
			<div class="container">
				<div class="row">
					<div class="col-md-7 col-md-push-5">
						<div class="booking-cta">
							<h1>Trouvez, Réservez, Voyagez</h1>
						</div>
				  </div>
					<div class="col-md-4 col-md-pull-7">
					  <div class="booking-form"> 
							<form>
							  <div class="form-group">
									<span class="form-label">Votre destination</span>
									<input class="form-control" type="text" placeholder="Entrer une destination" required>
								</div>
								<div class="row">
								  <div class="col-sm-6">
									  <div class="form-group">
										  <span class="form-label">Arrivée</span>
											<input class="form-control" type="date" >
										</div>
									</div>
								  <div class="col-sm-6">
										<div class="form-group">
											<span class="form-label">Départ</span>
											<input class="form-control" type="date">
										</div>
								  </div>
							  </div>
								<div class="row">
								  <div class="col-sm-6">
									  <div class="form-group">
											<span class="form-label">Chambres</span>
										  <select class="form-control">
												<option>1</option>
												<option>2</option>
                        <option>3</option>
                        <option>4</option>
												<option>5</option>
										  </select>
											<span class="select-arrow"></span>
									  </div>
									</div>
									<div class="col-sm-6">
									  <div class="form-group">
											<span class="form-label">Voyageurs</span>
											<select class="form-control">
												<option>1</option>
												<option>2</option>
                        <option>3</option>
                        <option>4</option>
												<option>5</option>
												<option>6</option>
											</select>
											<span class="select-arrow"></span>
										</div>
									</div>
								  <div class="form-btn">
									  <button class="submit-btn">Recherche</button>
                  </div>
								</div>
						  </form>
						</div>
					</div>
				</div>
			</div>
		</div>
  </figcaption>

  <h3>Les coups de <i class="fas fa-heart"></i> </h3>
   






</body>

</html>


<?php require_once '../layout/footer.php'; ?>