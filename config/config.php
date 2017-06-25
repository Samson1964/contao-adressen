<?php

/**
 * Backend-Bereich DSB anlegen, wenn noch nicht vorhanden
 */
if(!$GLOBALS['BE_MOD']['dsb']) 
{
	$dsb = array(
		'dsb' => array()
	);
	array_insert($GLOBALS['BE_MOD'], 0, $dsb);
}

$GLOBALS["BE_MOD"]["dsb"]["adressen"] = array(
	"tables"      => array("tl_adressen"),
	"icon"        => "system/modules/adressen/assets/images/icon.png",
	"import"      => array("Adressen_Backend","importAdressen"),
	"export"      => array("Adressen_Backend","exportAdressen"),
);

/**
 * Frontend-Module
 */
$GLOBALS['FE_MOD']['adressen'] = array
(
	'wertungsreferenten' => 'Samson\Adressen\Wertungsreferenten',
	'adressensuche'      => 'Samson\Adressen\Suche',
);  


/**
 * Inserttag für Adressersetzung in den Hooks anmelden
 */

$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array('Samson\Adressen\Adressen_Frontend','adresse_ersetzen');

/**
 * Optionen für Bildbeschneidung
 */

$GLOBALS['TL_ADRESSEN'] = array(0,10,20,30,40,50,60,70,80,90,100);

/**
 * Inhaltselemente
 */
 
$GLOBALS['TL_CTE']['includes']['adressen'] = 'Samson\Adressen\adresseClass';

// Konfiguration für ProSearch
$GLOBALS['PS_SEARCHABLE_MODULES']['adressen'] = array(
	'icon'           => 'system/modules/adressen/assets/images/icon.png',
	'title'          => array('nachname'),
	'searchIn'       => array('nachname','vorname', 'ort', 'strasse', 'email1', 'email2', 'email3', 'email4'),
	'tables'         => array('tl_adressen'),
	'shortcut'       => 'adr'
);
