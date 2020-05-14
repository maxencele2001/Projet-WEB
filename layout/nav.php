<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/index.php"><img src="logo.png" alt="LOC'Y"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
</ul>
      <ul class="navbar-nav justify-content-end">
      <?php
      @session_start();
      if(isset($_SESSION['user_is_hote']) && $_SESSION['user_is_hote'] == 1){ ?>
        <li class="nav-item">
        <a class="nav-link" href="/logged/annonce.php">Créer une annonce</a>
        </li>
        <?php }else{
        }?>
      <?php if (isset($_SESSION['state']) && $_SESSION['state'] == 'connected') {  ?>        
        <li class="nav-item">
          <a class="nav-link" href="/logged/profil.php"><svg class="bi bi-person-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
        </svg></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/logout.php"><svg class="bi bi-power" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M5.578 4.437a5 5 0 104.922.044l.5-.866a6 6 0 11-5.908-.053l.486.875z" clip-rule="evenodd"/>
            <path fill-rule="evenodd" d="M7.5 8V1h1v7h-1z" clip-rule="evenodd"/>
          </svg></a>
      </li>

      <?php }else{?>
        <li class="nav-item">
          <a class="nav-link" href="/login.php">Se connecter</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/signin.php">S'inscrire</a>
        </li>
        <?php } ?>
</ul>
  </div>
</nav>
