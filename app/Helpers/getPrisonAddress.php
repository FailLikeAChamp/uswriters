<?php 
require_once('../start.php');

use \UsWriters\Models\Contact;

$contact_id = filter_input(INPUT_GET, 'contact_id', FILTER_SANITIZE_NUMBER_INT);

$contact = Contact::find($contact_id);

echo $contact->getPrisonHtmlAddress();