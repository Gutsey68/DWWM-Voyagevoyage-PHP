<?php

	include_once("parent_entity.php");

	/**
	 * Classe entité représentant un commentaire sur un topic dans le forum.
	 * Cette classe hérite de Entity et permet de gérer les données liées à un commentaire.
	 *
	 * @author Gauthier
	 * @version 2024
	 */
	class CommentTopic extends Entity {
		
		protected string $_strPrefixe = "comt_";

		private int $_id;
		private string $_content;
		private string $_date;
		private string $_image;
		private string $_creator;
		private int $_creatorId;
		private int $_utripId;

		/**
		 * Retourne l'identifiant unique du commentaire.
		 * @return int L'identifiant du commentaire.
		 */
		public function getId(): int {
			return $this->_id;
		}

		/**
		 * Définit l'identifiant unique du commentaire.
		 * @param int $intId L'identifiant du commentaire.
		 */
		public function setId(int $intId) {
			$this->_id = $intId;
		}

		/**
		 * Retourne le contenu du commentaire.
		 * @return string Le contenu du commentaire.
		 */
		public function getContent(): string {
			return $this->_content;
		}

		/**
		 * Définit le contenu du commentaire.
		 * @param string $strContent Le contenu du commentaire.
		 */
		public function setContent(string $strContent) {
			$this->_content = $strContent;
		}

		/**
		 * Retourne la date de création du commentaire.
		 * @return string La date de création du commentaire.
		 */
		public function getDate(): string {
			return $this->_date;
		}

		/**
		 * Définit la date de création du commentaire.
		 * @param string $strDate La date de création du commentaire.
		 */
		public function setDate(string $strDate) {
			$this->_date = $strDate;
		}

		/**
		 * Retourne l'image associée au commentaire, si applicable.
		 * @return string Le chemin de l'image associée au commentaire.
		 */
		public function getImage(): string {
			return $this->_image;
		}

		/**
		 * Définit l'image associée au commentaire.
		 * @param string $strImage Le chemin de l'image.
		 */
		public function setImage(string $strImage) {
			$this->_image = $strImage;
		}

		/**
		 * Retourne la date de création du commentaire formatée pour l'affichage.
		 * @return string La date de création du commentaire au format d/m/Y.
		 */
		public function getDateFr() {
			// Traitement de la date
			$objDate        = new DateTime($this->_date);
			return $objDate->format("d/m/Y");
		}

		/**
		 * Retourne le nom de l'auteur du commentaire.
		 * @return string Le nom de l'auteur du commentaire.
		 */
		public function getCreator(): string {
			return $this->_creator;
		}
		
		/**
		 * Définit le nom de l'auteur du commentaire.
		 * @param string $strCreator Le nom de l'auteur.
		 */
		public function setCreator(string $strCreator) {
			$this->_creator = $strCreator;
		}

		/**
		 * Retourne l'identifiant de l'auteur du commentaire.
		 * @return int L'identifiant de l'auteur.
		 */
		public function getCreatorId(): int {
			return $this->_creatorId;
		}
		
		/**
		 * Définit l'identifiant de l'auteur du commentaire.
		 * @param int $intCreatorId L'identifiant de l'auteur.
		 */
		public function setCreatorId(int $intCreatorId) {
			$this->_creatorId = $intCreatorId;
		}

		/**
		 * Retourne l'identifiant de l'article ou du topic associé au commentaire.
		 * @return int L'identifiant de l'article ou du topic.
		 */
		public function getUtripId(): int {
			return $this->_utripId;
		}
		
		/**
		 * Définit l'identifiant de l'article ou du topic associé au commentaire.
		 * @param int $intUtripId L'identifiant de l'article ou du topic.
		 */
		public function setUtripId(int $intUtripId) {
			$this->_utripId = $intUtripId;
		}
	}
