<?php 
namespace UsWriters\Models;

use \ActiveRecord\Model;

class Contact extends Model
{
	static $belongs_to = array(
		array('prison'),
		array('admin')
	);

	static $has_many = array(
		array('writers', 'through' => 'writers2contacts'),
		array('writers2contacts'),
		array('letters')
	);

	public function getPrisonHtmlAddress() 
	{
		$prisoner_number = $this->prisoner_number;
		$prison_name = $this->prison->name;
		$prison_address = $this->prison->address_1;
		$prison_city = $this->prison->city;
		$prison_state = $this->prison->state;
		$prison_postal_code = $this->prison->postal_code;

		$address = "
			<section id='address' class='mceNonEditable'>
				<div>
					{$prisoner_number}
				</div>
				<div>
					{$prison_address}
				</div>
				<div>
					{$prison_city}, {$prison_state} {$prison_postal_code}
				</div>
			</section>";

		return trim(preg_replace('/\t+/', '', $address));
	}
	
}