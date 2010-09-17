<?php
	require_once('adodb5/adodb.inc.php');
	require_once('config.php');
	require_once('db_config.php');

	class DB
	{
		public static $calls = 'calls';

		public static $calls_id = 'calls_id';
		public static $calls_from = 'calls_from';
		public static $calls_start_time = 'calls_start_time';
		public static $calls_duration = 'calls_duration';

		private function __construct() {}

		public static function conn()
		{
			static $conn;

			if (!$conn)
			{
				$conn = NewADOConnection(DSN);
				$conn->SetFetchMode(ADODB_FETCH_ASSOC);
			}

			return $conn;
		}

		public static function clean($var, $conn)
		{
			$var = trim($var);
			$var = $conn->qstr($var, get_magic_quotes_gpc());

			return $var;
		}
	}
?>
