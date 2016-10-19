<?php 
require_once('../app/start.php');

use \UsWriters\Models\Contact;

isAdminLoggedOut();

$contact_id = filter_input(INPUT_GET, 'contactId', FILTER_SANITIZE_NUMBER_INT);

try {
	$contact = Contact::find($contact_id);	
	$contact_name = $contact->name;
} catch(ActiveRecord\RecordNotFound $e) {
	$flash->error("No contact associated with the id '{$contact_id}'", "edit");
	exit();
}

$contact->delete();

$flash->info("Writer '{$contact_name}' has been deleted!", "edit");