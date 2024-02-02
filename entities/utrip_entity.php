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
	private string $_img;
	private string $_cat;
	private string $_city;
	private string $_country;
	private string $_cont;
	private string $_like;
	private string $_com;

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
	public function getName(): string
	{
		return $this->_name;
	}
	public function setName(string $strName)
	{
		$this->_name = $strName;
	}

	// getter et setter de description 
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

	// getter et setter du budget 
	public function getBudget(): string
	{
		return $this->_budget;
	}
	public function setBudget(string $strBudget)
	{
		$this->_budget = $strBudget;
	}
	// getter et setter de la date
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
	// getter et setter de l'image
	public function getImg(): string
	{
		return $this->_img;
	}
	public function setImg(string $strImg)
	{
		$this->_img = $strImg;
	}
	// getter et setter de la categorie
	public function getCat(): string
	{
		return $this->_cat;
	}
	public function setCat(string $strCat)
	{
		$this->_cat = $strCat;
	}
	// getter et setter de la ville
	public function getCity(): string
	{
		return $this->_city;
	}
	public function setCity(string $strCity)
	{
		$this->_city = $strCity;
	}
	// getter et setter du pays
	public function getCountry(): string
	{
		return $this->_country;
	}
	public function setCountry(string $strCountry)
	{
		$this->_country = $strCountry;
	}
	// getter et setter du continent
	public function getCont(): string
	{
		return $this->_cont;
	}
	public function setCont(string $strCont)
	{
		$this->_cont = $strCont;
	}
	// getter et setter du like
	public function getLike(): string
	{
		return $this->_like;
	}
	public function setLike(string $strLike)
	{
		$this->_like = $strLike;
	}
	// getter et setter du commentaire
	public function getCom(): string
	{
		return $this->_com;
	}
	public function setCom(string $strCom)
	{
		$this->_com = $strCom;
	}
}
