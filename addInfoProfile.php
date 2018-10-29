<?php

session_start();
require 'db.php';

//checking if we come from profile page
if (isset($_POST['changeProfile'])) {

  if (isset($_POST['email']) AND !empty($_POST['email']) AND
      isset($_POST['password']) AND !empty($_POST['password'])) {

        //avoiding scripts insertion
        $password = htmlspecialchars($_POST['password']);
        $email = htmlspecialchars($_POST['email']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $firstname = htmlspecialchars($_POST['firstname']);
        $age = $_POST['age'];

        //getting the good profile with the session id
        $req_infoProfile = $bdd->prepare('SELECT password from members WHERE id = :iduser');
        $req_infoProfile->execute(array(
          'iduser' => $_SESSION['id']
        ));

        $result = $req_infoProfile->fetch();

        $isPasswordCorrect = password_verify($password, $result['password']);

        //password required to do any modification
        if ($isPasswordCorrect) {

          //regex for email
          if (preg_match("#^[a-z0-9-_.]+@[a-z0-9-_.]{2,}\.[a-z]{2,4}$#", $email)) {

            //updating profile
            $req_updateProfile = $bdd->prepare('UPDATE members SET lastname = :lastname, firstname = :firstname, age = :age, email = :email');
            $req_updateProfile->execute(array(
              'lastname' => $lastname,
              'firstname' => $firstname,
              'email' => $email,
              'age' => $age
            ));
          }
          else{
            echo "adresse mail incorrecte";
          }
        }
        else{
          echo "Mauvais mot de passe";
        }
  }
  else{
    echo "champs incorrects";
  }
}
else{
  echo "Vous n'êtes pas censé être la";
}

header('Location: profile.php');
 ?>
