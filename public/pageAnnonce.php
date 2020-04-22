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
$photo = explode (";", $photos);

$i = count($photo);

print($i);
print($photo[0]);
print($photo[1]);
print($photo[2]); ?>

















<?php require_once '../layout/footer.php'; ?>