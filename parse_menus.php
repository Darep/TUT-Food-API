<?php
/*!
 * Parse and serialize the food menus
 * Uses different modules to parse the HTML and then serializes the foods to a JSON.
 */
 
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

$paiva = $paivat[date('w')];
$seur_paiva = $paivat[date('w', strtotime('+1 day'))];

echo 'Tהnההn on: '. $paiva ."\n";
echo 'Huomenna on: '. $seur_paiva ."\n";

$lista = array();
$lista['paiva'] = $paiva;

foreach ($modules as $module) {
	include './modules/'. $module .'.php';
}

// DEBUG:
//print_r($lista); exit;

$fp = fopen(JSON_FILE, 'w');
fwrite($fp, serialize($lista));
fclose($fp);
