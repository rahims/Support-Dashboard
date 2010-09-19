<?php
	ob_start("ob_gzhandler");
	
	require_once('./include/include.php');

	header("content-type: text/xml");
	echo '<?xml version="1.0" encoding="UTF-8"?>';
	echo '<Response>';

	try
	{
		$db = DB::conn();

		$call_id = (int) $_GET['call_id'];
		$outgoing_call_sid = $_GET['DialCallSid'];
		$call_status = $_GET['DialCallStatus'];
		$duration = (int) $_GET['DialCallDuration'];

		if (($call_id > 0) && isset($outgoing_call_sid) && isset($call_status))
		{
			if ($call_status != 'completed')
			{
				echo '<Say voice="woman">'.BUSY_RESPONSE.'</Say>';
			}

			$query = 'UPDATE '.DB::$calls.' SET '.DB::$calls_outgoing_twilio_sid.' = '.DB::clean($outgoing_call_sid, $db).', '.DB::$calls_duration.' = '.$duration.' WHERE '.DB::$calls_id.' = '.$call_id.' LIMIT 1';

			$db->Execute($query);
		}
	}
	catch (ADODB_Exception $e)
	{
		echo '<Say voice="woman">'.ERROR_RESPONSE.'</Say>';
	}

	echo '</Response>';
?>
