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

	static $before_create = array('hashPassword', 'lowercaseEmail');

	static $before_save = array('lowercaseEmail');

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
}