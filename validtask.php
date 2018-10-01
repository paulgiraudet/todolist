<?php

session_start();
require 'db.php';


if (isset($_GET['id'], $_GET['dodone']) AND !empty($_GET['id'])) {

  if ($_GET['dodone']==0) {

    $req = $bdd->prepare('UPDATE tasks SET do_done = :dodone WHERE id = :id');
    $req->execute(array(
      'dodone' => 1,
      'id' => $_GET['id']
    ));
  }
  else if ($_GET['dodone']==1) {

    $req = $bdd->prepare('UPDATE tasks SET do_done = :dodone WHERE id = :id');
    $req->execute(array(
      'dodone' => 0,
      'id' => $_GET['id']
    ));
  }
  else{
    echo "Erreur de valeur.";
  }
}
else{
  echo "Erreur de valeur.";
}

header('Location:tasks.php');

 ?>
