<?php 
namespace UsWriters\Models;

use \ActiveRecord\Model;

class Writer extends Model
{	
	static $validates_presence_of = array(
		array('username', 'message' => 'cannot be blank', 'on' => 'create'),
		array('name', 'message' => 'cannot be blank', 'on' => 'create'),
		array('address_1', 'message' => 'cannot be blank', 'on' => 'create'),
		array('city', 'message' => 'cannot be blank', 'on' => 'create'),
		array('state', 'message' => 'cannot be blank', 'on' => 'create'),
		array('postal_code', 'message' => 'cannot be blank', 'on' => 'create'),
		array('phone', 'message' => 'cannot be blank', 'on' => 'create'),
		array('email', 'message' => 'annot be blank', 'on' => 'create'),
		array('gender', 'message' => 'cannot be blank', 'on' => 'create')
	);

	static $validates_uniqueness_of = array(
    	array('username', 'message' => '(PenPal name) is already used'),
    	array('email', 'message' => 'already used')
    );

	static $before_create = array('hashPassword', 'cleanPhone', 'lowerCaseData');

	static $before_save = array('cleanPhone', 'lowerCaseData');

	static $before_update = array('cleanPhone', 'lowerCaseData');

	static $has_many = array(	
		array('contacts', 'through' => 'writers2contacts'),
		array('writers2contacts'),
		array('letters'), 
		array('contact_letters')
	);

	public function before_destroy()
    {
        $related_writers2contacts = writers2contact::find(array(
            'conditions' => array(
                'writer_id' => $this->id)
        ));

        $related_writers2contacts->delete();
    }

	public function login($givenPassord) 
	{
		return password_verify($givenPassord, $this->password);
	}

	public function hashPassword() 
	{
		$this->password = password_hash($this->password, PASSWORD_BCRYPT, array('cost' => 10));
	}

	public function lowerCaseData() 
	{	
		$this->email = strtolower(trim($this->email));
		$this->username = strtolower(trim($this->username));
	}

	public function cleanPhone()
	{
		$this->phone = preg_replace("/[^0-9]/", "", $this->phone);

	}

	public function getLetters() 
	{
		$letters = Letter::find("all", array(
			"conditions" => "status IN ('saved', 'submitted', 'sent') 
			AND writer_id = $this->id"
		));

		return $letters;
	}

	public function getContactLetters()
	{	
		$letters = ContactLetter::find_by_sql("
			SELECT 
				c.*
			FROM contact_letters c 
			LEFT JOIN writers2contacts w2c 
			ON c.contact_id = w2c.contact_id 
			AND w2c.writer_id = $this->id 
			WHERE w2c.contact_id IS NOT NULL 
			AND c.writer_id = $this->id; 
		");

		return $letters;
	}

	public function availableContacts()
	{	
		$contacts = Contact::find_by_sql("
			SELECT 
				c.id, 
				c.name 
			FROM contacts c
			LEFT JOIN writers2contacts w2c
			ON c.id = w2c.contact_id 
			AND w2c.writer_id = $this->id
			WHERE w2c.contact_id IS NULL; 
		");

		return $contacts;
	}

	public function assignedContacts()
	{
		$contacts = Contact::find_by_sql("
			SELECT 
				c.id, 
				c.name 
			FROM contacts c
			LEFT JOIN writers2contacts w2c
			ON c.id = w2c.contact_id 
			AND w2c.writer_id = $this->id
			WHERE w2c.contact_id IS NOT NULL; 
		");

		return $contacts;
	}
}