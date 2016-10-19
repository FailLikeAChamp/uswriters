<?php 
require("../app/start.php");

use \UsWriters\Models\PdfUploader;
use \UsWriters\Model\Contact;
use \UsWriters\Model\ContactLetter;
use \UsWriters\Model\Writer;

isAdminLoggedOut();

$totalFiles = count($_FILES['filesToUpload']['name']);
$successCount = 0;
$errorCount = 0;

if ($totalFiles > 0) {
	$files = PdfUploader::getFiles($_FILES['filesToUpload'], $totalFiles);

	foreach ($files as $index => $file) {
		$pdfUploader = new PdfUploader($file);

		$pdfUploader->upload();

		switch ($pdfUploader->insertLetter()) {
			case 'success':
				$successCount++;
				break;
			case 'error':
				$errorCount++;
				break;
			default:
				break;
		}

	}

	if ($errorCount > 0) $flash->error("$errorCount file(s) not uploaded");
	if ($successCount > 0) $flash->success("$successCount file(s) uploaded");

}

header("location: upload");