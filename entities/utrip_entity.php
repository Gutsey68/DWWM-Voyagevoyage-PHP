<?php
class Utrip
{
	// Propriétés
	private string $_strPrefixe = "utrip_";

	private int $_id;
	private string $_name;
	private string $_description;
	private string $_budget;
	private string $_date;
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
			//$this->set$key($value);
		}

		/*$this->setId($arrData['article_id']);
			$this->setTitle($arrData['article_title']);
			$this->setImg($arrData['article_img']);*/
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
	public function getName(): string
	{
		return $this->_name;
	}
	public function setName(string $strName)
	{
		$this->_name = $strName;
	}

	// getter et setter de img
	public function getDescription(): string
	{
		return $this->_description;
	}
	public function setDescription(string $strDescription)
	{
		$this->_description = $strDescription;
	}

	public function getDescriptionSummary(int $max)
	{
		$strDescription        = $this->_description;
		if (strlen($strDescription) > $max) {
			$strDescription    = substr($strDescription, 0, $max) . "...";
		}
		return $strDescription;
	}

	// getter et setter de content
	public function getBudget(): string
	{
		return $this->_budget;
	}
	public function setContent(string $strBudget)
	{
		$this->_budget = $strBudget;
	}
	// getter et setter de createdate
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
	// getter et setter de creator
	public function getCreator(): string
	{
		return $this->_creator;
	}
	public function setCreator(string $strCreator)
	{
		$this->_creator = $strCreator;
	}
}
