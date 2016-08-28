<?php 
require("../app/start.php");

isAdminLoggedOut();

echo $twig->render('@admin/upload.html.twig', array('username' => $_SESSION['admin_username']));