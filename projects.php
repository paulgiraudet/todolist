<?php
session_start();

$title = "TDL - Accueil";
require 'header.php';
 ?>

<h1 class="text-center text-white">Tout Doux Liste</h1>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-9 borderFormRight">

    <?php

      require 'db.php';

      $req = $bdd->prepare('SELECT name FROM projects WHERE id_user = :id_user');
      $req->execute(array(
        'id_user' => $_SESSION['id']
      ));
      $projects = $req->fetchAll();

      foreach ($projects as $project) {

        ?>

        <div class="col-md-3 col-sm-6">
          <div class="postit">
            <?= $project['name'] ?>
          </div>
        </div>
        <?php
      }
     ?>
   </div>
   <!-- end of projectlist -->
   <div class="col-md-3 borderFormLeft d-flex flex-column pb-3">

     <p class="colTitle text-center">Ajouter un projet</p>

     <div class="postitadd mx-auto">

       <form class="" action="index.php" method="post">
         <div class="form-group">
           <label for="exampleInputName">Nom du Projet</label>
           <input type="text" class="form-control" id="exampleInputName" placeholder="Faire mon évaluation" required>
         </div>
         <div class="form-group">
           <label for="exampleFormControlTextarea1">Description</label>
           <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
         </div>
         <div class="form-group">
           <label for="exampleFormControlDate">DeadLine</label>
           <input type="date" name="date" id="exampleFormControlDate" required>
         </div>

         <button type="submit" name="addProject" class="btn btn-warning">Nouveau projet</button>

       </form>

     </div>

   </div>
   <!-- end of addPostIt col -->
  </div>
  <!-- end of row -->
</div>
<!-- end of container -->



<?php
require 'footer.php';
 ?>
