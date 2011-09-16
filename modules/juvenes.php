<?php
/**
 * TTY Juvenes-ravintoloiden ruokalistat $lista -taulukkoon
 *
 * Created by Dredge
 * Last modified: 2010-04-17 by Darep
 *
 */

print "== JUVENES ==\n";

$juvenes_base_url = "http://www.juvenes.fi/Suomeksi/Ravintolat_ja_kahvilat/Opiskelijaravintolat/_TTY__";
$juvenes_ravintolat = array(
	"z" => array(
		"url" => "Zip",
		"nimi" => "Zip"
	),
	"e" => array(
		"url" => "Edison",
		"nimi" => "Edison"
	),
	"n" => array(
		"url" => "Newton",
		"nimi" => "Newton"
	),
	"f" => array(
		"url" => "Newton/Fusion_Kitchen",
		"nimi" => "Fusion Kitchen"
	),
	"p" => array(
		"url" => "Caf____Fast_Voltti/Pastabaari",
		"nimi" => "Voltti/Pastabaari"
	),
	"s" => array(
		"url" => "Zip/Salaattibaari",
		"nimi" => "Salaattibaari"
	),
	"r" => array(
		"url" => "Caf__Rom",
		"nimi" => "Café Rom"
	)
);


foreach ($juvenes_ravintolat as $k => $v) {

	$lista[$k] = array();
	$lista[$k]['nimi'] = $v['nimi'];  
	$lista[$k]['auki'] = '';
	$lista[$k]['ruoka'] = array();
  
	$url = $v['url'];

	print "Haetaan $juvenes_base_url$url\n";
	$data = implode("", file($juvenes_base_url . $url));
	$data = str_replace("\n", "", $data);
  
	// Ruokalista
	preg_match("/<b>$paiva<\/b>(.*?)(<hr \/>|<p>)/", $data, $match);
  
	$match[1] = preg_replace("/<div.*?><img src=\".*?\" alt=\"(Rohee|Reilu|Reilu Kasvis|Reilu Kevyt)\".*?\/><\/div>/", "\\1 ", $match[1]);
	$match[1] = preg_replace("/<div(.*?)<\/div>/", "", $match[1]);
	$match = explode("<br />", $match[1]);
  
	foreach ($match as $ruoka) {
		$rivi = trim(strip_tags($ruoka));
		
		// Ei näytetä turhia lisukkeita
		$rivi = preg_replace("/^peruna (.*?)$/i", "", $rivi);
		$rivi = preg_replace("/^(Tumma ?)riisi (.*?)$/i", "", $rivi);
		$rivi = preg_replace("/^Maustevoi(.*?)$/i", "", $rivi);
		$rivi = preg_replace("/^Ranskalaiset perunat(.*?)$/i", "", $rivi);
		
		if (trim($rivi) != "" and !in_array($rivi, $lista[$k])) {
			$lista[$k]['ruoka'][] = $rivi;
			print "Lisattiin ruokarivi: $rivi\n";
		}
	}

	// Ravintolan aukioloajat
	preg_match("/<b>Aukiolo- ja lounasajat<\/b>(.*?)(<br \/><br \/>|Erityisruokavaliot|Hintaryhm)/i", $data, $match);
	$match = explode("<br />", $match[1]);
  
	foreach ($match as $aika) {
		$aika = trim(strip_tags($aika));

		if ($aika != "") {
			$aika = str_replace(" - ", "-", $aika);
			$aika = str_replace("- ", "-", $aika);
			$aika = str_replace(" -", "-", $aika);
			$aika = strtolower($aika);
			$aika = preg_replace("/\s+/", " ", $aika);
			  
			$lista[$k]['auki'][] = $aika;
		}
	}
  
	if (!empty($lista[$k]['auki'])) {
		$lista[$k]['auki'] = implode(", ", $lista[$k]['auki']);
	}
}
?>