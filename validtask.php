<?php

session_start();
require 'db.php';

//checking if we come from tasks.php
if (isset($_GET['id'], $_GET['dodone']) AND !empty($_GET['id'])) {

//just switching values for our task to show if we did it or not

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

// back to tasks page
header('Location:tasks.php');

 ?>
