<?php require_once '../layout/header.php'; 
require_once '../functions/db.php'; ?>
<?php require_once '../functions/listeBien.php'; ?>


  
  <link rel="stylesheet" href='css/style.css'> 
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
   


  <form method="POST">
  <input class="form-control" type="date" name="date">
  <input class="form-control" type="date" name="date2">
  <input type="number" name="prix" id="prix" min="0">
  <input type="submit" value="Envoyer" />
  </form>
  <?php 
  $coupcoeur=getCoup_Coeur();
  var_dump($coupcoeur);
  foreach($coupcoeur as $annoncepref){
    $annonce_coeur = getAnnonce($annoncepref);
    $photo = $annonce_coeur['photo'];
    $photo = explode (";", $photo);
    $photo = $photo[0]?>
    <div class="card mb-3" style="max-width: 540px;">
      <div class="row no-gutters">
        <div class="col-md-4">
        <?php echo "<img src='img/annonce/".$photo."' alt='".$photo."' class='card-img'/>"; ?>
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title"><?php echo $annonce_coeur['titre'] ?></h5>
            <p class="card-text"><?php echo $annonce_coeur['adresse'] ?></p>
            <p class="card-text"><a href="pageAnnonce.php?id=<?php echo $annonce_coeur['id']; ?>" class="btn btn-warning">Voir</a></p>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>




</body>

</html>

<?php require_once __DIR__ . '/listeBien.php'; ?>
<?php require_once '../layout/footer.php'; ?>