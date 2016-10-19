<?php 
require_once('../app/start.php');

use \UsWriters\Models\Writer;

isAdminLoggedOut();

$writer_id = filter_input(INPUT_GET, 'writerId', FILTER_SANITIZE_NUMBER_INT);

try {
	$writer = Writer::find($writer_id);	
	$writer_name = $writer->name;
} catch(ActiveRecord\RecordNotFound $e) {
	$flash->error("No writer associated with the id '{$writer_id}'", "edit");
	exit();
}

$writer->delete();

$flash->info("Writer '{$writer_name}' has been deleted!", "edit");