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

		$result = $db->Execute('SELECT * FROM '.DB::$calls.' ORDER BY '.DB::$calls_start_time.' DESC');

		$total_call_duration = 0;
		$total_call_count = $result->RecordCount();

		// This data is used by the JS charting library to display a dot chart
		// showing the calls received each hour. Each slot in the array
		// corresponds to an hour in the day.
		$call_volume_chart_data = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

		while ($row = $result->FetchRow())
		{
			$from = $row[DB::$calls_from];
			$location = $row[DB::$calls_location];
			$start_time = new DateTime($row[DB::$calls_start_time], $server_timezone);
			$duration = ceil($row[DB::$calls_duration]/60);

			$total_call_duration += $duration;
			$call_volume_chart_data[$start_time->format('G')] += 1;

			$start_time->setTimezone($local_timezone);

			$call['from'] = format_phone_number($from);
			$call['location'] = $location;
			$call['start_time'] = $start_time->format('F j, Y \a\t g:i A');
			$call['duration'] = $duration;

			$calls[] = $call;
		}
	}
	catch (ADODB_Exception $e)
	{
		$error = 'An error occurred while connecting to the database. Please try again later.';
	}
	
	$data->assign('total_call_count', $total_call_count);
	$data->assign('total_call_duration', $total_call_duration);
	$data->assign('total_spent', money_format('%i', $total_call_duration * CALL_COST));
	$data->assign('call_volume_chart_data', implode(', ', $call_volume_chart_data));
	$data->assign('calls', $calls);
	$data->assign('error', $error);

	$dwoo->output($tpl, $data);
?>
