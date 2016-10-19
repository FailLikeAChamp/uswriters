<?php 
namespace UsWriters\Models;

use \ActiveRecord\Model;

class PdfUploader extends Model
{
    public $fileName;
    public $fileTmpName;
    public $fileType;
    public $fileError;
    public $date;
    public $uploadDir;
    public $contactNumber;
    public $uploadName;
    public $message;
    public $uploaded = false;
    public $UPLOAD_PATH;
    const STATUS = 'unread';
    const VALID_FORMATS = array('pdf');


    public function __construct($file)
    {
        $this->fileName = $file['name'];
        $this->fileTmpName = $file['tmp_name'];
        $this->fileType = $file['type'];
        $this->fileError = $file['error'];
        $this->date = new \DateTime(null, new \DateTimeZone('America/Detroit'));
        $this->UPLOAD_PATH = $_SERVER['DOCUMENT_ROOT'] . "/../letters/";
        $this->getFileInfo();
    }


    public function getFileInfo()
    {
        $this->contactNumber = basename($this->fileName, ".pdf");

        $this->uploadDir = $this->UPLOAD_PATH . $this->contactNumber;

        $date = $this->date->format("Y-m-d-H-s-i");

        $this->uploadName = "$this->contactNumber@$date.pdf";
    }


    public function upload()
    {
        if ($this->fileError == 0 && $this->fileName != "") {              

            if(!in_array(pathinfo($this->fileName, PATHINFO_EXTENSION), self::VALID_FORMATS) ) {

                $this->message = "$this->fileName is not a valid format";
  
            } else { // No error found. Move uploaded file 

                if (!is_dir($this->uploadDir)) {

                    mkdir($this->uploadDir);

                }

                if(move_uploaded_file($this->fileTmpName, $this->uploadDir . "/" . $this->uploadName)) {

                    $this->uploaded = true;

                }
            }

        }

    }


    public function insertLetter()
    {  
        $contact = Contact::find_by_prisoner_number($this->contactNumber);
        $writers = Contact::find_by_id($contact->id)->writers;
        $response = "error";
        
        if ($contact->id > 0 && $this->uploaded == true) { 

            $response = "success";

            foreach ($writers as $writer) {

                $contactLetter = new ContactLetter();
                $contactLetter->contact_id = $contact->id;
                $contactLetter->writer_id = $writer->id;
                $contactLetter->file_name = $this->uploadName;
                $contactLetter->status = self::STATUS;
                $contactLetter->upload_date = $this->date->format("Y-m-d H:s:i");

                if(!$contactLetter->save()) {
                    $response = "error";
                    // delete uploaded file
                    //unlink($this->uploadDir . "/" . $this->uploadName);
                }

            }

        }

        return $response;  
    }

    public static function getFiles($fileArr, $totalFiles)
    {
        for($i = 0; $i < $totalFiles; $i++) {

            $tmpName = $_FILES['filesToUpload']['tmp_name'][$i];
            $name = $_FILES['filesToUpload']['name'][$i];
            $error = $_FILES['filesToUpload']['error'][$i];
            $type = $_FILES['filesToUpload']['type'][$i];

            $files[] = array(
                'tmp_name' => $tmpName,
                'name' => $name,
                'error' => $error,
                'type' => $type
            );

        }

        return $files;
    }

}