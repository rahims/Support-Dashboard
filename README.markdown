Support Dashboard Version 1.0.0
===============================

Support Dashboard makes it easy for small businesses to track and view their
incoming support calls.

Support Dashboard works with the Twilio API, so you'll need an account and
phone number at Twilio before you can get started. Twilio sells simple, pay as
you go pricing, and you can sign up for a free account with $30 of free credits
at http://www.twilio.com.

Installation
============

Installation of Support Dashboard is similar to many other PHP/MySQL apps you
may have used in the past. It consists of creating the MySQL database and table
(steps 1 and 2), copying the folder to your server (steps 3, 4, and 5), editing
the configuration files with values for your setup (steps 6, 7, and 8), and, 
lastly, pointing Twilio to the correct handler (step 9).

1. Make a MySQL database for Support Dashboard (optionally, you can just add
   the table to an existing database).

2. Create the MySQL table by importing support_dashboard.sql.

3. Copy the support_dashboard folder to your server.

4. Create the following folders (if they don't already exist):

	- /include/dwoo/compiled
	- /include/dwoo/cache 

5. Make the following writeable:

	- /error_log.txt
	- /include/dwoo/compiled
	- /include/dwoo/cache

6. Edit /include/config.php

7. Edit /include/db_config.php

8. Edit /include/twilio_config.php

9. Go to http://www.twilio.com and point the Voice URL to
   http://[your server]/[path to Support Dashboard]/handle_incoming_call.php
   (leave the default POST method selected).

License
=======
Copyright (c) 2010 Rahim Sonawalla (rsonawalla@gmail.com).

Released under the MIT license (http://www.opensource.org/licenses/mit-license.php).
