<?php 
require_once('../app/start.php');

use \UsWriters\Models\Contact;

isAdminLoggedOut();

$contact = Contact::find($_POST['id']);

$contact->update_attributes($_POST);

if ($contact->is_invalid()) {
	$error = $contact->errors->full_messages();
	$flash->error($error[0], 'edit');
	exit();
}

$name = ucwords($contact->name);

$flash->success("Contact '{$name}' successfully updated!", "edit");