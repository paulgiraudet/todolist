<?php

session_start();

$title = "TDL - Accueil";
require 'header.php';
require 'db.php';
 ?>

<div class="container">
  <div class="row">
    <div class="col-md-6 mx-auto indexform borderFormRight pr-5">

      <p class="colTitle text-center">Inscription</p>

<?php
      require 'inscriptiontest.php';
 ?>

        <form method="post" action="index.php" class="my-5">
          <div class="form-group">
            <label for="exampleInputPseudo">Pseudo</label>
            <input type="text" class="form-control" id="exampleInputPseudo" aria-describedby="pseudoHelp" placeholder="Entrez votre pseudo" name="pseudo" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Mot de passe</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Mot de passe" name="password" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword2">Mot de passe (vérification)</label>
            <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Vérifiez votre mot de passe" name="passwordbis" required>
          </div>
          <div class="form-group">
          <label for="exampleInputEmail1">Email</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Entrez votre email" name="email" required>
          <small id="emailHelp" class="form-text text-muted">Nous ne partagerons jamais votre email avec qui que ce soit</small>
        </div>
          <button type="submit" name="addUser" class="btn btn-warning">Inscription</button>
        </form>

    </div>
    <div class="col-md-6 mx-auto indexform d-flex flex-column borderFormLeft pl-5">

      <p class="colTitle text-center mb-5">Connexion</p>

<?php
      require 'connectiontest.php';
 ?>

      <form method="post" action="index.php" class="mt-5">
        <div class="form-group">
          <label for="exampleInputPseudo">Pseudo</label>
          <input type="text" class="form-control" id="exampleInputPseudo" aria-describedby="pseudoHelp" placeholder="Entrez votre pseudo" name="pseudo" required>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Mot de passe</label>
          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Mot de passe" name="password" required>
        </div>
        <button type="submit" name="connectUser" class="btn btn-warning">Connexion</button>
      </form>

    </div>
  </div>
</div>

<?php
require 'footer.php';
 ?>
