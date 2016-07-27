<?php 
require_once('../app/start.php');

use \UsWriters\Models\Writer;

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$email = strtolower($email);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

$writer = Writer::find_by_email($email);

if($writer != null && $writer->login($password)) {
	$_SESSION['writer_id'] = $writer->id;
	$name = ucwords($writer->name);
	$flash->success("Welcome, {$name}", "home");
	exit();
}

$flash->error("Invalid password for email address '{$email}'", "login");