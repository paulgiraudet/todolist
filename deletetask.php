<?php

session_start();

require 'db.php';

//deleting the task with the good id
$req = $bdd->prepare('DELETE FROM tasks WHERE id= :idtask');
$req->execute(array(
  'idtask' => $_GET['id']
));

header('Location:tasks.php');
