<?php
/*!
 * TTY Food Service
 * Supplies you with a JSON representation of TTY's restaurant food menus today.
 */

define('JSON_FILE', 'listat');
define('LOG_FILE', 'listat.log');

// check if the json is too old
$today_at_one = strtotime(date('Y-m-d 01:00:00'));
$time_modified = filemtime(JSON_FILE);

if ($time_modified < $today_at_one) {
	
	// redirect parser output to log file
	ob_start();
	
	$menus = parse_menus(array(
		'juvenes'
	));
	
	$parser_log = ob_get_contents();
	ob_end_clean();
	
	$logfile_handle = fopen(LOG_FILE, 'a');
	fwrite($logfile_handle, $parser_log);
	fclose($logfile_handle);
	
	$data = array(
		'time_updated' => time(),
		'menus' => $menus
	);
	
	$json = json_encode($data);
	
	$fp = fopen(JSON_FILE, 'w');
	fwrite($fp, $json);
	fclose($fp);
}

echo file_get_contents(JSON_FILE);
exit;

/**
 * Parse and serialize the food menus
 * Uses different modules to parse the HTML and then serializes the foods to a JSON.
 */
function parse_menus($modules) {
	ini_set('default_charset', 'iso-8859-15');
	
	$paivat = array(
		"Sunnuntai",
		"Maanantai",
		"Tiistai",
		"Keskiviikko",
		"Torstai",
		"Perjantai",
		"Lauantai"
	);
	
	$menus = array();
	
	$paiva = $paivat[date('w')];
	$seur_paiva = $paivat[date('w', strtotime('+1 day'))];
	
	echo 'T‰n‰‰n on: '. $paiva ."\n";
	echo 'Huomenna on: '. $seur_paiva ."\n";
	
	foreach ($modules as $module) {
		include './modules/'. $module .'.php';
		$menus[$module] = $lista;
	}
	
	return $menus;
}
