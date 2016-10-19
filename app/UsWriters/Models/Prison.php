<?php 
namespace UsWriters\Models;

use \ActiveRecord\Model;

class Prison extends Model
{
	public static $has_many = array(
		array('contacts')
	);
}