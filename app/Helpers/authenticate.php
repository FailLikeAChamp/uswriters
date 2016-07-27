<?php 

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