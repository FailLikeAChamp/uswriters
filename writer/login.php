<?php 
require_once('../app/start.php');

isWriterLoggedIn();

echo $twig->render('@writer/login.html.twig', array('flash' => $flash));