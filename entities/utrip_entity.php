<?php
include_once("parent_entity.php");
/**
 * Classe entité de l'objet utrip
 * @author Gauthier
 * @version 2024
 */
class Utrip extends Entity
{
	// Propriétés
	protected string $_strPrefixe = "utrip_";

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

	/**
	 * Getter de récupération de la valeur de l'id
	 * @return identifiant de l'objet
	 */
	public function getId(): int
	{
		return $this->_id;
	}
	/**
	 * Setter de récupération de la valeur de l'id
	 * @return identifiant de l'objet
	 */
	public function setId(int $intId)
	{
		$this->_id = $intId;
	}

	/**
	 * Getter de récupération du nom de l'article
	 * @return nom de l'objet
	 */
	public function getName(): string
	{
		return $this->_name;
	}
	/**
	 * Setter de récupération du nom de l'article
	 * @return nom de l'objet
	 */
	public function setName(string $strName)
	{
		$this->_name = $strName;
	}

	/**
	 * Getter de récupération de la description
	 * @return description de l'objet
	 */
	public function getDescription(): string
	{
		return $this->_description;
	}
	/**
	 * Setter de récupération de la description
	 * @return description de l'objet
	 */
	public function setDescription(string $strDescription)
	{
		$this->_description = $strDescription;
	}
	/**
	 * Getter de récupération du résumé de la description
	 * @return resume de l'objet
	 */
	public function getDescriptionSummary(int $max)
	{
		$strDescription        = $this->_description;
		if (strlen($strDescription) > $max) {
			$strDescription    = substr($strDescription, 0, $max) . "...";
		}
		return $strDescription;
	}

	/**
	 * Getter de récupération du budget
	 * @return budget de l'objet
	 */
	public function getBudget(): string
	{
		return $this->_budget;
	}
	/**
	 * Setter de récupération du budget
	 * @return budget de l'objet
	 */
	public function setBudget(string $strBudget)
	{
		$this->_budget = $strBudget;
	}

	/**
	 * Getter de récupération de la date de publication
	 * @return publish_date de l'objet
	 */
	public function getDate(): string
	{
		return $this->_date;
	}
	/**
	 * Setter de récupération de la date de publication
	 * @return publish_date de l'objet
	 */
	public function setDate(string $strDate)
	{
		$this->_date = $strDate;
	}
	/**
	 * Getter de récupération de la date de publication sous le format français
	 * @return identifiant de l'objet
	 */
	public function getDateFr()
	{
		// Traitement de la date
		$objDate        = new DateTime($this->_date);
		return $objDate->format("d/m/Y");
	}

	/**
	 * Getter de récupération de l'auteur
	 * @return auteur de l'objet
	 */
	public function getCreator(): string
	{
		return $this->_creator;
	}
	/**
	 * Setter de récupération de l'auteur'
	 * @return auteur de l'objet
	 */
	public function setCreator(string $strCreator)
	{
		$this->_creator = $strCreator;
	}

	/**
	 * Getter de récupération de l'image
	 * @return image de l'objet
	 */
	public function getImg(): string
	{
		return $this->_img;
	}
	/**
	 * Setter de récupération de l'image'
	 * @return image de l'objet
	 */
	public function setImg(string $strImg)
	{
		$this->_img = $strImg;
	}

	/**
	 * Getter de récupération de la catégorie
	 * @return categorie de l'objet
	 */
	public function getCat(): string
	{
		return $this->_cat;
	}
	/**
	 * Setter de récupération de la catégorie
	 * @return categorie de l'objet
	 */
	public function setCat(string $strCat)
	{
		$this->_cat = $strCat;
	}

	/**
	 * Getter de récupération de la ville
	 * @return ville de l'objet
	 */
	public function getCity(): string
	{
		return $this->_city;
	}
	/**
	 * Setter de récupération de la ville
	 * @return ville de l'objet
	 */
	public function setCity(string $strCity)
	{
		$this->_city = $strCity;
	}

	/**
	 * Getter de récupération du pays
	 * @return pays de l'objet
	 */
	public function getCountry(): string
	{
		return $this->_country;
	}
	/**
	 * Setter de récupération du pays
	 * @return pays de l'objet
	 */
	public function setCountry(string $strCountry)
	{
		$this->_country = $strCountry;
	}

	/**
	 * Getter de récupération du contenu
	 * @return contenu de l'objet
	 */
	public function getCont(): string
	{
		return $this->_cont;
	}
	/**
	 * Setter de récupération du contenu
	 * @return contenu de l'objet
	 */
	public function setCont(string $strCont)
	{
		$this->_cont = $strCont;
	}

	/**
	 * Getter de récupération du like
	 * @return like de l'objet
	 */
	public function getLike(): string
	{
		return $this->_like;
	}
	/**
	 * Setter de récupération du like
	 * @return like de l'objet
	 */
	public function setLike(string $strLike)
	{
		$this->_like = $strLike;
	}

	/**
	 * Getter de récupération du commentaire
	 * @return commentaire de l'objet
	 */
	public function getCom(): string
	{
		return $this->_com;
	}
	/**
	 * Setter de récupération du commentaire
	 * @return commentaire de l'objet
	 */
	public function setCom(string $strCom)
	{
		$this->_com = $strCom;
	}
}
