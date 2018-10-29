<?php

session_start();

require 'db.php';

// checking if we come from addListForm
if (isset($_POST['addList'])) {

  if (isset($_POST['name']) AND !empty($_POST['name'])) {

    //avoiding scripts insertion
    $listname = htmlspecialchars($_POST['name']);

    //insertion of the new list linked to the correct project
    $req = $bdd->prepare('INSERT INTO lists (name, id_project) VALUES(:name, :idproject)');
    $req->execute(array(
      'name' => $listname,
      'idproject' => $_POST['id']
    ));

    //reinitializing addListForm
    $_POST['addList'] = false;

  }
  else{
    $error = "Entrez un nom de liste correct.";
  }

}

//back to our list page
header('Location:lists.php');
 ?>
