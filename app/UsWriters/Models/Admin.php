<?php 
namespace UsWriters\Models;

use \ActiveRecord\Model;

class Admin extends Model
{
	public function login($givenPassword) 
	{
		return password_verify($givenPassword, $this->password);
	}
}