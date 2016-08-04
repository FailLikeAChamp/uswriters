<?php 
require_once('../app/start.php');

use \UsWriters\Models\Writers2contact;

isAdminLoggedOut();

$writer_id = $_POST['writer_id'];
$contact_id = $_POST['contact_id'];

$writer2contact = Writers2contact::exists(array('conditions' => array('writer_id = ? and contact_id = ?', $writer_id, $contact_id)));

if ($writer2contact) {
	$flash->error("They are penpals already!", 'new-penpal');
	exit();
}

$writer2contact = Writers2contact::create($_POST);

if ($writer2contact->is_invalid()) {
	$error = $writer2contact->errors->full_messages();
	$flash->error($error[0], 'new-penpal');
	exit();
}

$flash->success("Penpal assigned!", "home");