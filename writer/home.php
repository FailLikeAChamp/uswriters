<?php 
require_once('../app/start.php');

use \UsWriters\Models\Writer;
use \UsWriters\Models\Letter;

isWriterLoggedOut();

// get user
$writer = Writer::find($_SESSION['writer_id']);

// get saved drafts & sent letters
$writerLetters = $writer->getLetters();

// get contact letters
$contactLetters = $writer->getContactLetters();

echo $twig->render('@writer/home.html.twig', array(
		'myLetters' => $writerLetters,
		'contactLetters' => $contactLetters,
		'flash' => $flash, 
		'username' => $_SESSION['writer_name']
));