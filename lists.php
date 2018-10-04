<?php
session_start();

if (empty($_SESSION['id'])) {
  header('Location : index.php');
}

$title = "TDL - Accueil";
require 'header.php';
require 'db.php';

if (isset($_GET['id'])) {
  $_SESSION['idproject'] = $_GET['id'];
}

 
  $req_project = $bdd->prepare('SELECT *, DATE_FORMAT(deadline, "%d/%m/%Y") AS deadlinebis FROM projects WHERE id= :id');
  $req_project->execute(array(
    'id' => $_SESSION['idproject']
  ));

  $project = $req_project->fetch();

?>

<nav aria-label="breadcrumb" class="breadMargin pl-3">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="projects.php">Mes Projets</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?= $project['name'] ?></li>
  </ol>
</nav>

<div class="projectDetails w-100">
  <ul class=" bg-warning w-75 mx-auto px-5 py-3">
    <li>Nom du projet : <?= $project['name'] ?></li>
    <li>Description : <?= $project['description'] ?></li>
    <li>À finir pour le <?= $project['deadlinebis'] ?></li>
  </ul>
</div>

<div class="container-fluid py-5">
  <div class="row">
    <div class="col-md-9 borderFormRight pr-5">
      <p class="colTitle text-center">Mes Listes</p>
      <div class="row mx-auto">

    <?php


      $req = $bdd->prepare('SELECT id, name FROM lists WHERE id_project = :idproject');
      $req->execute(array(
        'idproject' => $_SESSION['idproject']
      ));
      $lists = $req->fetchAll();

      foreach ($lists as $list) {

        ?>

        <div class="col-md-4 col-sm-6">
          <div class="postitadd mt-3">
            <a href="deletelist.php?id=<?= $list['id'] ?>" class="delete">X</a>
            <p><?= $list['name'] ?></p>
            <ul class="list-unstyled">

            <?php

              $req = $bdd->prepare('SELECT name FROM tasks WHERE id_list = :idlist');
              $req->execute(array(
                'idlist' => $list['id']
              ));

              $tasks = $req->fetchAll();

              foreach ($tasks as $task) {

                ?>

                <li class="text-center"> <?= $task['name'] ?></li>

                <?php
              }

             ?>
             </ul>
            <a href="tasks.php?id=<?= $list['id'] ?>" class="text-center"><button type="button" class="btn btn-warning">Détails</button></a>
          </div>
        </div>
        <?php
      }
     ?>
     </div>
   </div>
   <!-- end of projectlist -->
   <div class="col-md-3 borderFormLeft d-flex flex-column pb-3">

     <p class="colTitle text-center">Ajouter une liste</p>

<?php



 ?>
     <div class="postit mx-auto mt-3 px-3">

       <form class="" action="addlist.php" method="post">
         <div class="form-group">
           <label for="exampleInputName">Nom de Liste</label>
           <input type="text" class="form-control" id="exampleInputName" name="name" placeholder="Faire mon évaluation" required>
         </div>
         <input type="hidden" name="id" value="<?= $_SESSION['idproject'] ?>">
         <button type="submit" name="addList" class="btn btn-warning">DO IT</button>

       </form>

     </div>

   </div>
   <!-- end of addPostIt col -->
  </div>
  <!-- end of row -->
</div>
<!-- end of container -->

<?php

// $req_lists = $bdd->prepare('SELECT name FROM lists WHERE id_project = :idproject');
// $req->execute(array(
//   'idproject' => $_GET['id']
// ));

?>
<?php
require 'footer.php';
 ?>
