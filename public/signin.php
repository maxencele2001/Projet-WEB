<?php require_once '../layout/header.php'; 
require_once '../functions/db.php';?>


<form method="POST">
    <div class="container">
    <div class="form-group"><?php //ajouter la pp ?>
    <label for="nom">Nom</label>
    <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom ..." />
  </div>
  <div class="form-group">
    <label for="prenom">Prenom</label>
    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Votre prénom ..." />
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com" />
  </div>
  <div class="form-group">
    <label for="password">Mot de passe</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe ..." />
  </div>
  <div class="form-group">
    <label for="password">Confirmation mot de passe</label>
    <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirmation ..." />
  </div>
  <button type="submit" class="btn btn-primary">Enregistrer</button>
</div>
</form>


<?php require_once '../layout/footer.php'; ?>