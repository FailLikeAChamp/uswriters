<?php 
require_once('../app/start.php');

if (isset($_POST['email']) && isset($_POST['password'])) {
	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
	authenticateWriter($email, $password);
}

isWriterLoggedIn();

echo $twig->render('@writer/login.html.twig', array('flash' => $flash));