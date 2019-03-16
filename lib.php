<?php
	class ErrorModel{
		public $firstName_message;
		public $lastName_message;
		public $email_message;
		public $password_message;
		public $passwordConfirm_message;
		public $address_message;
		public $postalCode_message;
		public $city_message;
		public $country_message;
		public $birthday_message;
		public $count;

		public function hasError(){
			return $this->count > 0;
		}
	}

	class DataModel{
		public $firstName;
		public $lastName;
		public $email;
		public $address;
		public $postalCode;
		public $city;
		public $country;
		public $birthday_day;
		public $birthday_month;
		public $birthday_year;

		public function getBirthDay(){
			return $this->birthday_year.'-'.$this->birthday_month.'-'.$this->birthday_day;
		}
	}
?>
