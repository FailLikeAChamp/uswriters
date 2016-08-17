<?php 
require_once('../app/start.php');

use \UsWriters\Models\Writer;

isAdminLoggedOut();

$writer_id = filter_input(INPUT_POST, 'writer_id', FILTER_SANITIZE_NUMBER_INT);

try {
	$writer = Writer::find($writer_id);
	$allWriters = Writer::all();
	echo $twig->render('@admin/edit-writer.html.twig', array(
			'flash' => $flash, 
			'writer' => $writer, 
			'allWriters' => $allWriters, 
			'username' => $_SESSION['admin_username']
	));
} catch(ActiveRecord\RecordNotFound $e) {
	$flash->error("No writer associated with the id '{$writer_id}'", "edit");
}