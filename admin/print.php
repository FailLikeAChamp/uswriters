<?php 
require_once('../app/start.php');

use \UsWriters\Models\Letter;

isAdminLoggedOut();

$letter_id = filter_input(INPUT_GET, 'letter_id', FILTER_SANITIZE_NUMBER_INT);

if ($letter_id == "") {
    $letters = Letter::find('all', array('conditions' => array('status = ?', 'submitted')));
    echo $twig->render("@admin/print.html.twig", array(
        'flash' => $flash, 
        'username' => $_SESSION['admin_username'],
        'letters' => $letters
    ));
    exit();
}

try {
    $letter = Letter::find($letter_id);
    $document = $letter->getHtmlVersion();
    echo $twig->render("@admin/print-letter.html.twig", array('letter' => $letter)); 
} catch (ActiveRecord\RecordNotFound $e) {
    $flash->error("The letter could not be found", "/uswriters/admin/print");
    exit();
}