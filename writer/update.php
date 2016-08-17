<?php 
require_once('../app/start.php');

use \UsWriters\Models\Writer;

isAdminLoggedOut();

$writer_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

try {
	$writer = Writer::find($writer_id);	
} catch(ActiveRecord\RecordNotFound $e) {
	$flash->error("No writer associated with the id '{$writer_id}'", "edit");
}

$writer->update_attributes($_POST);

if ($writer->is_invalid()) {
	$error = $writer->errors->full_messages();
	$flash->error($error[0], 'edit');
	exit();
}

$name = ucwords($writer->name);

$flash->success("Writer '{$name}' successfully updated!", "edit");