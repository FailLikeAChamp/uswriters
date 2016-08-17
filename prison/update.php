<?php 
require_once('../app/start.php');

use \UsWriters\Models\Prison;

isAdminLoggedOut();

$prison_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

try {
	$prison = Prison::find($prison_id);
} catch(ActiveRecord\RecordNotFound $e) {
	$flash->error("No prison found with id '{$prison_id}'", 'edit');
}

$prison->update_attributes($_POST);

if ($prison->is_invalid()) {
	$error = $prison->errors->full_messages();
	$flash->error($error[0], 'edit');
	exit();
}

$name = ucwords($prison->name);

$flash->success("{$name} prison successfully updated!", "edit");