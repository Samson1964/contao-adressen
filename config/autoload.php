<?php

/**
 * Klassen registrieren
 */

ClassLoader::addClasses(array
(
	'Adressen_Frontend'  => 'system/modules/adressen/classes/Adressen_Frontend.php',
	'Adressen_Backend'   => 'system/modules/adressen/classes/Adressen_Backend.php',
	'adresseClass'       => 'system/modules/adressen/classes/Adresse.php',
));

/**
 * Templates registrieren
 */
TemplateLoader::addFiles(array
(
	'ce_adressen'        => 'system/modules/adressen/templates',
	'adresse_default'    => 'system/modules/adressen/templates',
));
