<?php

if (isset($_POST['connectUser'])) {

  $pseudo = htmlspecialchars($_POST['pseudo']);
  $password = htmlspecialchars($_POST['password']);

  //  Récupération de l'utilisateur et de son pass hashé
  $req = $bdd->prepare('SELECT id, password FROM members WHERE nickname = :pseudo');
  $req->execute(array(
    'pseudo' => $pseudo
  ));
  $resultat = $req->fetch();

  // Comparaison du pass envoyé via le formulaire avec la base
  $isPasswordCorrect = password_verify($password, $resultat['password']);

     // checking isset pseudo
     if (!$resultat)
     {
       echo "<p class='text-white'>Mauvais identifiant ou mot de passe !</p>";
     }
     else
     {
       if ($isPasswordCorrect) {
         session_start();
         $_SESSION['id'] = $resultat['id'];
         $_SESSION['pseudo'] = $pseudo;
         header('Location: projects.php');

       }
       else {
         echo "<p class='text-white'>Mauvais identifiant ou mot de passe !</p>";
       }
     }
}
