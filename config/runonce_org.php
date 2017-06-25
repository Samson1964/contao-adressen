<?php
class AdresseRunonceJob extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->import('Database');
	}

	public function run()
	{
		// Neue Felder anlegen
		$this->Database->prepare("ALTER TABLE `tl_adressen` ADD `alt` varchar(255) NOT NULL default ''")->execute();
		$this->Database->prepare("ALTER TABLE `tl_adressen` ADD `imagemargin` varchar(128) NOT NULL default ''")->execute();
		$this->Database->prepare("ALTER TABLE `tl_adressen` ADD `imageUrl` varchar(255) NOT NULL default ''")->execute();
		$this->Database->prepare("ALTER TABLE `tl_adressen` ADD `fullsize` char(1) NOT NULL default ''")->execute();
		$this->Database->prepare("ALTER TABLE `tl_adressen` ADD `caption` varchar(255) NOT NULL default ''")->execute();
		$this->Database->prepare("ALTER TABLE `tl_adressen` ADD `floating` varchar(12) NOT NULL default ''")->execute();
		$this->Database->prepare("ALTER TABLE `tl_adressen` ADD `alias` varbinary(128) NOT NULL default ''")->execute();
		$this->Database->prepare("ALTER TABLE `tl_adressen` ADD KEY `alias` (`alias`)")->execute();
        
		// Vorhandene Felder umbenennen
		$this->Database->prepare("ALTER TABLE `tl_adressen` CHANGE `bild` `singleSRC` varchar(255) NOT NULL default ''")->execute();
		$this->Database->prepare("ALTER TABLE `tl_adressen` CHANGE `addBild` `addImage` char(1) NOT NULL default ''")->execute();

		// Log-Eintrag machen
		$arrInsert=array(
			'action'    => 'TL_CONFIGURATION',
			'text'      => 'add fields tl_adressen'
		);
		$this->Database->prepare("INSERT INTO tl_log %s")->set($arrInsert)->execute();

		// Datensätze ändern
		$objAdresse = $this->Database->prepare("SELECT * FROM tl_adressen")->execute();

		while($objAdresse->next())
		{
			if($objAdresse->size)
			{
				// Format der Bildgröße muß geändert werden
				$size = serialize(array(80, 56, $objAdresse->size));
				$set = array(
					'size'  => $size
				);
				$this->Database->prepare("UPDATE tl_adressen %s WHERE id=?")->set($set)->execute($objAdresse->id);
			}
			// Alias anlegen
			$alias = $this->generateAlias($objAdresse->nachname, $objAdresse->vorname, $objAdresse->id);
			$set = array(
				'alias'  => $alias
			);
			$this->Database->prepare("UPDATE tl_adressen %s WHERE id=?")->set($set)->execute($objAdresse->id);
		}
		
		// Dateifeld umwandeln, wenn Contao >= 3.2
		if (version_compare(VERSION, '3.2', '>='))
		{
			Database\Updater::convertSingleField('tl_adressen', 'singleSRC');
		}

	}

	public function generateAlias($nachname, $vorname, $id)
	{
		$varValue = standardize(String::restoreBasicEntities($nachname.'-'.$vorname));

		$objAlias = $this->Database->prepare("SELECT id FROM tl_adressen WHERE alias=?")
								   ->execute($varValue);

		// Add ID to alias
		if($objAlias->numRows)
		{
			$varValue .= '-'.$id;
		}

		return $varValue;
	} 
}

$objAdresseRunonceJob = new AdresseRunonceJob();
$objAdresseRunonceJob->run();

?>