<?php 
namespace UsWriters\Models;

use \ActiveRecord\Model;

class Letter extends Model
{
	static $belongs_to = array(
		array('writer'),
		array('contact')
	);

	static $validates_presence_of = array(
    	array('writer_id', 'message' => 'Could not find the writer!', 'on' => 'create'),
    	array('contact_id', 'message' => 'No contact was selected!', 'on' => 'create')
    );

    static $validates_exclusion_of = array(
    	array('writer_id', 'in' => array(0), 'message' => 'No writer was found!'),
		array('contact_id', 'in' => array(0), 'message' => 'No contact was selected!')
   );
    
   public function getContactName() 
   {
        return $this->contact->name;
   }

   public function getContactId() 
   {
        return $this->contact->id; 
   }

   public function getWriterName() 
   {
        return $this->writer->name;
   }

   public function getHtmlVersion() 
   {
        return html_entity_decode($this->document);
   }

   public function getType() 
   {
        switch ($this->status) {
            case 'saved':
                return "Draft";
                break;
            case 'submitted':
                return "Sent";
                break;
            case 'sent':
                return "Sent";
                break;
            case 'deleted':
                return "Deleted";
                break;
            case 'read':
                return "Read";
                break;
            case 'unread':
                return "Unread";
                break;
            default:
                break;
        }
    }
}