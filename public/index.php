<?php require_once '../layout/header.php'; ?>


  <form method="POST">
  <!--input class="form-control" type="date" name="date" -->
  <!--input class="form-control" type="date" name="date2" -->
  <input type="number" name="prix" id="prix" min="0">
  <input type="submit" value="Envoyer" />
  </form>
  <?php 

 ?>
</body>

</html>

<?php require_once __DIR__ . '/listeBien.php'; ?>
<?php require_once '../layout/footer.php'; ?>