<?php
	ob_start("ob_gzhandler");
	
	require_once('./include/include.php');
	require_once('./include/twilio_config.php');

	$host = $_SERVER['HTTP_HOST'];
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$base_url = 'http://'.$host.$uri.'/';

	header("content-type: text/xml");
	echo '<?xml version="1.0" encoding="UTF-8"?>';
	echo '<Response>';

	try
	{
		$db = DB::conn();

		// Twilio supplies the phone number as +19491234567, so reformat it as 9491234567
		$from = substr(trim(preg_replace('/[^0-9]/', '', $_REQUEST['From'])), 1);
		$call_sid = $_REQUEST['CallSid'];
		$call_city = ucwords(strtolower(trim($_REQUEST['FromCity'])));
		$call_state = strtoupper(trim($_REQUEST['FromState']));
		$call_country = strtoupper(trim($_REQUEST['FromCountry']));

		// This block is a little awkward. Basically, if we have city and
		// state, format it like we're used to seeing (city, state). If we have
		// one but not the other we do $city $state, which will either become
		// "$city[space]" or "[space]$state" Then we tack on country if we have
		// it. So we'll either have
		// "$city, $state $country"
		// "$city[space][space]"
		// "$city[space]$country]"
		// "$city, $state[space]"
		// ...and all the other permutations.
		// Finally we do a trim to take off any of the extra spaces on the ends
		// that might be there from not having a piece of information.
		if ((strlen($call_city) > 0) && (strlen($call_state) > 0))
		{
			$call_location = $call_city.', '.$call_state;
		}
		else {
			$call_location = $call_city.' '.$call_state;
		}

		$call_location = trim($call_location.' '.$call_country);

		if (validate_phone_number($from) && isset($call_sid))
		{
			$query = 'INSERT INTO '.DB::$calls.' ('.DB::$calls_twilio_sid.', '.DB::$calls_from.', '.DB::$calls_location.') VALUES ('.DB::clean($call_sid, $db).', '.DB::clean($from, $db).', '.DB::clean($call_location, $db).')';
			
			$db->Execute($query);

			$call_id = $db->Insert_ID();

			if (SHOW_CALLER)
			{
				$caller_id = $from;
			}
			else {
				$caller_id = SUPPORT_NUMBER;
			}

			echo '<Dial action="'.$base_url.'handle_call_status.php?call_id='.$call_id.'" callerId="'.$caller_id.'" method="GET">'.FORWARD_TO_NUMBER.'</Dial>';
		}
	}
	catch (ADODB_Exception $e)
	{
		echo '<Say voice="woman">'.ERROR_RESPONSE.'</Say>';
	}

	echo '</Response>';
?>
