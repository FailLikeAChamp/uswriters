<?php 
require_once('../app/start.php');

isAdminLoggedOut();

echo $twig->render('@admin/new-writer.html.twig', array(
		'flash' => $flash, 
		'admin_id' => $_SESSION['admin_id'], 
		'username' => $_SESSION['admin_username']
));