<?php 
require_once('../app/start.php');

use \UsWriters\Models\Writer;

isWriterLoggedOut();

$writer = Writer::find($_SESSION['writer_id']);

$drafts = $writer->getDrafts();

$unreadLetters = $writer->getUnreadLetters();

echo $twig->render('@writer/home.html.twig', array(
		'drafts' => $drafts,
		'unreadLetters' => $unreadLetters,
		'flash' => $flash, 
		'username' => $_SESSION['writer_name']
));