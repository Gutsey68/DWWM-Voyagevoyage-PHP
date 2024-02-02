<?php
class Forum
{
	// Propriétés
	private string $_strPrefixe = "topic_";

	private int $_id;
	private string $_title;
	private string $_content;
	private string $_date;
	private string $_code;
	private string $_creator;

	// Méthodes
	// fonction permettant de remplir l'objet
	public function hydrate($arrData)
	{

		foreach ($arrData as $key => $value) {
			$strSetterName	= "set" . ucfirst(str_replace($this->_strPrefixe, "", $key));
			// Si le setter existe dans la classe 
			if (method_exists($this, $strSetterName)) {
				$this->$strSetterName($value);
			}
		}
	}

	// getter de récupération de la valeur de l'id
	public function getId(): int
	{
		return $this->_id;
	}
	// setter de modification de la valeur de l'id
	public function setId(int $intId)
	{
		$this->_id = $intId;
	}

	// getter et setter de title
	public function getTitle(): string
	{
		return $this->_title;
	}
	public function setTitle(string $strTitle)
	{
		$this->_title = $strTitle;
	}

	// getter et setter du contenu
	public function getContent(): string
	{
		return $this->_content;
	}
	public function setContent(string $strContent)
	{
		$this->_content = $strContent;
	}

	public function getContentSummary(int $max)
	{
		$strContent        = $this->_content;
		if (strlen($strContent) > $max) {
			$strContent    = substr($strContent, 0, $max) . "...";
		}
		return $strContent;
	}

	// getter et setter du code
	public function getCode(): string
	{
		return $this->_code;
	}
	public function setCode(string $strCode)
	{
		$this->_code = $strCode;
	}
	// getter et setter de date
	public function getDate(): string
	{
		return $this->_date;
	}
	public function setDate(string $strDate)
	{
		$this->_date = $strDate;
	}

	public function getDateFr()
	{
		// Traitement de la date
		$objDate        = new DateTime($this->_date);
		return $objDate->format("d/m/Y");
	}
	// getter et setter du createur
	public function getCreator(): string
	{
		return $this->_creator;
	}
	public function setCreator(string $strCreator)
	{
		$this->_creator = $strCreator;
	}
}
