<?php 
namespace UsWriters\Models;

use \ActiveRecord\Model;

class Writer extends Model
{	
	static $validates_presence_of = array(
		array('name', 'message' => 'cannot be blank', 'on' => 'create'),
		array('address_1', 'message' => 'cannot be blank', 'on' => 'create'),
		array('city', 'message' => 'cannot be blank', 'on' => 'create'),
		array('state', 'message' => 'cannot be blank', 'on' => 'create'),
		array('postal_code', 'message' => 'cannot be blank', 'on' => 'create'),
		array('phone', 'message' => 'cannot be blank', 'on' => 'create'),
		array('email', 'message' => 'annot be blank', 'on' => 'create'),
		array('gender', 'message' => 'cannot be blank', 'on' => 'create')
	);

	static $before_create = array('hashPassword', 'lowercaseEmail', 'cleanPhone');

	static $before_save = array('cleanPhone', 'lowercaseEmail');

	static $before_update = array('cleanPhone', 'lowercaseEmail');

	static $belongs_to = array(
		array('admin')
	);

	static $has_many = array(	
		array('contacts', 'through' => 'writers2contacts'),
		array('writers2contacts'),
		array('letters')
	);

	public function login($givenPassord) 
	{
		return password_verify($givenPassord, $this->password);
	}

	public function hashPassword() 
	{
		$this->password = password_hash($this->password, PASSWORD_BCRYPT, array('cost' => 10));
	}

	public function lowercaseEmail() 
	{
		$this->email = strtolower($this->email);
	}

	public function cleanPhone()
	{
		$this->phone = preg_replace("/[^0-9]/", "", $this->phone);

	}

	public function getDraftsAndSentLetters() 
	{
		$drafts = Letter::find_by_sql("
			SELECT 
				letters.id as id, 
				letters.status as status, 
				letters.saved_date as saved_date, 
				contacts.name as name 
			FROM letters 
			LEFT JOIN contacts 
			ON contacts.id = letters.contact_id 
			WHERE letters.writer_id = $this->id 
			AND letters.status IN('saved', 'submitted')  
			ORDER BY letters.status DESC, letters.saved_date DESC
		"); 

		return $drafts;
	}

	// public function getSentLetters()
	// {
	// 	$letters = Letter::find_by_sql("
	// 		SELECT 
	// 			letters.id as id, 
	// 			letters.saved_date as saved_date, 
	// 			letters.status as status, 
	// 			contacts.name as name 
	// 		FROM letters 
	// 		LEFT JOIN contacts 
	// 		ON contacts.id = letters.contact_id 
	// 		WHERE letters.writer_id = $this->id 
	// 		AND letters.status = 'submitted' 
	// 		ORDER BY letters.saved_date DESC 
	// 		LIMIT 10
	// 	");

	// 	return $letters;
	// }

	public function getUnreadAndReadLetters() 
	{
		$letters = Letter::find_by_sql("
			SELECT 
				letters.id as id, 
				letters.status as status, 
				letters.saved_date as saved_date, 
				contacts.name as name 
			FROM letters 
			LEFT JOIN contacts 
			ON contacts.id = letters.contact_id 
			WHERE letters.writer_id = $this->id 
			AND letters.status IN('unread', 'read') 
			ORDER BY letters.status DESC, letters.saved_date DESC
		"); 

		return $letters;
	}
}