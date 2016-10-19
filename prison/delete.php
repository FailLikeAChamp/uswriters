<?php 
require_once('../app/start.php');

use \UsWriters\Models\Prison;

isAdminLoggedOut();

$prison_id = filter_input(INPUT_GET, 'prisonId', FILTER_SANITIZE_NUMBER_INT);

try {
	$prison = Writer::find($prison_id);	
	$prison_name = $prison->name;
} catch(ActiveRecord\RecordNotFound $e) {
	$flash->error("No prison associated with the id '{$prison_id}'", "edit");
	exit();
}

$prison->delete();

$flash->info("Prison '{$prison_name}' has been deleted!", "edit");