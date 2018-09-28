<?php
session_start();

$title = "TDL - Accueil";
require 'header.php';
require 'db.php';

if (isset($_GET['id'])) {
  $_SESSION['idlist'] = $_GET['id'];
}
 ?>

<h1 class="text-center text-white">Tout Doux Liste</h1>


<?php

  $req_list = $bdd->prepare('SELECT * FROM lists WHERE id= :id');
  $req_list->execute(array(
    'id' => $_SESSION['idlist']
  ));

  $list = $req_list->fetch();

 ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-6">
      <div class="postitList mt-3">

        <p><?= $list['name'] ?></p></br>

          <ul class="list-unstyled">

        <?php

          $req_tasks = $bdd->prepare('SELECT name, DATE_FORMAT(deadline, "%d/%m/%Y") AS deadlinebis FROM tasks WHERE id_list = :idlist ORDER BY deadline');
          $req_tasks->execute(array(
            'idlist' => $_SESSION['idlist']
          ));

          $tasks = $req_tasks->fetchAll();

          foreach ($tasks as $task) {

            ?>
              <li class="text-center"> <?= $task['name'] ?> - <i><?= $task['deadlinebis'] ?></i></li>
            <?php
          }

         ?>

         </ul>

      </div>
    </div>
    <div class="col-sm-6">

      <div class="postitList mx-auto mt-3">

        <form class="" action="addtask.php" method="post">
          <div class="form-group">
            <label for="exampleInputName">Nom de la tâche</label>
            <input type="text" class="form-control" id="exampleInputName" name="name" placeholder="Faire mon évaluation" required>
          </div>
          <div class="form-group">
            <label for="exampleFormControlDate">DeadLine</label>
            <input type="date" name="date" id="exampleFormControlDate" min="<?= $date=date("Y-m-d") ?>" value="<?= $date ?>" required>
          </div>

          <button type="submit" name="addTask" class="btn btn-warning">Nouvelle tâche</button>

        </form>

      </div>

    </div>
  </div>
</div>
