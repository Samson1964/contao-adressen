<?php

/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
    'Samson',
));

/**
 * Klassen registrieren
 */

ClassLoader::addClasses(array
(
	'Samson\Adressen\Adressen_Frontend'  => 'system/modules/adressen/classes/Adressen_Frontend.php',
	'Samson\Adressen\Adressen_Backend'   => 'system/modules/adressen/classes/Adressen_Backend.php',
	'Samson\Adressen\adresseClass'       => 'system/modules/adressen/classes/Adresse.php',
	'Samson\Adressen\Wertungsreferenten' => 'system/modules/adressen/classes/Wertungsreferenten.php',
	'Samson\Adressen\Suche'              => 'system/modules/adressen/classes/Suche.php',
	'Samson\Adressen\Funktionen'         => 'system/modules/adressen/helper/Funktionen.php', 
));

/**
 * Templates registrieren
 */
TemplateLoader::addFiles(array
(
	'ce_adressen'        => 'system/modules/adressen/templates',
	'adresse_default'    => 'system/modules/adressen/templates',
	'adresse_referenten' => 'system/modules/adressen/templates',
	'adresse_suche'      => 'system/modules/adressen/templates',
	'adresse_ergebnisse' => 'system/modules/adressen/templates',
));
