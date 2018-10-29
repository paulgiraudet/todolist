<?php

session_start();

require 'db.php';

//checking if we come from the addTaskForm
if (isset($_POST['addTask'])) {

  //isset and !empty foreach input fields
  if (isset($_POST['name'], $_POST['date']) AND !empty($_POST['name']) AND !empty($_POST['date'])) {

    //avoid script in input field
    $taskname = htmlspecialchars($_POST['name']);
    $date = $_POST['date'];
    //putting the date into the good format
    $taskDate = strtotime($_POST['date']);
    $actualDate = strtotime(date("Y-m-d"));

    //we want the date to be in the future
    if ($taskDate >= $actualDate) {


      //insertion of the new task
      $req = $bdd->prepare('INSERT INTO tasks (name, deadline, id_list, do_done) VALUES (:name, :deadline, :idlist, :dodone)');
      $req->execute(array(
        'name' => $taskname,
        'deadline' => $date,
        //with a particular id list cause the task is linked to a particular task
        'idlist' => $_SESSION['idlist'],
        //undone value
        'dodone' => 0
      ));

      //reinitializing formbuttonValue
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

//back to our task page
header('Location:tasks.php');
