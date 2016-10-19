<?php
require_once('../app/start.php');

use \UsWriters\Models\ContactLetter;

$letterId = filter_input(INPUT_GET, 'letterId', FILTER_SANITIZE_NUMBER_INT);

try {
	$letter = ContactLetter::find($letterId);
	$contact = $letter->contact;
} catch(ActiveRecord\RecordNotFound $e) {
	$flash->error("Letter not found", "home");
	exit();
}

$file_name = $letter->file_name;
$file = $_SERVER['DOCUMENT_ROOT'] . "/../letters/$contact->prisoner_number/$file_name";
$filename = $file_name;

$letter->status = "read";
$letter->save();

header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="' . $filename . '"');
header('Content-Transfer-Encoding: binary');
header('Accept-Ranges: bytes');

readfile($file);
