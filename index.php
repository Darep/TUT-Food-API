<?php
/*!
 * TTY Food Service
 * Supplies you with a JSON representation of TTY's restaurant food menus today.
 */

define('JSON_FILE', 'listat');

// check if the json is too old
$today_at_one = date('Y-m-d 01:00:00');
$time_modified = filemtime(JSON_FILE);

if ($time_modified < $today_at_one) {
	
	$modules = array('juvenes.php'); //, 'amica.php');
	
	// redirect parser output to log file
	ob_start();
	include 'parse_menus.php';
	$parser_log = ob_get_contents();
	ob_end_clean();
}

echo file_get_contents('./'. JSON_FILE);
