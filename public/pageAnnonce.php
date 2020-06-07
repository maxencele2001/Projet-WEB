<?php 
$title = "Annonce";
$css = "../css/annonce.css";
require_once '../layout/header.php'; 
require_once '../functions/reservation.php'; 


$photos = $uneAnnonce['photo'];
$photos = explode (";", $photos);
foreach($photos as $photo){ 
   echo "<img src='img/annonce/".$photo."' alt='".$photo."' class='card-img-top' style='width: 22rem;'/>"; 
  
}
//$i = count($photos);

?>

  <section class="body">
    <section class="description">
      <article class="info" >
          <div class="caractéristique">
            <h3><?php echo $uneAnnonce['titre'] ?></h3>
            <p><?php echo $uneAnnonce['nb_voyageurs'] ?> voyageurs · <?php echo $uneAnnonce['nb_chambre'] ?> chambre</p>
          </div>    
      </article>
      <hr>
      <article>
          <h4>Description du bien</h4>
          <p><?php echo $uneAnnonce['description'] ?></p>
      </article> 
    </section>
    <section class="réservation">
      <article>
        <div>
          <h3>Modalité de réservation</h3>
          <h4><?php echo $uneAnnonce['prix'] ?>€ la nuit / personne</h4>
        </div>   
      </article>
      <form method="POST">
        <div class="col-sm-14">
          <div class="form-group">
            <span class="form-label">Voyageurs</span>
            <input class="form-control" type="number" name="voyageurs" id="voyageurs" value="1" min="1" max="<?php echo $max_voyageurs?>">
            <span class="select-arrow"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <span class="form-label">Arrivée</span>
              <input class="form-control" type="date" name="date" id="date" value="<?php echo date("Y-m-d") ?>" required>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <span class="form-label">Départ</span>
              <input class="form-control" type="date" name="date2" id="date2" value="<?php echo (new DateTime('+1 day'))->format('Y-m-d');?>" required>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <span class="form-label">Prix total</span>
              <input class="form-control" type="text" name="prix_total" id="prix_total" value="<?php echo $prix_annonce ?>" readonly>
            </div>
          </div> 
        </div>
        <div class="form-btn">
          <button class="submit-btn" type="submit" value="Envoyer">Réservez</button>
        </div>
      </form>
    </section>
  </section>
  <section>
    <hr>
    <h2>Localisation</h2>
    <?php echo $uneAnnonce['localisation'] ?>
  </section>

</body>



















<?php require_once '../layout/footer.php'; ?>