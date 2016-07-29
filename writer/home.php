<?php 
require_once('../app/start.php');

use \UsWriters\Models\Writer;

if (isset($_POST['email']) && isset($_POST['password'])) {
	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
	authenticateWriter($email, $password);
}

isWriterLoggedOut();

$writer = Writer::find($_SESSION['writer_id']);

$contacts = array();

foreach ($writer->contacts as $contact) {
	$contacts[] = $contact;
}

echo $twig->render('@writer/home.html.twig', array(
	'contacts' => $contacts, 'flash' => $flash
));