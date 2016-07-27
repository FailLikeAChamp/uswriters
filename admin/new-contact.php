<?php 
require_once('../app/start.php');

use \UsWriters\Models\Prison;

isAdminLoggedOut();

$prisons = Prison::find('all', array('select' => 'id, name'));

echo $twig->render('@admin/new-contact.html.twig', array('prisons' => $prisons, 'flash' => $flash, 'username' => $_SESSION['admin_username']));