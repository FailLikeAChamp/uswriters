<?php 
require_once('../app/start.php');

use \UsWriters\Models\Prison;

isAdminLoggedOut();

$prison_id = filter_input(INPUT_POST, 'prison_id', FILTER_SANITIZE_NUMBER_INT);

try {
	$prison = Prison::find($prison_id);
	$allPrisons = Prison::all();
	echo $twig->render('@admin/edit-prison.html.twig', array(
			'flash' => $flash, 
			'prison' => $prison, 
			'allPrisons' => $allPrisons, 
			'username' => $_SESSION['admin_username']
	));
} catch (ActiveRecord\RecordNotFound $e) {
	$flash->error("No prison is associated with the id '{$prison_id}'", "edit");
}