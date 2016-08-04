<?php 
require_once('../app/start.php');

use \UsWriters\Models\Contact;

isAdminLoggedOut();

$contacts = Contact::find('all', array('select' => 'id, name'));

echo $twig->render('@admin/new-writer.html.twig', array('contacts' => $contacts, 'flash' => $flash, 'username' => $_SESSION['admin_username']));