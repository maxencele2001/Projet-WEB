<?php require_once '../layout/header.php'; 
require_once '../functions/db.php'; ?>
<?php require_once '../functions/listeBien.php'; ?>


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