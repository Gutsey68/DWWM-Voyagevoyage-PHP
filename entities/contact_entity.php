<?php

	include_once("parent_entity.php");
	
	/**
	 * Classe entité représentant un contact.
	 * Cette classe hérite de Entity et permet de gérer les données liées à un contact.
	 *
	 * @author Gauthier
	 * @version 2024
	 */
	class Contact extends Entity {

		protected string $_strPrefixe = "contact_";

		private int $_id;
		private string $_mail;
		private string $_title;
		private string $_name;
		private string $_content;
		private string $_date;

		/**
		 * Retourne l'identifiant unique du contact.
		 * @return int L'identifiant du contact.
		 */
		public function getId(): int
		{
			return $this->_id;
		}

		/**
		 * Définit l'identifiant unique du contact.
		 * @param int $intId L'identifiant du contact.
		 */
		public function setId(int $intId)
		{
			$this->_id = $intId;
		}

		/**
		 * Retourne l'adresse e-mail du contact.
		 * @return string L'adresse e-mail du contact.
		 */
		public function getMail(): string
		{
			return $this->_mail;
		}

		/**
		 * Définit l'adresse e-mail du contact.
		 * @param string $strMail L'adresse e-mail.
		 */
		public function setMail(string $strMail)
		{
			$this->_mail = $strMail;
		}

		/**
		 * Retourne le titre associé au contact.
		 * @return string Le titre du contact.
		 */
		public function getTitle(): string
		{
			return $this->_title;
		}

		/**
		 * Définit le titre du contact.
		 * @param string $strTitle Le titre.
		 */
		public function setTitle(string $strTitle)
		{
			$this->_title = $strTitle;
		}

		/**
		 * Retourne le nom du contact.
		 * @return string Le nom du contact.
		 */
		public function getName(): string
		{
			return $this->_name;
		}

		/**
		 * Définit le nom du contact.
		 * @param string $strName Le nom.
		 */
		public function setName(string $strName)
		{
			$this->_name = $strName;
		}

		/**
		 * Retourne le contenu du message du contact.
		 * @return string Le contenu du message.
		 */
		public function getContent(): string
		{
			return $this->_content;
		}

		/**
		 * Définit le contenu du message du contact.
		 * @param string $strContent Le contenu du message.
		 */
		public function setContent(string $strContent) {
			$this->_content = $strContent;
		}

		/**
		 * Retourne la date de soumission du message.
		 * @return string La date de soumission.
		 */
		public function getDate(): string {
			return $this->_date;
		}

		/**
		 * Définit la date de soumission du message.
		 * @param string $strDate La date de soumission.
		 */
		public function setDate(string $strDate) {
			$this->_date = $strDate;
		}

		/**
		 * Retourne la date de soumission du message formatée pour l'affichage.
		 * @return string La date de soumission au format d/m/Y.
		 */
		public function getDateFr() {
			// Traitement de la date
			$objDate        = new DateTime($this->_date);
			return $objDate->format("d/m/Y");
		}
    }