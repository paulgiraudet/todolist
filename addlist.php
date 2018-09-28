<?php

session_start();

require 'db.php';

if (isset($_POST['addList'])) {

  if (isset($_POST['name']) AND !empty($_POST['name'])) {

    $listname = htmlspecialchars($_POST['name']);

    $req = $bdd->prepare('INSERT INTO lists (name, id_project) VALUES(:name, :idproject)');
    $req->execute(array(
      'name' => $listname,
      'idproject' => $_POST['id']
    ));

    $_POST['addList'] = false;

  }
  else{
    $error = "Entrez un nom de liste correct.";
  }

}

header('Location:lists.php');
 ?>
