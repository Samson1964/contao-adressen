<?php

namespace Samson\Adressen;

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * @link http://www.contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 * 
 * Modul Banner - Check Helper 
 * 
 * PHP version 5
 * @copyright  Glen Langer 2007..2015
 * @author     Glen Langer
 * @package    Banner
 * @license    LGPL
 */


/**
 * Class BannerCheckHelper
 *
 * @copyright  Glen Langer 2015
 * @author     Glen Langer
 * @package    Banner
 */

class Funktionen extends \Frontend
{
	/**
	 * Current object instance
	 * @var object
	 */
	protected static $instance = null;

	var $user;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		// Benutzerdaten laden
		if(FE_USER_LOGGED_IN)
		{
			// Frontenduser eingeloggt
			$this->user = \FrontendUser::getInstance();
		}
		parent::__construct();
	}


	/**
	 * Return the current object instance (Singleton)
	 * @return BannerCheckHelper
	 */
	public static function getInstance()
	{
		if (self::$instance === null)
		{
			self::$instance = new \Samson\Adressen\Funktionen();
		}
	
		return self::$instance;
	}


	/**
	 * Gibt ein Array mit den Funktionen zurück
	 * @param id	ID in DeWIS
	 * @return		ID des Contao-Mitgliedes
	 */
	public static function getFunktionen()
	{
		// Referate zuordnen
		$array = array
		(
			'prae'      => 'DSB-Präsidium',
			'gs'        => 'DSB-Geschäftsstelle',
			'ha'        => 'DSB-Hauptausschuss',
			'kaus'      => 'DSB-Kommission Ausbildung',
			'klsp'      => 'DSB-Kommission Leistungssport',
			'kfrau'     => 'DSB-Kommission Frauenschach',
			'ksen'      => 'DSB-Kommission Seniorenschach',
			'kdwz'      => 'DSB-Wertungskommission',
			'ksr'       => 'DSB-Schiedsrichterkommission',
			'bsger'     => 'Bundesschiedsgericht',
			'kspk'      => 'Bundesspielkommission',
			'btger'     => 'Bundesturniergericht',
			'lvprae'    => 'Präsident Landesverband',
			'ehren'     => 'Ehrenpräsident/-mitglied',
			'rech'      => 'Rechnungsprüfer',
			'atrain'    => 'A-Trainerausbildung 2017',
			'kon17'     => 'Bundeskongress 2017',
			'kaderm'    => 'Kader männlich',
			'kaderw'    => 'Kader weiblich',
			'kaderabm'  => 'Kader A und B männlich',
			'kaderabw'  => 'Kader A und B weiblich',
			'kaderacm'  => 'Kader A bis C männlich',
			'kaderacw'  => 'Kader A bis C weiblich',
			'kaderalle' => 'Kader A, B, C und D/C männlich und weiblich'
		);
		return $array;

	}

}