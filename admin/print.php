<?php 
require_once('../app/start.php');

use \UsWriters\Models\Letter;

isAdminLoggedOut();

$letter_id = filter_input(INPUT_GET, 'letter_id', FILTER_SANITIZE_NUMBER_INT);

// if no id passed, list all the letters that can be printed
if ($letter_id == "") {
    $letters = Letter::find('all', 
        array('conditions' => array('status IN (?)', array('sent', 'submitted')), 
            'order' => 'submitted_date DESC')
        );
    echo $twig->render("@admin/print.html.twig", array(
        'flash' => $flash, 
        'username' => $_SESSION['admin_username'],
        'letters' => $letters
    ));
    exit();
}

// if id passed, print the letter with that id
try {
    $letter = Letter::find($letter_id);
    $contact_address = $letter->contact->getPrisonHtmlAddress();
    echo $twig->render("@admin/print-letter.html.twig", array(
    	'letter' => $letter, 
    	'writer' => $letter->writer->display_name,
    	'contactAddress' => $contact_address
    )); 
} catch (ActiveRecord\RecordNotFound $e) {
    $flash->error("The letter could not be found", "/uswriters/admin/print");
    exit();
}