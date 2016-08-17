<?php 
use \UsWriters\Models\Admin;
use \UsWriters\Models\Writer;

function authenticateAdmin($username, $password)
{
	global $flash;
	global $twig;
	$username = strtolower($username);
	$admin = Admin::find_by_username($username);

	if ($admin != null && $admin->login($password)) {
		$_SESSION['admin_id'] = $admin->id;
		$_SESSION['admin_username'] = $admin->username;
		$twig->addGlobal('username', $admin->username);
		header("location: /uswriters/admin/home");
		exit();
	}

	$flash->error("Invalid password for username '{$username}'", "/uswriters/admin/login");
	exit();
}

function authenticateWriter($email, $password)
{
	global $flash;
	global $twig;
	$email = strtolower($email);
	$writer = Writer::find_by_email($email);

	if($writer != null && $writer->login($password)) {
		$_SESSION['writer_id'] = $writer->id;
		$_SESSION['writer_name'] = $writer->name;
		$name = ucwords($writer->name);
		header("location: /uswriters/writer/home");
		// $flash->info("Welcome, {$name}", "/uswriters/writer/home");
		exit();
	}

	$flash->error("Invalid password for email address '{$email}'", "/uswriters/writer/login");
	exit();
}

function isWriterLoggedOut() 
{
	if (!isset($_SESSION['writer_id'])) header("location: /uswriters/writer/login");
}

function isWriterLoggedIn() 
{
	if (isset($_SESSION['writer_id'])) header("location: /uswriters/writer/home");
}

function isAdminLoggedOut() 
{
	if (!isset($_SESSION['admin_id'])) header("location: /uswriters/admin/login");
}

function isAdminLoggedIn() 
{
	if (isset($_SESSION['admin_id'])) header("location: /uswriters/admin/home");
}