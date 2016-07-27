<?php 
require_once('../app/start.php');

isAdminLoggedIn();

echo $twig->render('@admin/login.html.twig', array('flash' => $flash));