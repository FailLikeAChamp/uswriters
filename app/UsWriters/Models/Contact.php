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
		array('letters'), 
		array('contact_letters')
	);

	public function before_destroy()
    {
        $related_writers2contacts = writers2contact::find(array(
            'conditions' => array(
                'contact_id' => $this->id)
        ));

        $related_writers2contacts->delete();
    }

	public function getPrisonHtmlAddress() 
	{
		$prisoner_number = $this->prisoner_number;
		$prison_name = $this->prison->name;
		$prison_address = $this->prison->address_1;
		$prison_city = $this->prison->city;
		$prison_state = $this->prison->state;
		$prison_postal_code = $this->prison->postal_code;
		$name = $this->name . " " . $prisoner_number;

		$address = "
			<section id='address' class='mceNonEditable'>
				<div>
					{$name}
				</div>
				<div>
					{$prison_name}
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