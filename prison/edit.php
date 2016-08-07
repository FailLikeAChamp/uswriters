<?php 
require_once('../app/start.php');

use \UsWriters\Models\Prison;

isAdminLoggedOut();

$prison = "";

if (isset($_POST['prison_id'])) {
	$prison = Prison::find($_POST['prison_id']);
}

$allPrisons = Prison::all();

echo $twig->render('@admin/edit-prison.html.twig', array('flash' => $flash, 'prison' => $prison, 'allPrisons' => $allPrisons, 'username' => $_SESSION['admin_username']));