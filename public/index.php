<?php require_once '../layout/header.php'; 
require_once '../functions/db.php'; 
require_once '../functions/listeBien.php';
$title = "Accueil";
?>
<link rel="stylesheet" href= "css/style.css" >
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
							<form method="POST">
							  <div class="form-group">
									<span class="form-label">Votre destination</span>
									<input class="form-control" id="ville" type="text" name="ville" required>
								</div>
								<div class="row">
								  <div class="col-sm-6">
									  <div class="form-group">
										  <span class="form-label">Prix minimum</span>
											<input class="form-control" id="prixmin" type="number" name="prixmin" min=0 >
										</div>
									</div>
								  <div class="col-sm-6">
										<div class="form-group">
											<span class="form-label">Prix maximum</span>
											<input class="form-control" id="prixmax" type="number" name="prixmax" min=0 >
										</div>
								  </div>
							  </div>
								<div class="row">
								  <div class="col-sm-6">
									  <div class="form-group">
											<span class="form-label ">Chambres</span>
										  <select class="form-control">
												<option>1</option>
												<option>2</option>
                                                <option>3</option>
                                                <option>4</option>
												<option>5</option>
										  </select>	
									  </div>
									</div>
									<div class="col-sm-6">
									  <div class="form-group">
										<span class="form-label">Voyageurs</span>
										<input class="form-control" id="nb_voyageurs" type="number" name="nb-voyageurs"> 
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
   
  <?php 
  $coupcoeur=getCoup_Coeur();
  #var_dump($coupcoeur);
  foreach($coupcoeur as $annoncepref){
    $annonce_coeur = getAnnonce($annoncepref);
    $photo = $annonce_coeur['photo'];
    $photo = explode (";", $photo);
    $photo = $photo[0]?>
    
	<a type="button" class="btn btn-light" href="pageAnnonce.php?id=<?php echo $annonce_coeur['id']; ?>" style="width: 19rem;">
	  <div class="card mb-3">
	    <?php echo "<img src='img/annonce/".$photo."' alt='".$photo."' class='card-img-top'/>"; ?> 
        <div class="card-body">
          <h5 class="card-title"><?php echo $annonce_coeur['titre'] ?></h5>
          <p class="card-text"><small class="text-muted"><?php echo $annonce_coeur['nb_voyageurs'] ?> voyageurs · <?php echo $annonce_coeur['nb_chambre'] ?> lits | <?php echo $annonce_coeur['prix'] ?>€/nuit </small></p>
		</div> 
	  </div>
    </a>
	
  <?php } ?>

 



<?php require_once '../layout/footer.php'; ?>