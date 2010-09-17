<?php
	// A list of valid timezone values can be found at http://www.php.net/manual/en/timezones.php
	define('TIMEZONE', 'America/Los_Angeles');

	// For when you're on another call or can't/don't feel like picking up
	define('BUSY_RESPONSE', "Sorry, we're tied up right now. Please try calling back in a bit.");
	// For when something goes horribly wrong with your database
	define('ERROR_RESPONSE', "There seems to be a problem with our systems. Please try again later.");

	// Unless you messed with the actual code, you'll likely never need to edit these
	define('ERROR_LOG', 'error_log.txt');
	define('TEMPLATE_DIR', 'templates');
?>
