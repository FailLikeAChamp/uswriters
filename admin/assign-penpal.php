<?php 
require_once('../app/start.php');

use \UsWriters\Models\Writers2contact;

isAdminLoggedOut();

$writer_id = filter_input(INPUT_POST, 'writer_id', FILTER_SANITIZE_NUMBER_INT);
$contact_id = filter_input(INPUT_POST, 'contact_id', FILTER_SANITIZE_NUMBER_INT);

 if ($writer_id == 0 || $contact_id == 0) {
 	$flash->error("Must select a contact and writer", "new-penpal");
 }

$writer2contact = Writers2contact::exists(array('conditions' => array('writer_id = ? and contact_id = ?', $writer_id, $contact_id)));

if ($writer2contact) {
	$flash->error("They are penpals already!", "new-penpal");
	exit();
}

$writer2contact = Writers2contact::create(array(
	'contact_id' => $contact_id, 
	'writer_id' => $writer_id
));

if ($writer2contact->is_invalid()) {
	$error = $writer2contact->errors->full_messages();
	$flash->error($error[0], 'new-penpal');
	exit();
}

$flash->success("Penpal assigned!", "home");