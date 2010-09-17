<?php
	// From http://snipplr.com/view/25/format-phone-number/
	function format_phone_number($phone)
	{
		$phone = preg_replace("/[^0-9]/", "", $phone);
		
		if(strlen($phone) == 7)
			return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phone);
		elseif(strlen($phone) == 10)
			return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $phone);
		else
			return $phone;
	}

	// From http://www.bitrepository.com/how-to-validate-a-telephone-number.html
	function validate_phone_number($number)
	{
		$formats = array('###-###-####', '(###) ###-####', '###.###.####'
				, '(###) ###.####', '(###)###-####'
				, '(###)###.####', '##########');

		return validate_telephone_number($number, $formats);	
	}

	// From http://www.bitrepository.com/how-to-validate-a-telephone-number.html
	function validate_telephone_number($number, $formats)
	{
		$format = trim(preg_replace("/[\d]/i", "#", $number));

		return (in_array($format, $formats)) ? true : false;
	}
?>
