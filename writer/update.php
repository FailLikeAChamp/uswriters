<?php 
require_once('../app/start.php');

use \UsWriters\Models\Writer;

isAdminLoggedOut();

$writer = Writer::find($_POST['id']);

$writer->update_attributes($_POST);

if ($writer->is_invalid()) {
	$error = $writer->errors->full_messages();
	$flash->error($error[0], 'edit');
	exit();
}

$name = ucwords($writer->name);

$flash->success("Writer '{$name}' successfully updated!", "edit");