<?php
	define('API_VERSION', '2010-04-01');
	define('ACCOUNT_SID', '');
	define('AUTH_TOKEN', '');

	// The phone number customers call for support
	define('SUPPORT_NUMBER', '8881112222');
	// The phone number the support call should be forwarded to. (For example, your cell phone number.)
	define('FORWARD_TO_NUMBER', '1112223333');

	// Should the caller's number be shown when you're called?
	//
	// If set to false, your customer support number will be displayed on your
	// phone's caller ID. This way, you'll know whether it's your mom or a 
	// customer.
	// 
	// If set to true, the customer's phone number will be displayed on your
	// phone's caller ID. Useful if you need to call them back real quick.
	define('SHOW_CALLER', false);

	// Per minute cost to receive a call
	// Currently, the incoming call leg for a toll free number is 3 cents, and
	// the outgoing call leg* is 2 cents.
	//
	// * When a customer calls into the support number (incoming call leg),
	// they're forwarded to your cell phone (outgoing call leg).
	define('CALL_COST', 0.05);
?>
