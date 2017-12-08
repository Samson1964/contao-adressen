<?php
class AdresseRunonceJob extends Controller
{
	var $funktionArr = array
	(
		'prae'      => 1,
		'gs'        => 2,
		'ha'        => 3,
		'kaus'      => 4,
		'klsp'      => 5,
		'kfrau'     => 6,
		'ksen'      => 7,
		'kdwz'      => 8,
		'ksr'       => 9,
		'bsger'     => 10,
		'kspk'      => 11,
		'btger'     => 12,
		'lvprae'    => 13,
		'ehren'     => 14,
		'rech'      => 15,
		'atrain'    => 16,
		'kon17'     => 17,
		'kaderm'    => 18,
		'kaderw'    => 19,
		'kaderabm'  => 20,
		'kaderabw'  => 21,
		'kaderacm'  => 22,
		'kaderacw'  => 23,
		'kaderalle' => 24
	);

	public function __construct()
	{
		parent::__construct();
		$this->import('Database');
	}

	public function run()
	{
		// Datensätze ändern
		$objAdresse = $this->Database->prepare("SELECT * FROM tl_adressen")->execute();

		while($objAdresse->next())
		{
			if($objAdresse->funktionen)
			{
				// Funktionen umwandeln in das neue Format
				$funktionen = unserialize($objAdresse->funktionen);
				print_r($funktionen);
				$newArr = array();
				foreach($funktionen as $funktion)
				{
					if($this->funktionArr[$funktion]) 
					{
						echo "Gefunden: $funktion / neu: ".$this->funktionArr[$funktion]."\n";
						$newArr[] = $this->funktionArr[$funktion];
					}
				}
				if($newArr)
				{
					print_r($newArr);
					$set = array(
						'funktionen'  => serialize($newArr)
					);
					$this->Database->prepare("UPDATE tl_adressen %s WHERE id=?")->set($set)->execute($objAdresse->id);
				}
			}
		}
	}
}

$objAdresseRunonceJob = new AdresseRunonceJob();
$objAdresseRunonceJob->run();

?>
