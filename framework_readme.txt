* General notes
Files in /include that are of the pattern /include/*_config.php should not be tracked in Git since they contain usernames, passwords, and other information that might be server specific.

* Configuring the database
The information to connect to the database is kept inside of /include/db_config.php. This file is not (and should not) be tracked in Git. In it, you should edit the DSN with the proper information for your set up (username, password, host, database).

You need to define your tables and their layouts in /include/db.php.


* Creating subdirectories
If you have some code you'd like to run from a subdirectory of the root, you must create a symlink to the error log. For example, if you wanted to create a folder called "test" in the root folder to run code from, you would do:

	$> mkdir test
	$> cd test
	$> ln -s ../error_log.txt error_log.txt

* Upgrading libraries
The framework uses ADODB as its database abstraction layer. Upgrading to a newer version of ADODB is as simple as replacing the old folder with the new folder. However, extra care must be taken with the adodb-exceptions.inc.php file. An extra function (called "log") has been added. This function takes care of logging ADODB errors to the error log. You should copy this function before you update ADODB and paste it back into the newer version of adodb-exceptions.inc.php.
