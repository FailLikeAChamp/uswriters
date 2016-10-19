<?php
require_once('../start.php');

use \UsWriters\Models\Letter;

$letter_id = filter_input(INPUT_GET, 'letter_id', FILTER_SANITIZE_NUMBER_INT);

try {
	$letter = Letter::find($letter_id);
	$contact_address = $letter->contact->getPrisonHtmlAddress();
} catch(ActiveRecord\RecordNotFound $e) {
	echo "error";
	exit();
}

echo $contact_address . $letter->getHtmlVersion();