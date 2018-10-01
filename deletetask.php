<?php

session_start();

require 'db.php';

$req = $bdd->prepare('DELETE FROM tasks WHERE id= :idtask');
$req->execute(array(
  'idtask' => $_GET['id']
));

header('Location:tasks.php');
