<?php

class adresseClass extends \ContentElement
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'adresse_default';

	/**
	 * Generate the module
	 */
	protected function compile()
	{
	
		// Adresse aus Datenbank laden, wenn ID übergeben wurde
		if($this->adresse_id)
		{
			$objAdresse = $this->Database->prepare("SELECT * FROM tl_adressen WHERE id=?")->execute($this->adresse_id);

			// Adresse gefunden
			if($objAdresse)
			{
				// Template zuweisen
				if(!$this->adresse_tpl) $this->adresse_tpl = $this->strTemplate;
				$this->Template = new \FrontendTemplate($this->adresse_tpl);

				// Name zusammenbauen
				$this->Template->name = $objAdresse->nachname;
				if($objAdresse->vorname) $this->Template->name = $objAdresse->vorname." ".$this->Template->name;
				if($objAdresse->titel) $this->Template->name = $objAdresse->titel." ".$this->Template->name;

				// Visitenkarte zusammenbauen
				if($objAdresse->text)
				{
					$this->Template->visitenkarte = str_replace("\r\n","<br />",$objAdresse->text);
					$this->Template->visitenkarte = str_replace("\n","<br />",$this->Template->visitenkarte);
					$this->Template->visitenkarte = str_replace('"',"&quot;",$this->Template->visitenkarte);
				}

				// Adresse zusammenbauen
				if($objAdresse->ort_view && $objAdresse->ort) $this->Template->adresse = $objAdresse->ort;
				if($objAdresse->ort_view && $objAdresse->plz) $this->Template->adresse = $objAdresse->plz." ".$this->Template->adresse;
				if($objAdresse->strasse_view && $objAdresse->ort_view && $objAdresse->strasse) $this->Template->adresse = $objAdresse->strasse.", ".$this->Template->adresse;

				// Telefon-Arrays erstellen
				if($objAdresse->telefon_view)
				{
					$telefon = array();
					$telefon_fest = array();
					$telefon_mobil = array();
					if($objAdresse->telefon1) 
					{
						$telefon[] = $objAdresse->telefon1;
						($this->Mobilfunk($objAdresse->telefon1)) ? $telefon_mobil[] = $objAdresse->telefon1 : $telefon_fest[] = $objAdresse->telefon1;
					}
					if($objAdresse->telefon2) 
					{
						$telefon[] = $objAdresse->telefon2;
						($this->Mobilfunk($objAdresse->telefon2)) ? $telefon_mobil[] = $objAdresse->telefon2 : $telefon_fest[] = $objAdresse->telefon2;
					}
					if($objAdresse->telefon3) 
					{
						$telefon[] = $objAdresse->telefon3;
						($this->Mobilfunk($objAdresse->telefon3)) ? $telefon_mobil[] = $objAdresse->telefon3 : $telefon_fest[] = $objAdresse->telefon3;
					}
					if($objAdresse->telefon4) 
					{
						$telefon[] = $objAdresse->telefon4;
						($this->Mobilfunk($objAdresse->telefon4)) ? $telefon_mobil[] = $objAdresse->telefon4 : $telefon_fest[] = $objAdresse->telefon4;
					}
				}

				// Telefax-Array erstellen
				if($objAdresse->telefax_view)
				{
					$telefax = array();
					if($objAdresse->telefax1) $telefax[] = $objAdresse->telefax1;
					if($objAdresse->telefax2) $telefax[] = $objAdresse->telefax2;
				}

				// Email-Array erstellen
				if($objAdresse->email_view)
				{
					$email = array();
					if($objAdresse->email1) $email[] = $objAdresse->email1;
					if($objAdresse->email2) $email[] = $objAdresse->email2;
					if($objAdresse->email3) $email[] = $objAdresse->email3;
					if($objAdresse->email4) $email[] = $objAdresse->email4;
					if($objAdresse->email5) $email[] = $objAdresse->email5;
					if($objAdresse->email6) $email[] = $objAdresse->email6;
				}

				// Bild-Elemente erstellen
				if($this->adresse_viewfoto)
				{
					// Fotoausgabe erwünscht, jetzt die Quelle bestimmen
					if($this->addImage && $this->singleSRC != '')
					{
						// Bild aus Inhaltselement verwenden!
						if($this->singleSRC)
						{
							(version_compare(VERSION, '3.2', '>=')) ? $objModel = \FilesModel::findByUuid($this->singleSRC) : $objModel = \FilesModel::findByPk($this->singleSRC);
							if($objModel !== null && is_file(TL_ROOT . '/' . $objModel->path))
							{
								$bildurl = $objModel->path;
								$bildarray['singleSRC'] = $bildurl;
								$bildarray['alt'] = $this->alt;
								$bildarray['size'] = $this->size;
								$bildarray['imagemargin'] = $this->imagemargin;
								$bildarray['imageUrl'] = $this->imageUrl;
								$bildarray['fullsize'] = $this->fullsize;
								$bildarray['caption'] = $this->caption;
								$bildarray['floating'] = $this->floating;
								// Templatewerte des Bildes von Contao zusammenbauen lassen
								$this->addImageToTemplate($this->Template, $bildarray); 
							}
						}
					}
					elseif($objAdresse->addImage && $objAdresse->singleSRC != '')
					{
						// Bild aus tl_adressen verwenden!
						if($objAdresse->singleSRC)
						{
							(version_compare(VERSION, '3.2', '>=')) ? $objModel = \FilesModel::findByUuid($objAdresse->singleSRC) : $objModel = \FilesModel::findByPk($objAdresse->singleSRC);
							if($objModel !== null && is_file(TL_ROOT . '/' . $objModel->path))
							{
								$bildurl = $objModel->path;
								$objAdresse->singleSRC = $bildurl;
								// Templatewerte des Bildes von Contao zusammenbauen lassen
								$this->addImageToTemplate($this->Template, $objAdresse->row()); 
							}
						}
					}
				}

				// Daten aus tl_adressen in das Template schreiben
				$this->Template->id            = $objAdresse->id;
				$this->Template->nachname      = $objAdresse->nachname;
				$this->Template->vorname       = $objAdresse->vorname ;
				$this->Template->titel         = $objAdresse->titel   ;
				$this->Template->firma         = $objAdresse->firma   ;
				$this->Template->strasse       = $objAdresse->strasse ;
				$this->Template->plz           = $objAdresse->plz     ;
				$this->Template->ort           = $objAdresse->ort     ;
				$this->Template->telefon       = $telefon;
				$this->Template->telefon_fest  = $telefon_fest;
				$this->Template->telefon_mobil = $telefon_mobil;
				$this->Template->telefax       = $telefax;
				$this->Template->email         = $email;
				$this->Template->homepage      = $objAdresse->homepage;
				$this->Template->facebook      = $objAdresse->facebook;
				$this->Template->twitter       = $objAdresse->twitter ;
				$this->Template->google        = $objAdresse->google  ;
				$this->Template->icq           = $objAdresse->icq     ;
				$this->Template->yahoo         = $objAdresse->yahoo   ;
				$this->Template->aim           = $objAdresse->aim     ;
				$this->Template->msn           = $objAdresse->msn     ;
				$this->Template->irc           = $objAdresse->irc     ;
				$this->Template->viewfoto      = $this->adresse_viewfoto;
				$this->Template->text          = $objAdresse->text    ;
				$this->Template->info          = $objAdresse->info    ;
				$this->Template->aktiv         = $objAdresse->aktiv   ;

				// Daten aus tl_content in das Template schreiben
				$this->Template->funktion    = $this->adresse_funktion;
				$this->Template->zusatz      = $this->adresse_zusatz;

				// Standardbildausrichtung setzen
				if(!$this->Template->floatClass) $this->Template->floatClass = 'float_left'; 
			}
		}

		return;

	}

	/**
	 * Funktion Mobilnetz
	 * @param: zu prüfende Nummer
	 * @return: true = ja, Mobilfunknummer
	 */
	protected function Mobilfunk($nummer)
	{

		$vorwahl = substr($nummer,0,4);
		switch($vorwahl)
		{
			case '0150':
			case '0151':
			case '0152':
			case '0155':
			case '0156':
			case '0157':
			case '0159':
			case '0160':
			case '0161':
			case '0162':
			case '0163':
			case '0170':
			case '0171':
			case '0172':
			case '0173':
			case '0174':
			case '0175':
			case '0176':
			case '0177':
			case '0178':
			case '0179':
				return true;
			default: 
				return false;
		}
	}

}
?>