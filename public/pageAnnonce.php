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
    $date = $_POST['date'];
    $date2 = $_POST['date2'];
    $verif = verif_reserve($date,$date2);
    #var_dump($verif);
    echo("oui");
    var_dump($id_annonce);
    $reserve = 0;
    foreach($verif as $num_appart){#cherche si l'annonce est déja prise et retourne 1 pour empecher la reservation
      var_dump($num_appart);
      if(intval($num_appart) == intval($id_annonce)){
        echo("heho");
        $reserve =1;
      }else{
        echo("pas pris");
      }
    }
    #$arrivee = $_POST['date'];
    #$depart = $_POST['date2'];
    $voyageurs = $_POST['voyageurs'];
    $prix_total = $_POST['prix_total'];   
    $id_hote=getId_hote($id_annonce);
    $id_hote=$id_hote['id_users'];
    $hote = getHote($id_hote);
    $solde_hote = $hote['solde'];
    $mail_hote = $hote['email'];
    $client = getClient($id_users);
    $solde_client = $client['solde'];
    $mail_client = $client['email'];
    $nom_client = $client['nom'];
    $solde_hote = $solde_hote + $prix_total;
    $solde_client = $solde_client - $prix_total;
    $message_client = "Votre réservation a bien été prise en compte";
    $message_hote = "Vous avez une nouvelle réservation de Monsieur ou Madame ".$nom_client;
    $subject = "LOC'Y Réservation";
    #rajouter if de verif de date
    if($reserve == 0){
      if ($solde_client>=0){
        echo("oui oui");
        #OUVRIR maildev -s 2525 sur un autre terminal
        reserve($date,$date2,$id_annonce,$prix_total,$id_users,$voyageurs);
        updateSoldeHote($solde_hote,$id_hote);
        updateSoldeClient($solde_client,$id_users);
        mail($mail_hote,$subject,$message_hote);
        mail($mail_client,$subject,$message_client);
      }else{
        echo ("t pauvre mon bonhomme");
      }
    }else{
    echo("déja réservé");
    #var_dump($verif);
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
<link rel="stylesheet" href="../css/annonce.css"> 
<section class="titre">
        <h3><?php echo $uneAnnonce['titre'] ?></h3>
        
    </section>
    <section class="card-deck">
       
    </section>
    <section class="body">

      <section class="description">
        <article class="info" >
            <div class="caractéristique">
              <h3><?php echo $uneAnnonce['type'] ?> </h3>
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
         </section>
      </form>


    </section>
     
    <section>
        <hr>
        <h2>Localisation</h2>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5567.478026615343!2d4.829194074663444!3d45.75637790206292!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f4ea52244ab879%3A0xb0956981fd027394!2sBellecour%20-%20H%C3%B4tel%20Dieu%2C%20Lyon!5e0!3m2!1sfr!2sfr!4v1586881042197!5m2!1sfr!2sfr"  frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </section>


</body>



















<?php require_once '../layout/footer.php'; ?>