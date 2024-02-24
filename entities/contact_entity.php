<?php
	include_once("parent_entity.php");
	
	/**
	 * Classe entité de l'objet contact
	 * @author Gauthier
	 * @version 2024
	 */
	class Contact extends Entity {
		// Propriétés

		protected string $_strPrefixe = "contact_";

		private int $_id;
		private string $_mail;
		private string $_title;
		private string $_name;
		private string $_content;
		private string $_date;

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
		 * Getter de récupération du mail
		 * @return string de l'objet
		 */
		public function getMail(): string
		{
			return $this->_mail;
		}

		/**
		 * Setter de récupération du mail
		 * @return mail de l'objet
		 */
		public function setMail(string $strMail)
		{
			$this->_mail = $strMail;
		}

		/**
		 * Getter de récupération de la description
		 * @return title de l'objet
		 */
		public function getTitle(): string
		{
			return $this->_title;
		}

		/**
		 * Setter de récupération de la description
		 * @return tilte de l'objet
		 */
		public function setTitle(string $strTitle)
		{
			$this->_title = $strTitle;
		}

		/**
		 * Getter de récupération de la description
		 * @return name de l'objet
		 */
		public function getName(): string
		{
			return $this->_name;
		}

		/**
		 * Setter de récupération de la description
		 * @return tilte de l'objet
		 */
		public function setName(string $strName)
		{
			$this->_name = $strName;
		}

		/**
		 * Getter de récupération du budget
		 * @return content de l'objet
		 */
		public function getContent(): string
		{
			return $this->_content;
		}

		/**
		 * Setter de récupération du budget
		 * @return content de l'objet
		 */
		public function setContent(string $strContent) {
			$this->_content = $strContent;
		}

		/**
		 * Getter de récupération de la date de publication
		 * @return publish_date de l'objet
		 */
		public function getDate(): string {
			return $this->_date;
		}

		/**
		 * Setter de récupération de la date de publication
		 * @return publish_date de l'objet
		 */
		public function setDate(string $strDate) {
			$this->_date = $strDate;
		}

		/**
		 * Getter de récupération de la date de publication sous le format français
		 * @return identifiant de l'objet
		 */
		public function getDateFr() {
			// Traitement de la date
			$objDate        = new DateTime($this->_date);
			return $objDate->format("d/m/Y");
		}
    }