<?php
session_start();

require 'db.php';

if (isset($_POST['addProject'])) {

  if (isset($_POST['name'], $_POST['description'], $_POST['date']) AND (!empty($_POST['name']) AND !empty($_POST['description']) AND !empty($_POST['date']))) {

    $projectName = htmlspecialchars($_POST['name']);
    $projectDescription = nl2br(htmlspecialchars($_POST['description']));
    $date = $_POST['date'];
    $projectDate = strtotime($_POST['date']);
    $actualDate = strtotime(date("Y-m-d"));

    if ($projectDate > $actualDate) {

      $req = $bdd->prepare('INSERT INTO projects (name, description, deadline, id_user) VALUES(:name, :description, :deadline, :iduser)');
      $req->execute(array(
        'name' => $projectName,
        'description' => $projectDescription,
        'deadline' => $date,
        'iduser' => $_SESSION['id']
      ));

      $_POST['addProject'] = false;
    }
    else{
      $error = "Veuillez entrer une date future.";
    }
  }
}

header('Location:projects.php');
 ?>
