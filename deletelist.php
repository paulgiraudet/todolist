<?php

session_start();

require 'db.php';

$req = $bdd->prepare('DELETE FROM lists WHERE id= :idlist');
$req->execute(array(
  'idlist' => $_GET['id']
));

header('Location:lists.php');
