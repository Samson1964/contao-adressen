<?php

/**
 * Backend-Modul einbinden, Bereich Inhalte (content)
 * tables = Array mit den benutzten SQL-Tabellen
 * icon = Pfad zum Modul-Icon
 * import = key-Wert zuordnen, Klasse Adressen_Backend, Funktion importAdressen
 * export = key-Wert zuordnen, Klasse Adressen_Backend, Funktion exportAdressen
 */
$GLOBALS["BE_MOD"]["content"]["adressen"] = array(
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
