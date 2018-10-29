<?php

session_start();

require 'db.php';

//deleteing the list with the good id
$req = $bdd->prepare('DELETE FROM lists WHERE id= :idlist');
$req->execute(array(
  'idlist' => $_GET['id']
));

header('Location:lists.php');
