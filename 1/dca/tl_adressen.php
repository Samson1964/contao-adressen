<?php

/**
 * Tabelle tl_adressen
 */
$GLOBALS['TL_DCA']['tl_adressen'] = array
(

	// Konfiguration
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		),
	),

	// Datensätze auflisten
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 2,
			'fields'                  => array('nachname','vorname'),
			'flag'                    => 1,
			'panelLayout'             => 'filter;sort,search,limit',
		),
		'label' => array
		(
			// Das Feld aktiv wird vom label_callback überschrieben
			'fields'                  => array('aktiv','id','nachname','vorname','plz','ort'),
			'showColumns'             => true,
			'format'                  => '%s',
			'label_callback'          => array('tl_adresse_aktivicon','addIcon')
		),
		'global_operations' => array
		(
			'import' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_adressen']['import'],
				'icon'                => 'system/modules/adressen/assets/images/importCSV.gif',
				'href'                => 'key=import',
				'class'               => 'header_csv_import',
				'attributes'          => 'onclick="Backend.getScrollOffset();"'
			),
			'export' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_adressen']['export'],
				'icon'                => 'system/modules/adressen/assets/images/exportCSV.gif',
				'href'                => 'key=export',
				'class'               => 'header_csv_export',
				'attributes'          => 'onclick="Backend.getScrollOffset();"'
			),
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_adressen']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_adressen']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif',
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_adressen']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_adressen']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif',
				'attributes'          => 'style="margin-right:3px"'
			),
		)
	),

	// Paletten
	'palettes' => array
	(
		'__selector__'                => array('addBild'),
		'default'                     => '{person_legende},nachname,vorname,titel,firma;{adresse_legende:hide},plz,ort,ort_view,strasse,strasse_view;{telefon_legende:hide},telefon1,telefon2,telefon3,telefon4,telefon_view;{telefax_legende:hide},telefax1,telefax2,telefax_view;{email_legende:hide},email1,email2,email3,email4,email5,email6,email_view;{web_legende:hide},homepage,facebook,twitter,google,icq,yahoo,aim,msn,irc;{bild_legende:hide},addBild;{text_legende:hide},text;{info_legende:hide},info,links;{aktiv_legende},aktiv'
	),

	// Unterpaletten
	'subpalettes' => array
	(
		'addBild'                     => 'bild,prozentx,prozenty',
	),

	// Felder
	'fields' => array
	(
		'id' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['id'],
			'sorting'                 => true,
			'search'                  => true,
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['tstamp'],
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'nachname' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['nachname'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'filter'                  => true,
			'search'                  => true,
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'vorname' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['vorname'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => true,
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'titel' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['titel'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => false,
			'eval'                    => array('mandatory'=>false, 'maxlength'=>64, 'tl_class'=>'w50 clr'),
			'sql'                     => "varchar(64) NOT NULL default ''"
		),
		'firma' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['firma'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => true,
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50 clr'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'ort_view' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['ort_view'],
			'exclude'                 => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'sql'                     => "char(1) NOT NULL default '1'"
		),
		'plz' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['plz'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'filter'                  => true,
			'search'                  => true,
			'eval'                    => array('mandatory'=>false, 'maxlength'=>64, 'tl_class'=>'w50 clr'),
			'sql'                     => "varchar(64) NOT NULL default ''"
		),
		'ort' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['ort'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'filter'                  => true,
			'search'                  => true,
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'strasse_view' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['strasse_view'],
			'exclude'                 => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class'=>'w50 clr'),
			'sql'                     => "char(1) NOT NULL default '1'"
		),
		'strasse' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['strasse'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => true,
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'telefon_view' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['telefon_view'],
			'exclude'                 => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'sql'                     => "char(1) NOT NULL default '1'"
		),
		'telefon1' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['telefon1'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => true,
			'eval'                    => array('mandatory'=>false, 'maxlength'=>64, 'tl_class'=>'w50'),
			'sql'                     => "varchar(64) NOT NULL default ''"
		),
		'telefon2' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['telefon2'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => true,
			'eval'                    => array('mandatory'=>false, 'maxlength'=>64, 'tl_class'=>'w50'),
			'sql'                     => "varchar(64) NOT NULL default ''"
		),
		'telefon3' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['telefon3'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => true,
			'eval'                    => array('mandatory'=>false, 'maxlength'=>64, 'tl_class'=>'w50'),
			'sql'                     => "varchar(64) NOT NULL default ''"
		),
		'telefon4' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['telefon4'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => true,
			'eval'                    => array('mandatory'=>false, 'maxlength'=>64, 'tl_class'=>'w50'),
			'sql'                     => "varchar(64) NOT NULL default ''"
		),
		'telefax_view' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['telefax_view'],
			'exclude'                 => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'sql'                     => "char(1) NOT NULL default '1'"
		),
		'telefax1' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['telefax1'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => true,
			'eval'                    => array('mandatory'=>false, 'maxlength'=>64, 'tl_class'=>'w50'),
			'sql'                     => "varchar(64) NOT NULL default ''"
		),
		'telefax2' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['telefax2'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => true,
			'eval'                    => array('mandatory'=>false, 'maxlength'=>64, 'tl_class'=>'w50'),
			'sql'                     => "varchar(64) NOT NULL default ''"
		),
		'email_view' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['email_view'],
			'exclude'                 => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'sql'                     => "char(1) NOT NULL default '1'"
		),
		'email1' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['email1'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => true,
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50', 'rgxp'=>'email'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'email2' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['email2'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => true,
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50', 'rgxp'=>'email'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'email3' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['email3'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => true,
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50', 'rgxp'=>'email'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'email4' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['email4'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => true,
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50', 'rgxp'=>'email'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'email5' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['email5'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => true,
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50', 'rgxp'=>'email'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'email6' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['email6'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => true,
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50', 'rgxp'=>'email'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'homepage' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['homepage'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => false,
			'eval'                    => array('mandatory'=>false, 'tl_class'=>'long'),
			'sql'                     => "text NULL"
		),
		'facebook' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['facebook'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => false,
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'twitter' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['twitter'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => false,
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'google' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['google'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => false,
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'icq' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['icq'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => false,
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'yahoo' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['yahoo'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => false,
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'aim' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['aim'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => false,
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'msn' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['msn'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => false,
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'irc' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['irc'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => false,
			'eval'                    => array('mandatory'=>false, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'addBild' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['addBild'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'bild' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['bild'],
			'inputType'               => 'fileTree',
			'exclude'                 => true,
			'flag'                    => 1,
			'eval'                    => array('mandatory'=>false, 'files'=>true, 'files_only'=>true, 'fieldType'=>'radio', 'extensions'=>'jpg,gif,png', 'tl_class'=>'w50 clr'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'size' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['size'],
			'exclude'                 => true,
			'default'                 => 'center_center',
			'inputType'               => 'select',
			'options'                 => $GLOBALS['TL_CROP'],
			'reference'               => &$GLOBALS['TL_LANG']['MSC'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(64) NOT NULL default ''"
		),
		'prozentx' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['prozentx'],
			'exclude'                 => true,
			'default'                 => 50,
			'inputType'               => 'select',
			'options'                 => $GLOBALS['TL_ADRESSEN'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "int(3) unsigned NOT NULL default '0'"
		),
		'prozenty' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['prozenty'],
			'exclude'                 => true,
			'default'                 => 50,
			'inputType'               => 'select',
			'options'                 => $GLOBALS['TL_ADRESSEN'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "int(3) unsigned NOT NULL default '0'"
		),
		'text' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['text'],
			'inputType'               => 'textarea',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => true,
			'eval'                    => array('mandatory'=>false, 'tl_class'=>'long'),
			'sql'                     => "text NULL"
		),
		'info' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['info'],
			'inputType'               => 'textarea',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => true,
			'eval'                    => array('mandatory'=>false, 'tl_class'=>'long'),
			'sql'                     => "text NULL"
		),
		'links' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['links'],
			'inputType'               => 'textarea',
			'exclude'                 => true,
			'search'                  => true,
			'eval'                    => array('mandatory'=>false, 'tl_class'=>'long', 'readonly'=>true),
			'sql'                     => "text NULL"
		),
		'aktiv' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_adressen']['aktiv'],
			'exclude'                 => true,
			'filter'                  => true,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('doNotCopy'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
	)
);

/**
 * Class tl_member_onlineicon
 *
 * @copyright  Glen Langer 2009..2012
 * @author     Glen Langer
 * @package    BackendUserOnline
 */
class tl_adresse_aktivicon extends Backend
{
    /**
     * Add an image to each record
     * @param array
     * @param string
     * @param DataContainer
     * @param array
     * @return string
     */
	public function addIcon($row, $label, DataContainer $dc, $args)
	{
		// Anzahl Einbindungen feststellen und Singular/Plural zuweisen
		$seiten = count(explode("\n",$row['links']))-1;
		($seiten == 1) ? ($wort = 'Seite') : ($wort = 'Seiten');

		if($row['aktiv'] && $row['links'])
		{
			// Adresse aktiv, ein oder mehrere Einbindungen
			$icon = 'system/modules/adressen/assets/images/gruen.png';
			$title = 'Adresse eingebunden auf '.$seiten.' '.$wort;
		}
		elseif($row['aktiv'])
		{
			// Adresse aktiv, keine Einbindungen
			$icon = 'system/modules/adressen/assets/images/gelb.png';
			$title = 'Adresse aktiv, aber nicht eingebunden';
		}
		elseif($row['links'])
		{
			// Adresse nicht aktiv, ein oder mehrere Einbindungen
			$icon = 'system/modules/adressen/assets/images/gelb.png';
			$title = 'Adresse nicht aktiv, aber auf '.$seiten.' '.$wort.' eingebunden';
		}
		else
		{
			// Adresse nicht aktiv, keine Einbindungen
			$icon = 'system/modules/adressen/assets/images/rot.png';
			$title = 'Adresse nicht aktiv und nicht eingebunden';
		}

		// Spalte 0 (aktiv) in Ausgabe überschreiben
		$args[0] = '<span href="" title="'.$title.'">'.Image::getHtml($icon,'').'</span>';

		// Modifizierte Zeile zurückgeben
		return $args;

	}

}
