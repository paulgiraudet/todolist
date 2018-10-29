<?php
session_start();

//afk security
if (empty($_SESSION['id'])) {
  header('Location : index.php');
}

$title = "TDL - Mes tâches";
require 'header.php';
require 'db.php';

//getting the id list for our linked tasks
if (isset($_GET['id'])) {
  $_SESSION['idlist'] = $_GET['id'];
}

//getting the correct list project
$req_project = $bdd->prepare('SELECT *, DATE_FORMAT(deadline, "%d/%m/%Y") AS deadlinebis FROM projects WHERE id= :id');
$req_project->execute(array(
  'id' => $_SESSION['idproject']
));

$project = $req_project->fetch();

//getting list content
$req_list = $bdd->prepare('SELECT * FROM lists WHERE id= :id');
$req_list->execute(array(
  'id' => $_SESSION['idlist']
));

$list = $req_list->fetch();

?>

<!-- displaying breadcrumb -->
 <nav aria-label="breadcrumb" class="breadMargin pl-3">
   <ol class="breadcrumb">
     <li class="breadcrumb-item"><a href="projects.php">Mes Projets</a></li>
     <li class="breadcrumb-item" aria-current="page"><a href="lists.php"><?= $project['name'] ?></a></li>
     <li class="breadcrumb-item active" aria-current="page"><?= $list['name'] ?></li>
   </ol>
 </nav>


<div class="container-fluid">
  <div class="row">
    <div class="col-sm-6">
      <div class="postitList mt-3">

        <p><?= $list['name'] ?></p></br>

          <ul class="list-unstyled taskManagement">

        <?php
          //getting all tasks details for our linked list
          $req_tasks = $bdd->prepare('SELECT id, name, do_done, DATE_FORMAT(deadline, "%d/%m/%Y") AS deadlinebis FROM tasks WHERE id_list = :idlist ORDER BY deadline');
          $req_tasks->execute(array(
            'idlist' => $_SESSION['idlist']
          ));

          $tasks = $req_tasks->fetchAll();

          //displaying each task one by one with its particularity
          foreach ($tasks as $task) {

            //displaying if a task has to be done or not with class dotask/donetask
            if ($task['do_done']==0) {
              ?>
                <li class="text-center"> <a href="validtask.php?id=<?= $task['id'] ?>&dodone=<?= $task['do_done'] ?>" class="dotask"><?= $task['name'] ?> - <i><?= $task['deadlinebis'] ?></i></a>
              <?php
            }
            else{
              ?>
                <li class="text-center"> <a href="validtask.php?id=<?= $task['id'] ?>&dodone=<?= $task['do_done'] ?>" class="donetask"><?= $task['name'] ?> - <i><?= $task['deadlinebis'] ?></i></a>
              <?php
            }
            ?>
            <a href="deletetask.php?id=<?= $task['id'] ?>" class="deleteTask">X</a></li>
          <?php
          }

         ?>

         </ul>

      </div>
    </div>

    <!-- addTaskForm -->
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
