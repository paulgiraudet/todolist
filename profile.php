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

      $req_infoUser = $bdd->prepare('SELECT * from members WHERE id = :iduser');
      $req_infoUser->execute(array(
        'iduser' => $_SESSION['id']
      ));

      $user = $req_infoUser->fetch();

      // if ($user['age']=="") {
      //   $user['age'] = 0;
      // }
      if (isset($_POST['addInfoProfile'])) {
        ?>

          <form class="" action="addInfoProfile.php" method="post">

            <div class="form-group">
              <label for="exampleInputName">Nom</label>
              <input type="text" class="form-control" id="exampleInputName" name="lastname" value="<?=$user['lastname'] ?>">
            </div>
            <div class="form-group">
              <label for="exampleInputName2">Prénom</label>
              <input type="text" class="form-control" id="exampleInputName2" name="firstname" value="<?=$user['firstname'] ?>">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Adresse Email</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?=$user['email'] ?>">
              <small id="emailHelp" class="form-text text-muted">Nous ne partagerons jamais votre adresse email.</small>
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Âge</label>
              <select class="form-control" id="exampleFormControlSelect1" name="age">
                    <option><?=$user['age'] ?></option>
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

            <button type="submit" name="changeProfile" class="btn btn-warning">Mise à jour</button>

          </form>
        <?php
      }
      else{

            if ($user['age']<7 OR $user['age']>77) {
              $user['age'] = "";
            }
        ?>
            <ul class="text-left">
              <li class="my-3">Nom : <?=$user['lastname'] ?></li>
              <li class="my-3">Prénom : <?=$user['firstname'] ?></li>
              <li class="my-3">Adresse mail : <?=$user['email'] ?></li>
              <li class="my-3">Âge : <?=$user['age'] ?></li>
            </ul>
            <form class="" action="profile.php" method="post">
              <button type="submit" name="addInfoProfile" class="btn btn-warning mt-5">Mettre à jour</button>
            </form>

        <?php
      }
       ?>
      </div>
    </div>
  </div>
</div>
<?php
require 'footer.php';
 ?>
