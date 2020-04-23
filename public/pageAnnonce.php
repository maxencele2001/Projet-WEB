<?php require_once '../functions/db.php';
require_once '../functions/edit.php';
require_once '../layout/header.php';
require_once '../functions/listeBien.php';
?>

<?php if (!isset($_GET['id'])) { ?>
  <div class="alert alert-danger" role="alert">
    Paramètre manquant : id
  </div>
  <?php
  exit;
}
$id = $_GET['id'];

$uneAnnonce = getAnnonce($id);

$photos = $uneAnnonce['photo'];
$photos = explode (";", $photos);
foreach($photos as $photo){
    echo "<img src='img/annonce/".$photo."' alt='".$photo."'/>";
}
//$i = count($photos);

?>

















<?php require_once '../layout/footer.php'; ?>