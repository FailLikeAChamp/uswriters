<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('../app/start.php');

use \UsWriters\Models\Writer;

isAdminLoggedOut();

$writer_id = filter_input(INPUT_POST, 'writer_id', FILTER_SANITIZE_NUMBER_INT);
$availableContacts = array();
$assignedContacts = array();

try {
	$writer = Writer::find($writer_id);
	$allWriters = Writer::all();
	if ($writer_id > 0) {
		$availableContacts = $writer->availableContacts();
		$assignedContacts = $writer->assignedContacts();
	}
	echo $twig->render('@admin/edit-writer.html.twig', array(
			'flash' => $flash, 
			'writer' => $writer, 
			'allWriters' => $allWriters, 
			'availableContacts' => $availableContacts,
			'assignedContacts' => $assignedContacts,  
			'username' => $_SESSION['admin_username']
	));
} catch(ActiveRecord\RecordNotFound $e) {
	$flash->error("No writer associated with the id '{$writer_id}'", "edit");
}