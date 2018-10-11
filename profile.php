<?php

session_start();

$title = "TDL - Mon profil";
require 'header.php';
require 'db.php';
?>

<div class="container-fluid">
  <div class="row">
    <div class="mx-auto col-sm-6">
      <div class="postitList mt-3">
      <?php
      // if (isset($_POST['addInfoProfile'])) {
        ?>

          <form class="" action="addInfoProfile.php" method="post">

            <div class="form-group">
              <label for="exampleInputName">Nom</label>
              <input type="text" class="form-control" id="exampleInputName" name="lastname" placeholder="Jean">
            </div>
            <div class="form-group">
              <label for="exampleInputName2">Prénom</label>
              <input type="text" class="form-control" id="exampleInputName2" name="lastname" placeholder="Jean">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Adresse Email</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
              <small id="emailHelp" class="form-text text-muted">Nous ne partagerons jamais votre adresse email.</small>
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Âge</label>
              <select class="form-control" id="exampleFormControlSelect1" name="age">
                <?php
                  for ($i=7; $i<=77 ; $i++) {
                    ?>
                    <option><?= $i ?></option>
                    <?php
                  }
                 ?>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Mot de passe</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Mot de passe" name="password" required>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword2">Mot de passe (vérification)</label>
              <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Vérifiez votre mot de passe" name="passwordbis" required>
            </div>

            <button type="submit" name="changeProfile" class="btn btn-warning">Mise à jour</button>

          </form>
        <?php
      // }
      // else{
        ?>

        <?php
      // }
       ?>
      </div>
    </div>
  </div>
</div>
<?php
require 'footer.php';
 ?>
