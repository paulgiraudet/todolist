<?php

if (isset($_POST['addUser'])) {

  // Validation tests

  // basic verification on our inputs
  if (isset($_POST['pseudo']) AND !empty($_POST['pseudo']) AND
      isset($_POST['password']) AND !empty($_POST['password']) AND
      isset($_POST['passwordbis']) AND !empty($_POST['passwordbis']) AND
      isset($_POST['email']) AND !empty($_POST['email'])) {

        //avoiding any dangerous html tag
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $password = htmlspecialchars($_POST['password']);
        $passwordbis = htmlspecialchars($_POST['passwordbis']);
        $email = htmlspecialchars($_POST['email']);

        // asking in our table if we already have a pseudo with this name
        $reqPseudo = $bdd->prepare('SELECT nickname FROM members WHERE nickname = :pseudo');
        $reqPseudo->execute(array(
          'pseudo' => $pseudo
        ));
        // if there is one he is unique
        $samePseudo = $reqPseudo->fetch();

        // if there is one this condition is correct else we continue our tests
        if ($samePseudo['pseudo'] == $pseudo) {
          echo "<p class='text-white'>Ce pseudo est déjà utilisé, choisissez en un autre</p>";
        }

        // verifying if the two passwords are the same one
        else if ($password != $passwordbis) {
          echo "<p class='text-white'>Les deux mots de passe ne sont pas identiques</p>";
        }

        // regex for email verification
        else if (preg_match("#^[a-z0-9-_.]+@[a-z0-9-_.]{2,}\.[a-z]{2,4}$#", $email)) {

          // if we passed all the tests we finally go there

            //crypting password for our database
            $pass_hache = password_hash($password, PASSWORD_DEFAULT);

            // Insertion
            $req = $bdd->prepare('INSERT INTO members(nickname, password, email) VALUES(:pseudo, :pass, :email)');
            $req->execute(array(
              'pseudo' => $pseudo,
              'pass' => $pass_hache,
              'email' => $email
            ));

            echo "<p class='text-white'>Vous avez bien été inscrit(e) !</p>";

          }

        else {
          echo "<p class='text-white'>Votre email est invalide.</p>";
        }

    } //end of tests

  //in case someone tried to erase our required inputs
  else {
    echo "<p class='text-white'>Au moins un champ est invalide.</p>";
  }

}
