<?php
	include_once("parent_entity.php");
	/**
	 * Classe entité de l'objet comment
	 * @author Gauthier
	 * @version 2024
	 */
	class CommentTopic extends Entity {
		// Propriétés
		protected string $_strPrefixe = "comt_";

		private int $_id;
		private string $_content;
		private string $_date;
		private string $_image;
		private string $_creator;
		private int $_creatorId;
		private int $_utripId;

		// Méthodes

		/**
		 * Getter de récupération de la valeur de l'id
		 * @return identifiant de l'objet
		 */
		public function getId(): int {
			return $this->_id;
		}

		/**
		 * Setter de récupération de la valeur de l'id
		 * @return identifiant de l'objet
		 */
		public function setId(int $intId) {
			$this->_id = $intId;
		}

		/**
		 * Getter de récupération du contenu
		 * @return contenu de l'objet
		 */
		public function getContent(): string {
			return $this->_content;
		}

		/**
		 * Setter de récupération du contenu
		 * @return contenu de l'objet
		 */
		public function setContent(string $strContent) {
			$this->_content = $strContent;
		}

		/**
		 * Getter de récupération de la date
		 * @return date de l'objet
		 */
		public function getDate(): string {
			return $this->_date;
		}

		/**
		 * Setter de récupération de la date
		 * @return date de l'objet
		 */
		public function setDate(string $strDate) {
			$this->_date = $strDate;
		}

		/**
		 * Getter de récupération de l'image
		 * @return image de l'objet
		 */
		public function getImage(): string {
			return $this->_image;
		}

		/**
		 * Setter de récupération de l'image'
		 * @return image de l'objet
		 */
		public function setImage(string $strImage) {
			$this->_image = $strImage;
		}

		/**
		 * Getter de récupération de la date en français
		 * @return date de l'objet
		 */
		public function getDateFr() {
			// Traitement de la date
			$objDate        = new DateTime($this->_date);
			return $objDate->format("d/m/Y");
		}

		/**
		 * Getter de récupération de la valeur de l'auteur
		 * @return auteur de l'objet
		 */
		public function getCreator(): string {
			return $this->_creator;
		}
		
		/**
		 * Setter de récupération de la valeur de l'auteur
		 * @return auteur de l'objet
		 */
		public function setCreator(string $strCreator) {
			$this->_creator = $strCreator;
		}

		/**
		 * Getter de récupération de la valeur de l'auteur
		 * @return auteur de l'objet
		 */
		public function getCreatorId(): int {
			return $this->_creatorId;
		}
		
		/**
		 * Setter de récupération de la valeur de l'auteur
		 * @return auteur de l'objet
		 */
		public function setCreatorId(int $intCreatorId) {
			$this->_creatorId = $intCreatorId;
		}

		/**
		 * Getter de récupération de la valeur de l'article
		 * @return article de l'objet
		 */
		public function getUtripId(): int {
			return $this->_utripId;
		}
		
		/**
		 * Setter de récupération de la valeur de l'auteur
		 * @return auteur de l'objet
		 */
		public function setUtripId(int $intUtripId) {
			$this->_utripId = $intUtripId;
		}


	}
