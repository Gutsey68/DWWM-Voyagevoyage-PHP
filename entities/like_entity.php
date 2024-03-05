<?php

	include_once("parent_entity.php");

	/**
	 * Classe entité représentant un "like" ou une appréciation.
	 * Cette classe hérite de Entity et gère les données relatives aux appréciations données par les utilisateurs.
	 *
	 * @author Gauthier
	 * @version 2024
	 */
	class Like extends Entity {

		protected string $_strPrefixe = "like_";

		private int $_id;
		private string $_date;
		private string $_creator;
		private int $_creatorId;
		private int $_utripId;

		/**
		 * Retourne l'identifiant unique du like.
		 * @return int L'identifiant du like.
		 */
		public function getId(): int {
			return $this->_id;
		}

		/**
		 * Définit l'identifiant unique du like.
		 * @param int $intId L'identifiant du like.
		 */
		public function setId(int $intId) {
			$this->_id = $intId;
		}

		/**
		 * Retourne la date à laquelle le like a été donné.
		 * @return string La date du like.
		 */
		public function getDate(): string {
			return $this->_date;
		}

		/**
		 * Définit la date à laquelle le like a été donné.
		 * @param string $strDate La date du like.
		 */
		public function setDate(string $strDate) {
			$this->_date = $strDate;
		}

		/**
		 * Retourne la date du like au format français.
		 * @return string La date du like au format français.
		 */
		public function getDateFr() {
			// Traitement de la date
			$objDate        = new DateTime($this->_date);
			return $objDate->format("d/m/Y");
		}

		/**
		 * Retourne le nom de l'auteur du like.
		 * @return string Le nom de l'auteur.
		 */
		public function getCreator(): string {
			return $this->_creator;
		}
		
		/**
		 * Définit le nom de l'auteur du like.
		 * @param string $strCreator Le nom de l'auteur.
		 */
		public function setCreator(string $strCreator) {
			$this->_creator = $strCreator;
		}

		/**
		 * Retourne l'identifiant de l'auteur du like.
		 * @return int L'identifiant de l'auteur.
		 */
		public function getCreatorId(): int {
			return $this->_creatorId;
		}
		
		/**
		 * Définit l'identifiant de l'auteur du like.
		 * @param int $intCreatorId L'identifiant de l'auteur.
		 */
		public function setCreatorId(int $intCreatorId) {
			$this->_creatorId = $intCreatorId;
		}

		/**
		 * Retourne l'identifiant de l'article auquel le like est associé.
		 * @return int L'identifiant de l'article.
		 */
		public function getUtripId(): int {
			return $this->_utripId;
		}
		
		/**
		 * Définit l'identifiant de l'article auquel le like est associé.
		 * @param int $intUtripId L'identifiant de l'article.
		 */
		public function setUtripId(int $intUtripId) {
			$this->_utripId = $intUtripId;
		}
	}
