<?php 
require_once('../app/start.php');

use \UsWriters\Models\Contact;
use \UsWriters\Models\Prison;

isAdminLoggedOut();

$contact = "";
$prisonName = "";

if (isset($_POST['contact_id'])) {
	$contact = Contact::find($_POST['contact_id']);
	$prisonName = ucwords($contact->prison->name);
}

$allContacts = Contact::all();
$allPrisons = Prison::all();

echo $twig->render('@admin/edit-contact.html.twig', array('flash' => $flash, 'prisonName' => $prisonName, 'allPrisons' => $allPrisons, 'contact' => $contact, 'allContacts' => $allContacts, 'username' => $_SESSION['admin_username']));