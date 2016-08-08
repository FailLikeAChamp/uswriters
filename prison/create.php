<?php 
require_once('../app/start.php');

use \UsWriters\Models\Prison;

isAdminLoggedOut();

$prison = Prison::create($_POST);

if ($prison->is_invalid()) {
	$error = $prison->errors->full_messages();
	$flash->error($error[0], 'new');
	exit();
}

$name = ucwords($prison->name);

$flash->success("'{$name}' prison created successfully!", "../admin/home");