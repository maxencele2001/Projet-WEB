<?php require_once '../functions/db.php';
require_once '../functions/edit.php';
require_once '../layout/header.php';
require_once '../functions/listeBien.php';

$id_annonce = $_GET['id'];
$uneAnnonce = getAnnonce($id_annonce);
$prix_annonce = $uneAnnonce['prix'];
$max_voyageurs = $uneAnnonce['nb_voyageurs'];

function reserve($arrivee,$depart,$id_annonce,$prix,$id_users,$voyageurs){
  $pdo=getPdo();
  $query= "INSERT INTO reservation (arrivee, depart, id_annonce, prix, id_users, voyageurs) VALUES (:arrivee, :depart, :id_annonce, :prix, :id_users, :voyageurs)";
  $stmt = $pdo->prepare($query);
  return $stmt->execute([
    'arrivee' => $arrivee,
    'depart' => $depart,    
    'id_annonce' => $id_annonce,
    'prix' => $prix,
    'id_users' => $id_users,
    'voyageurs' => $voyageurs
]);
}

function verif_reserve(){
  $pdo = getPdo();
  $query = "SELECT * FROM reservation BETWEEN :date AND :date2";
}

/*function def_nb_jours(){
  $pdo = getPdo();
  $nb_jours = 'SELECT depart - arrivee FROM reservation';
  $pdo->prepare($nb_jours);
  return $nb_jours;
}*/


/*function def_prix($prix_annonce,$voyageurs,$nb_jours){
  $prix = $prix_annonce * $voyageurs * $nb_jours;
  return $prix;
}*/
?>
<script>

  var prix = <?php echo json_encode($prix_annonce); ?>;
  $( document ).ready(function() {
    $( "#date" ).change(function() {
      if ($(this).val() > $("#date2").val()){
        $(this).val($("#date2").val());
      }
      if ($(this).val() != null ){
        calcul_prix($("#voyageurs").val(),$("#date").val(),$("#date2").val());
      }
    });
    $( "#date2" ).change(function() {
      if ($(this).val() < $("#date").val()){
        $(this).val($("#date").val());
      }
      if ($(this).val() != null ){
        calcul_prix($("#voyageurs").val(),$("#date").val(),$("#date2").val());
      }
    });
    $( "#voyageurs" ).change(function() {
      if ($(this).val() != null ){
        calcul_prix($("#voyageurs").val(),$("#date").val(),$("#date2").val());
      }
    });
});
function calcul_prix(voyageurs,date,date2){
  date = new Date(date);
  date2 = new Date(date2);
  var diff = dateDiff(date,date2);
  //console.log(diff);
  var prix_total = prix * voyageurs * diff;
  //console.log(prix_total);
  $("#prix_total").val(prix_total.toString());
}

function dateDiff(date, date2){
    var diff = {}                           // Initialisation du retour
    var tmp = date2 - date;
 
    tmp = Math.floor(tmp/1000);             // Nombre de secondes entre les 2 dates
    diff.sec = tmp % 60;                    // Extraction du nombre de secondes
 
    tmp = Math.floor((tmp-diff.sec)/60);    // Nombre de minutes (partie entière)
    diff.min = tmp % 60;                    // Extraction du nombre de minutes
 
    tmp = Math.floor((tmp-diff.min)/60);    // Nombre d'heures (entières)
    diff.hour = tmp % 24;                   // Extraction du nombre d'heures

    tmp = Math.floor((tmp-diff.hour)/24);   // Nombre de jours restants
    diff.day = tmp;

    return diff.day;
}
</script>



  <form method="POST">
  <input class="form-control" type="date" name="date" id="date" value="<?php echo date("Y-m-d") ?>">
  <input class="form-control" type="date" name="date2" id="date2" value="<?php echo (new DateTime('+1 day'))->format('Y-m-d');?>">
  <input type="number" name="voyageurs" id="voyageurs" value="1" min="1" max="<?php echo $max_voyageurs?>">
  <label for="prix_total">Prix total</label><input type="text" name="prix_total" id="prix_total" value="<?php echo $prix_annonce ?>" readonly>
  <input type="submit" value="Envoyer" />
  </form>


<?php if (!isset($_GET['id'])) { ?>
  <div class="alert alert-danger" role="alert">
    Paramètre manquant : id
  </div>
  <?php
  exit;
}


if(isset($_SESSION['state']) && $_SESSION['state'] == 'connected'){
  $id_users = $_SESSION['user_id'];
  if (isset($_POST['date']) && isset($_POST['date2']) && isset($_POST['voyageurs']) && !empty($_POST['prix_total'])){
    $arrivee = $_POST['date'];
    $depart = $_POST['date2'];
    $voyageurs = $_POST['voyageurs'];
    $prix_total = $_POST['prix_total'];   
    $id_hote=getId_hote($id_annonce);
    $id_hote=$id_hote['id_users'];
    $solde_hote = getSolde_hote($id_hote);
    $solde_hote = $solde_hote['solde'];
    $solde_client = getSolde_client($id_users);
    $solde_client = $solde_client['solde'];
    $solde_hote = $solde_hote + $prix_total;
    $solde_client = $solde_client - $prix_total;
    #rajouter if de verif de date
    if ($solde_client>=0){
      reserve($arrivee,$depart,$id_annonce,$prix_total,$id_users,$voyageurs);
      updateSoldeHote($solde_hote,$id_hote);
      updateSoldeClient($solde_client,$id_users);
    }
  }
}else{
  echo("Connectez vous pour réserver");
}


$photos = $uneAnnonce['photo'];
$photos = explode (";", $photos);
foreach($photos as $photo){
    echo "<img src='img/annonce/".$photo."' alt='".$photo."'/>";
}
//$i = count($photos);

?>

















<?php require_once '../layout/footer.php'; ?>