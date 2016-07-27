<?php 
namespace UsWriters\Models;

use \ActiveRecord\Model;

class Contact extends Model
{
	static $belongs_to = array(
		array('prison')
	);

	static $has_many = array(
		array('writers', 'through' => 'writers2contacts'),
		array('writers2contacts'),
		array('letters')
	);
}