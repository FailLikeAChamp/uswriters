<?php
require_once('../start.php');

use \UsWriters\Models\Letter;

$letter_id = filter_input(INPUT_GET, 'letter_id', FILTER_SANITIZE_NUMBER_INT);

try {
	$letter = Letter::find($letter_id);
} catch(ActiveRecord\RecordNotFound $e) {
	echo "error";
	exit();
}

echo $letter->getHtmlVersion();