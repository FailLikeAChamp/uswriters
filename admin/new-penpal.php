<?php 
require_once('../app/start.php');

isAdminLoggedOut();

use \UsWriters\Models\Contact;
use \UsWriters\Models\Writer;

$contacts = Contact::find('all', array('select' => 'id, name'));
$writers = Writer::find('all', array('select' => 'id, name'));

echo $twig->render('@admin/new-penpal.html.twig', array(
			'flash' => $flash, 
			'username' => $_SESSION['admin_username'],
			'contacts' => $contacts,
			'writers' => $writers
));