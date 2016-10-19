<?php 
require_once('../start.php');

use \UsWriters\Models\Letter;

$letter_id = filter_input(INPUT_POST, 'letterId', FILTER_SANITIZE_NUMBER_INT);

try {
	$letter = Letter::find($letter_id);
} catch (ActiveRecord\RecordNotFound $e) {
	echo "no letter found";
	exit();
}

$letter->status = "sent";
$letter->save();

if ($letter->is_valid()) {
	echo "success";
	exit();
}

echo "error saving letter";


