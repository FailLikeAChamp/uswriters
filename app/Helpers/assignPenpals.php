<?php
require_once('../start.php');

use \UsWriters\Models\Writers2contact;

$contact_id = filter_input(INPUT_GET, 'contactId', FILTER_SANITIZE_NUMBER_INT);
$writer_id = filter_input(INPUT_GET, 'writerId', FILTER_SANITIZE_NUMBER_INT);
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$response = "";

if ($action == 'delete') {
	try {
		$r = Writers2contact::delete_all(array('conditions' => array('contact_id = ? AND writer_id = ?', $contact_id, $writer_id)));
		
		if ($r > 0) {
			$response = "Record deleted";
		} else {
			$response = "Record not found";
		}

	} catch(Exception $e) {
		$response = var_dump($e->getMessage());
	}
}

if ($action == 'insert') {
	try {
		$w2c = new Writers2contact();
		$w2c->contact_id = $contact_id;
		$w2c->writer_id = $writer_id;
		$w2c->save();
	} catch(Exception $e) {
		
	}

	if ($w2c->is_invalid()) {
		$response = "Could not insert record";
	} else {
		$response = "Inserted record";
	}
}

echo $response;