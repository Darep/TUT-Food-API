<?php
/**
 * Hermian Amica-ravintolan ruokalista $lista -taulukkoon
 *
 * Created by Darep
 * Last modified: 2010-04-17 by Darep
 *
 */

print "== AMICA ==\n";

$amica_base_url = "http://www.amica.fi/Ravintolat/Amica-ravintolat/Ravintolat-kaupungeittain/Tampere/";
$amica_ravintolat = array(
	"ah" => array(
		"url"    => "Technopolis-Hermia--Hermanni",
		"nimi"   => "Amica Hermanni",
        "method" => 2
	),
    "ah2" => array(
		"url"    => "Technopolis-Hermia--Hermia",
		"nimi"   => "Amica Hermia",
        "method" => 2
	)
);


foreach ($amica_ravintolat as $k => $v) {

	$lista[$k] = array();
	$lista[$k]['nimi'] = $v['nimi'];  
	$lista[$k]['auki'] = '';
	$lista[$k]['ruoka'] = array();
  
	$url = $v['url'];

	print "Haetaan $amica_base_url$url\n";
//	$data = implode("", file('./amicatesti.html'));
	$data = implode("", file($amica_base_url . $url));
	$data = str_replace("\r", "", $data);
	$data = str_replace("\n", "", $data);
	
    if ($v['method'] == 1) {
        // Ruokalista, <p> ja <br/>
        preg_match("/<p>$paiva(\&nbsp\;)(<br \/>)*<\/p>(.*?)<\/p>/", $data, $match);
        $paivan_ruoat = preg_replace("/^<p>/", "", $match[3]);
        $paivan_ruoat = preg_replace("/(<br \/>)\&nbsp\;<br \/>/", "\\1", $paivan_ruoat);

        // Hinnat kuuseen
        $paivan_ruoat = preg_replace("/\&nbsp\;\d,\d*/", "", $paivan_ruoat);

        if ($paiva == "Perjantai") {
            // Poistetaan VL, L, G jne. merkinnät
            print "Poistetaan VL, L, G jne.\n";
            $paivan_ruoat = preg_replace("/(VL|L|G|M|\*) =(.*)(<br \/>)?/", "", $paivan_ruoat);
        }
        
        $match = explode("<br />", $paivan_ruoat);
      
        foreach ($match as $ruoka) {
            $rivi = trim(strip_tags($ruoka));
            $rivi = str_replace("&nbsp;", "", $rivi );
            
            // Ei näytetä turhia lisukkeita
    //		$rivi = preg_replace("/^peruna (.*?)$/i", "", $rivi);
    //		$rivi = preg_replace("/^(Tumma ?)riisi (.*?)$/i", "", $rivi);
            
            if (trim($rivi) != "" and !in_array($rivi, $lista[$k])) {
                $lista[$k]['ruoka'][] = $rivi;
                print "Lisattiin ruokarivi: $rivi\n";
            }
        }
    }
    elseif ($v['method'] == 2) {
        // Ruokalista <table>, <p> ja <strong>
        if ($paiva == "Perjantai") {
            preg_match("/<p><strong>$paiva<\/strong><\/p>(.*?)<\/table>/", $data, $match);
        }
        else {
            preg_match("/<p><strong>$paiva<\/strong><\/p>(.*?)$seur_paiva/", $data, $match);
        }
    //	print_r($match); exit;

        $paivan_ruoat = strip_tags($match[1], '<p>');
        $paivan_ruoat = preg_replace("/<p( align=\"center\")?>\&nbsp\;<\/p>/", "", $paivan_ruoat);
    //	print_r($paivan_ruoat); exit;

        // Hinnat kuuseen
        $paivan_ruoat = preg_replace("/<p align=\"center\">\d,\d*<\/p>/", "", $paivan_ruoat);
        $paivan_ruoat = preg_replace("/<p align=\"center\">\&euro\;<\/p>/", "", $paivan_ruoat);

        if ($paiva == "Perjantai") {
            // Poistetaan VL, L, G jne. merkinnät
    //		print "Poistetaan VL, L, G jne.\n";
    //		$paivan_ruoat = preg_replace("/(VL|L|G|M|\*) =(.*)(<br \/>)?/", "", $paivan_ruoat);
        }
        
        $match = explode("</p>", $paivan_ruoat);
    //	print_r($match); exit;
      
        foreach ($match as $ruoka) {
            $rivi = trim(strip_tags($ruoka));
            
            if (trim($rivi) != "" and !in_array($rivi, $lista[$k])) {
                $lista[$k]['ruoka'][] = $rivi;
                print "Lisattiin ruokarivi: $rivi\n";
            }
        }
    
    }
    
	// Ravintolan aukioloajat
	/*
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
	*/
}

?>
