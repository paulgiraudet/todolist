<?php

session_start();
require 'db.php';
echo "koko";

if (isset($_POST['changeProfile'])) {

  echo "un";
  if (isset($_POST['email']) AND !empty($_POST['email']) AND
      isset($_POST['password']) AND !empty($_POST['password'])) {

  echo "deux";
        $password = htmlspecialchars($_POST['password']);
        $email = htmlspecialchars($_POST['email']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $firstname = htmlspecialchars($_POST['firstname']);
        $age = $_POST['age'];

        $req_infoProfile = $bdd->prepare('SELECT password from members WHERE id = :iduser');
        $req_infoProfile->execute(array(
          'iduser' => $_SESSION['id']
        ));

        $result = $req_infoProfile->fetch();

        $isPasswordCorrect = password_verify($password, $result['password']);

        if ($isPasswordCorrect) {

          if (preg_match("#^[a-z0-9-_.]+@[a-z0-9-_.]{2,}\.[a-z]{2,4}$#", $email)) {

            $req_updateProfile = $bdd->prepare('UPDATE members SET lastname = :lastname, firstname = :firstname, age = :age, email = :email');
            $req_updateProfile->execute(array(
              'lastname' => $lastname,
              'firstname' => $firstname,
              'email' => $email,
              'age' => $age
            ));
          }
          else{
            echo "toto";
          }
        }
        else{
          echo "Mauvais mot de passe";
        }
  }
  else{
    echo "tata";
  }
}
else{
  echo "totooo";
}

header('Location: profile.php');
 ?>
