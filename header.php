<!doctype html>
<html class="no-js" lang="fr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title> <?= $title ?></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

  <link href="https://fonts.googleapis.com/css?family=Reenie+Beanie" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.css">
</head>

<body>

<header>

  <!-- responsive navbar with bootstrap -->
  <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
    <a class="navbar-brand mx-auto" href="<?= $route = isset($_SESSION['id'])? "projects" : "index" ; ?>.php"><h1 class="<?php if (isset($_SESSION['id'])){ ?>ml-5 <?php } ?> text-white">Tout Doux Liste</h1></a>
    <?php
    //checking if we are connected
    if(isset($_SESSION['id'])) {
      ?>
    <button class="navbar-toggler ml-auto mb-3" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item ml-auto">
          <a class="menu mx-2" href="profile.php">Mon profil</a>
        </li>
        <!-- displaying disconnecting link -->
        <li class="nav-item ml-auto">
          <a class="menu mx-2" href="disconnection.php">Se déconnecter</a>
        </li>
      </ul>
    </div>
    <?php
    }
    ?>
  </nav>

</header>
