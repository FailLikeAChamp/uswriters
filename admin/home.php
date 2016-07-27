<?php 
require_once('../app/start.php');

isAdminLoggedOut();

echo $twig->render('@admin/home.html.twig', array('flash' => $flash, 'username' => $_SESSION['admin_username']));