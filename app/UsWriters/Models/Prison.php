<?php 
namespace UsWriters\Models;

use \ActiveRecord\Model;

class Prison extends Model
{
	static $belongs_to = array(
		array('admin')
	);
}