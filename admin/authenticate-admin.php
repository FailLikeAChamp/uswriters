<?php 
require_once('../app/start.php');

use \UsWriters\Models\Admin;

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$username = strtolower($username);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

$admin = Admin::find_by_username($username);

if ($admin != null && $admin->login($password)) {
	$_SESSION['admin_id'] = $admin->id;
	$_SESSION['admin_username'] = $admin->username;
	$twig->addGlobal('username', $admin->username);
	header("location: home");
	exit();
}

$flash->error("Invalid password for username '{$username}'", "login");