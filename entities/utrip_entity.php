<?php
	include_once("parent_entity.php");
	
	/**
	 * Représente un Utrip, définissant les caractéristiques et les fonctionnalités d'un voyage ou d'une expérience partagée sur la plateforme.
	 * Cette classe hérite de la classe Entity, permettant ainsi une gestion standardisée des entités, incluant l'hydratation à partir d'un tableau de données.
	 * 
	 * @author Gauthier
	 * @version 2024
	 */
	class Utrip extends Entity {

		protected string $_strPrefixe = "utrip_";

		private int $_id;
		private string $_name;
		private string $_description;
		private string $_budget;
		private string $_date;
		private string $_creator;
		private int $_creatorId;
		private string $_img;
		private string $_cat;
		private string $_city;
		private string $_country;
		private string $_cont;
		private string $_like;
		private string $_com;
		private int $_cityId;
		private int $_catId;
		private int $_valid;
		private string $_comment;

	/**
	 * Récupère l'identifiant unique de l'Utrip.
	 * @return int L'identifiant de l'Utrip.
	 */
		public function getId(): int
		{
			return $this->_id;
		}

		/**
		 * Définit l'identifiant unique de l'Utrip.
		 * @param int $intId L'identifiant de l'Utrip.
		 */
		public function setId(int $intId)
		{
			$this->_id = $intId;
		}

		/**
		 * Récupère le nom de l'Utrip.
		 * @return string Le nom de l'Utrip.
		 */
		public function getName(): string
		{
			return $this->_name;
		}

		/**
		 * Définit le nom de l'Utrip.
		 * @param string $strName Le nom de l'Utrip.
		 */
		public function setName(string $strName)
		{
			$this->_name = trim($strName);
		}

		/**
		 * Récupère la description de l'Utrip.
		 * 
		 * @return string La description de l'Utrip.
		 */
		public function getDescription(): string
		{
			return $this->_description;
		}

		/**
		 * Définit la description de l'Utrip.
		 * 
		 * @param string $strDescription La description de l'Utrip.
		 */
		public function setDescription(string $strDescription)
		{
			$this->_description = trim($strDescription);
		}

		/**
		 * Récupère un résumé de la description de l'Utrip.
		 * 
		 * @param int $max La longueur maximale du résumé.
		 * @return string Le résumé de la description.
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
		 * Récupère le budget de l'Utrip.
		 * 
		 * @return string Le budget de l'Utrip.
		 */
		public function getBudget(): string
		{
			return $this->_budget;
		}

		/**
		 * Définit le budget de l'Utrip.
		 * 
		 * @param string $strBudget Le budget de l'Utrip.
		 */
		public function setBudget(string $strBudget) {
			$this->_budget = $strBudget;
		}

		/**
		 * Récupère la date de l'Utrip.
		 * 
		 * @return string La date de l'Utrip.
		 */
		public function getDate(): string {
			return $this->_date;
		}

		/**
		 * Définit la date de l'Utrip.
		 * 
		 * @param string $strDate La date de l'Utrip.
		 */
		public function setDate(string $strDate) {
			$this->_date = $strDate;
		}

		/**
		 * Convertit la date de l'Utrip au format français (jj/mm/aaaa).
		 * 
		 * @return string La date au format français.
		 */
		public function getDateFr() {
			// Traitement de la date
			$objDate        = new DateTime($this->_date);
			return $objDate->format("d/m/Y");
		}

		/**
		 * Récupère le créateur de l'Utrip.
		 * 
		 * @return string Le nom du créateur de l'Utrip.
		 */
		public function getCreator(): string {
			return $this->_creator;
		}

		/**
		 * Définit le créateur de l'Utrip.
		 * 
		 * @param string $strCreator Le nom du créateur de l'Utrip.
		 */
		public function setCreator(string $strCreator) {
			$this->_creator = $strCreator;
		}

		/**
		 * Récupère l'identifiant du créateur de l'Utrip.
		 * 
		 * @return int L'identifiant du créateur.
		 */
		public function getCreatorId(): int {
			return $this->_creatorId;
		}

		/**
		 * Définit l'identifiant du créateur de l'Utrip.
		 * 
		 * @param int $intCreatorId L'identifiant du créateur.
		 */
		public function setCreatorId(int $intCreatorId) {
			$this->_creatorId = $intCreatorId;
		}

		/**
		 * Récupère l'image principale de l'Utrip.
		 * 
		 * @return string Le chemin vers l'image principale.
		 */
		public function getImg(): string {
			return $this->_img;
		}

		/**
		 * Définit l'image principale de l'Utrip.
		 * 
		 * @param string $strImg Le chemin vers l'image principale.
		 */
		public function setImg(string $strImg) {
			$this->_img = $strImg;
		}

		/**
		 * Récupère la catégorie de l'Utrip.
		 * 
		 * @return string La catégorie de l'Utrip.
		 */
		public function getCat(): string {
			return $this->_cat;
		}

		/**
		 * Définit la catégorie de l'Utrip.
		 * 
		 * @param string $strCat La catégorie de l'Utrip.
		 */
		public function setCat(string $strCat) {
			$this->_cat = $strCat;
		}

		/**
		 * Récupère la ville de l'Utrip.
		 * 
		 * @return string La ville de l'Utrip.
		 */
		public function getCity(): string {
			return $this->_city;
		}

		/**
		 * Définit la ville de l'Utrip.
		 * 
		 * @param string $strCity La ville de l'Utrip.
		 */
		public function setCity(string $strCity) {
			$this->_city = $strCity;
		}

		/**
		 * Récupère le pays de l'Utrip.
		 * 
		 * @return string Le pays de l'Utrip.
		 */
		public function getCountry(): string {
			return $this->_country;
		}

		/**
		 * Définit le pays de l'Utrip.
		 * 
		 * @param string $strCountry Le pays de l'Utrip.
		 */
		public function setCountry(string $strCountry) {
			$this->_country = $strCountry;
		}

		/**
		 * Récupère le contenu supplémentaire de l'Utrip.
		 * 
		 * @return string Le contenu supplémentaire.
		 */
		public function getCont(): string {
			return $this->_cont;
		}

		/**
		 * Définit le contenu supplémentaire de l'Utrip.
		 * 
		 * @param string $strCont Le contenu supplémentaire.
		 */
		public function setCont(string $strCont) {
			$this->_cont = $strCont;
		}

		/**
		 * Récupère l'indicateur de like de l'Utrip.
		 * 
		 * @return string L'indicateur de like.
		 */
		public function getLike(): string {
			return $this->_like;
		}

		/**
		 * Définit l'indicateur de like de l'Utrip.
		 * 
		 * @param string $strLike L'indicateur de like.
		 */
		public function setLike(string $strLike) {
			$this->_like = $strLike;
		}

		/**
		 * Récupère le commentaire associé à l'Utrip.
		 * 
		 * @return string Le commentaire.
		 */
		public function getCom(): string {
			return $this->_com;
		}

		/**
		 * Définit le commentaire associé à l'Utrip.
		 * 
		 * @param string $strCom Le commentaire.
		 */
		public function setCom(string $strCom) {
			$this->_com = $strCom;
		}

		/**
		 * Récupère l'identifiant de la ville liée à l'Utrip.
		 * 
		 * @return int L'identifiant de la ville.
		 */
		public function getCatId(): int {
			return $this->_catId;
		}

		/**
		 * Définit l'identifiant de la ville liée à l'Utrip.
		 * 
		 * @param int $intCityId L'identifiant de la ville.
		 */
		public function setCatId(int $intCatId) {
			$this->_catId = $intCatId;
		}

		/**
		 * Récupère l'identifiant de la catégorie liée à l'Utrip.
		 * 
		 * @return int L'identifiant de la catégorie.
		 */
		public function getCityId(): int {
			return $this->_cityId;
		}

		/**
		 * Définit l'identifiant de la catégorie liée à l'Utrip.
		 * 
		 * @param int $intCatId L'identifiant de la catégorie.
		 */
		public function setCityId(int $intCityId) {
			$this->_cityId = $intCityId;
		}

		/**
		 * Récupère l'état de validation de l'Utrip.
		 * 
		 * @return int L'état de validation (1 pour validé, 0 pour non validé).
		 */
		public function getValid():int{ 
			return $this->_valid;
		}

		/**
		 * Définit l'état de validation de l'Utrip.
		 * 
		 * @param int $intValid L'état de validation (1 pour validé, 0 pour non validé).
		 */
		public function setValid(int $intValid){ 
			$this->_valid = $intValid;
		}		
		
		/**
		 * Récupère le commentaire de validation de l'Utrip.
		 * 
		 * @return string Le commentaire de validation.
		 */
		public function getComment():string{ 
			return $this->_comment;
		}

		/**
		 * Définit le commentaire de validation de l'Utrip.
		 * 
		 * @param string $strComment Le commentaire de validation.
		 */
		public function setComment(string $strComment){ 
			$this->_comment = trim($strComment); // Enlève les espaces avant et après
			$this->_comment = filter_var($this->_comment, FILTER_SANITIZE_FULL_SPECIAL_CHARS); // nettoyage
		}		
	}
