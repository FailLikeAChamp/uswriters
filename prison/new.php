<?php 
require_once('../app/start.php');

isAdminLoggedOut();

echo $twig->render('@admin/new-prison.html.twig', array('flash' => $flash, 'admin_id' => $_SESSION['admin_id'], 'username' => $_SESSION['admin_username']));