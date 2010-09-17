<?php
	ob_start("ob_gzhandler");
	
	require_once('./include/include.php');
	require_once('./include/twilio_config.php');

	$dwoo = new Dwoo();
	$tpl = new Dwoo_Template_File(TEMPLATE_DIR.'/index.tpl');
	$data = new Dwoo_Data();
	$server_timezone = new DateTimeZone(date_default_timezone_get());
	$local_timezone = new DateTimeZone(TIMEZONE);

	try
	{
		$db = DB::conn();

		$result = $db->Execute('SELECT * FROM '.DB::$calls);

		$total_call_duration = 0;
		$total_call_count = $result->RecordCount();

		while ($row = $result->FetchRow())
		{
			$from = $row[DB::$calls_from];
			$start_time = new DateTime($row[DB::$calls_start_time], $server_timezone);
			$duration = ceil($row[DB::$calls_duration]/60);

			$total_call_duration += $duration;

			$start_time->setTimezone($local_timezone);

			$call['from'] = format_phone_number($from);
			$call['start_time'] = $start_time->getTimestamp();
			$call['duration'] = $duration;

			$calls[] = $call;
		}
	}
	catch (ADODB_Exception $e)
	{
		$error = '<p class="error">An error occurred while connecting to the database. Please try again later.</p>';
	}
	
	$data->assign('total_call_count', $total_call_count);
	$data->assign('total_call_duration', $total_call_duration);
	$data->assign('total_spent', money_format('%i', $total_call_duration * CALL_COST));
	$data->assign('calls', $calls);
	$data->assign('error', $error);

	$dwoo->output($tpl, $data);
?>
