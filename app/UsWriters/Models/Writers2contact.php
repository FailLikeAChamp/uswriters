<?php 
namespace UsWriters\Models;

use \ActiveRecord\Model;

class Writers2Contact extends Model
{
	static $belongs_to = array(
		array('writer'),
		array('contact')
	);
}