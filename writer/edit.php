<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../app/start.php');

use \UsWriters\Models\Writer;

isAdminLoggedOut();

$writer = "";

if (isset($_POST['writer_id'])) {
	$writer = Writer::find($_POST['writer_id']);
}

$allWriters = Writer::all();

echo $twig->render('@admin/edit-writer.html.twig', array('writer' => $writer, 'allWriters' => $allWriters));