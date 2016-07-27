<?php 
require_once('../app/start.php');

use \UsWriters\Models\Writers2Contact;

isAdminLoggedOut();

$writer2contact = Writers2Contact::create($_POST);

if ($writer2contact->is_invalid()) {
	$error = $writer2contact->errors->full_messages();
	$flash->error($error[0], 'new-penpal');
	exit();
}

$flash->success("Penpal assigned!", "home");