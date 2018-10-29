<?php

session_start();

require 'db.php';

//deleting project with the good id
$req = $bdd->prepare('DELETE FROM projects WHERE id= :idproject');
$req->execute(array(
  'idproject' => $_GET['id']
));

header('Location:projects.php');
