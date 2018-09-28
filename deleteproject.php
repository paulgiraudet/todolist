<?php

session_start();

require 'db.php';

$req = $bdd->prepare('DELETE FROM projects WHERE id= :idproject');
$req->execute(array(
  'idproject' => $_GET['id']
));

header('Location:projects.php');
