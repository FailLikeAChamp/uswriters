<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../app/start.php');

isWriterLoggedIn();

echo $twig->render('@writer/login.html.twig', array('flash' => $flash));