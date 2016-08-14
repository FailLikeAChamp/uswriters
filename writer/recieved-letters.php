<?php 
require_once('../app/start.php');

use \UsWriters\Models\Writer;

isWriterLoggedOut();

$writer = Writer::find($_SESSION['writer_id']);

$contacts = array();

foreach ($writer->contacts as $contact) {
	$contacts[] = $contact;
}

echo $twig->render('@writer/recieved-letters.html.twig', array(
		'contacts' => $contacts, 
		'flash' => $flash, 
		'username' => $_SESSION['writer_name']
));