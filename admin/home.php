<?php 
require_once('../app/start.php');

if (isset($_POST['username']) && isset($_POST['password'])) {
	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
	authenticateAdmin($username, $password, $twig, $flash);
}

isAdminLoggedOut();

echo $twig->render('@admin/home.html.twig', array(
	'flash' => $flash, 
	'username' => $_SESSION['admin_username']
));