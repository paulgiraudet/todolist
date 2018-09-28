<?php

session_start();

require 'db.php';

if (isset($_POST['addTask'])) {

  if (isset($_POST['name'], $_POST['date']) AND !empty($_POST['name']) AND !empty($_POST['date'])) {

    $taskname = htmlspecialchars($_POST['name']);
    $date = $_POST['date'];
    $taskDate = strtotime($_POST['date']);
    $actualDate = strtotime(date("Y-m-d"));

    if ($taskDate >= $actualDate) {

      $req = $bdd->prepare('INSERT INTO tasks (name, deadline, id_list, do_done) VALUES (:name, :deadline, :idlist, :dodone)');
      $req->execute(array(
        'name' => $taskname,
        'deadline' => $date,
        'idlist' => $_SESSION['idlist'],
        'dodone' => 0
      ));

      $_POST['addTask'] = false;
    }
    else{
      $error = "Entrez une date future.";
    }
  }
  else{
    $error = "Au moins un champ est incorrect.";
  }
}

header('Location:tasks.php');
