<?php 
require_once('../app/start.php');

use \UsWriters\Models\Letter;

isWriterLoggedOut();

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$document = filter_input(INPUT_POST, 'letter', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$contact_id = filter_input(INPUT_POST, 'contact_id', FILTER_SANITIZE_NUMBER_INT);
$letter_id = filter_input(INPUT_POST, 'letter_id', FILTER_SANITIZE_NUMBER_INT);
$writer_id = (int)$_SESSION['writer_id'];


try {
	$letter = Letter::find($letter_id);
} catch (Exception $e) {
	$letter = new Letter();
	$letter->contact_id = $contact_id;
	$letter->writer_id = $writer_id;
}


if ($action == "delete") {
	$letter->status = "deleted";
	$flash->warning('Your letter has been deleted!', '../writer/home');
	exit();
}


$letter->document = $document;


if ($action == "save") {
	$letter->status = "pending";
	$letter->save();
	if ($letter->is_valid()) $flash->success('Your letter has been saved!', '../writer/home');
	exit();
}


if ($action == "send") {
	$letter->status = "ready";
	if ($letter->is_valid()) $flash->success('Your letter is waiting to be sent!', '../writer/home');
	exit();
}

	
$flash->error("Error: {$letter->errors->on('contact_id')}", '../writer/home');