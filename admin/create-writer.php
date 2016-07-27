<?php 
require_once('../app/start.php');

use \UsWriters\Models\Writer;

isAdminLoggedOut();

$writer = Writer::create($_POST);

if ($writer->is_invalid()) {
	$error = $writer->errors->full_messages();
	$flash->error($error[0], 'new-writer');
	exit();
}

$name = ucwords($writer->name);

$flash->success("Writer '{$name}' created successfully!", "home");