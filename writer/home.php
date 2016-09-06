<?php 
require_once('../app/start.php');

use \UsWriters\Models\Writer;

isWriterLoggedOut();

// get user
$writer = Writer::find($_SESSION['writer_id']);

// get saved drafts & sent letters
// $draftLetters = $writer->getDrafts();
// $sentLetters = $writer->getSentLetters();
// $myLetters = array_merge($draftLetters, $sentLetters);
$writerLetters = $writer->getDraftsAndSentLetters();

// get unread letters and letters that have been read
$contactLetters = $writer->getUnreadAndReadLetters();

echo $twig->render('@writer/home.html.twig', array(
		'myLetters' => $writerLetters,
		'contactLetters' => $contactLetters,
		'flash' => $flash, 
		'username' => $_SESSION['writer_name']
));