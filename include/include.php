<?php
	require_once('config.php');

	define(ADODB_ERROR_LOG_DEST, ERROR_LOG);

	require_once('adodb5/adodb-exceptions.inc.php');
	require_once('adodb5/adodb.inc.php');
	require_once('dwoo/dwooAutoload.php');

	require_once('db.php');
	require_once('functions.php');
?>
