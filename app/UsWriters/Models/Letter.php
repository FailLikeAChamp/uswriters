<?php 
namespace UsWriters\Models;

use \ActiveRecord\Model;

class Letter extends Model
{
	static $belongs_to = array(
		array('writer'),
		array('contact'),
		array('prison')
	);
}