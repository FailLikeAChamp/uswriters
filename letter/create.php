<?php 
require_once('../app/start.php');

use \UsWriters\Models\Letter;

isWriterLoggedOut();

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$document = filter_input(INPUT_POST, 'letter', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$contact_id = filter_input(INPUT_POST, 'contact_id', FILTER_SANITIZE_NUMBER_INT);
$letter_id = filter_input(INPUT_POST, 'letter_id', FILTER_SANITIZE_NUMBER_INT);
$writer_id = (int)$_SESSION['writer_id'];

$date = Date('Y-m-d H:i:s');

try {
	$letter = Letter::find($letter_id);
} catch (ActiveRecord\RecordNotFound $e) {
	$letter = new Letter();
}

$letter->contact_id = $contact_id;
$letter->writer_id = $writer_id;
$letter->document = $document;

if ($action == "delete") {
	$letter->status = "deleted";
	$letter->saved_date = $date;
	$letter->save();
	$flash->warning('Your letter has been deleted!', '../writer/home');
	exit();
}


if ($action == "save") {
	$letter->status = "saved";
	$letter->saved_date = $date;
	$letter->submitted_date = null;
	$letter->save();
	if ($letter->is_valid()) {
		$flash->success('Your letter has been saved!', '../writer/home');
		exit();
	}
}


if ($action == "submit") {
	$letter->status = "submitted";
	$letter->saved_date = $date;
	$letter->submitted_date = $date;
	$letter->save();
	if ($letter->is_valid()) {
		$flash->success('Your letter has been submitted!', '../writer/home');
		exit();
	}
}

$flash->error("Server Error: If this problem persists, please contact an administrator.", '../writer/home');