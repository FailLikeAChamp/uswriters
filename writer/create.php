<?php 
require_once('../app/start.php');

use \UsWriters\Models\Writer;

isAdminLoggedOut();

$writer = new Writer();

$writer->display_name = trim($_POST['username']);
$writer->username = trim($_POST['username']);
$writer->password = trim($_POST['password']);
$writer->name = trim($_POST['name']);
$writer->address_1 = trim($_POST['address_1']);
$writer->address_2 = trim($_POST['address_2']);
$writer->city = trim($_POST['city']);
$writer->state = $_POST['state'];
$writer->postal_code = trim($_POST['postal_code']);
$writer->phone = $_POST['phone'];
$writer->email = trim($_POST['email']);
$writer->gender = $_POST['gender'];


if ($writer->is_invalid()) {
	$error = $writer->errors->full_messages();
	$flash->error($error[0], 'new');
	exit();
}

$writer->save();

$flash->success("Writer '{$writer->display_name}' created!", "../admin/home");