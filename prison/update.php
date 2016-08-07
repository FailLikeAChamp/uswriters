<?php 
require_once('../app/start.php');

use \UsWriters\Models\Prison;

isAdminLoggedOut();

$prison = Prison::find($_POST['id']);

$prison->update_attributes($_POST);

if ($prison->is_invalid()) {
	$error = $prison->errors->full_messages();
	$flash->error($error[0], 'edit');
	exit();
}

$name = ucwords($prison->name);

$flash->success("{$name} prison successfully updated!", "edit");