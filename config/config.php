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
 * Inserttag für Adressersetzung in den Hooks anmelden
 */

$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array('Adressen_Frontend','adresse_ersetzen');

/**
 * Optionen für Bildbeschneidung
 */

$GLOBALS['TL_ADRESSEN'] = array(0,10,20,30,40,50,60,70,80,90,100);

/**
 * Inhaltselemente
 */
 
$GLOBALS['TL_CTE']['includes']['adressen'] = 'adresseClass';
