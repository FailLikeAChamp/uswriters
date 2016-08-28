<?php 
require_once('../app/start.php');

use \UsWriters\Models\Letter;
use \UsWriters\Models\Writer;

isWriterLoggedOut();

$letter_id = filter_input(INPUT_GET, 'letter_id', FILTER_SANITIZE_NUMBER_INT);

$writer = Writer::find($_SESSION['writer_id']);

try {
	$letter = Letter::find($letter_id);
} catch(ActiveRecord\RecordNotFound $e) {
	$letter = null;
}

$contacts = array();

foreach ($writer->contacts as $contact) {
	$contacts[] = $contact;
}

echo $twig->render('@writer/write.html.twig', array(
		'contacts' => $contacts, 
		'letter' => $letter, 
		'flash' => $flash, 
		'username' => $_SESSION['writer_name']
));