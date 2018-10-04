<?php
//starting session at the start of each page
session_start();

//we stop the session and go back to the main page
session_destroy();
header('location: index.php');
exit;
?>
