<?php

/**
 * Klassen registrieren
 */

ClassLoader::addClasses(array
(
	'Adressen_Frontend'  => 'system/modules/adressen/classes/Adressen_Frontend.php',
	'Adressen_Backend'   => 'system/modules/adressen/classes/Adressen_Backend.php',
));

/**
 * Templates registrieren
 */
TemplateLoader::addFiles(array
(
	'ce_adressen'        => 'system/modules/adressen/templates',
));
