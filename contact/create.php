<?php 
require_once('../app/start.php');

use \UsWriters\Models\Contact;

isAdminLoggedOut();

$contact = Contact::create($_POST);

if ($contact->is_invalid()) {
	$error = $contact->errors->full_messages();
	$flash->error($error[0], 'new');
	exit();
}

$name = ucwords($contact->name);

$flash->success("Contact '{$name}' created successfully!", "../admin/home");