<?php

	include_once("parent_entity.php");

	/**
	 * Classe entité représentant un commentaire dans l'application.
	 * Elle hérite de la classe Entity pour une intégration facile avec le système de base de données.
	 * Permet la gestion des attributs d'un commentaire comme son contenu, date, image associée, et le créateur.
	 * 
	 * @author Gauthier
	 * @version 2024
	 */
	class Comment extends Entity {

		protected string $_strPrefixe = "com_";

		private int $_id;
		private string $_content;
		private string $_date;
		private string $_image;
		private string $_creator;
		private int $_creatorId;
		private int $_utripId;


		/**
		 * Récupère l'identifiant du commentaire.
		 * @return int Identifiant du commentaire.
		 */
		public function getId(): int {
			return $this->_id;
		}

		/**
		 * Définit l'identifiant du commentaire.
		 * @param int $intId Nouvel identifiant pour le commentaire.
		 */
		public function setId(int $intId) {
			$this->_id = $intId;
		}

		/**
		 * Récupère le contenu du commentaire.
		 * @return string Contenu du commentaire.
		 */
		public function getContent(): string {
			return $this->_content;
		}

		/**
		 * Définit le contenu du commentaire.
		 * @param string $strContent Nouveau contenu pour le commentaire.
		 */
		public function setContent(string $strContent) {
			$this->_content = $strContent;
		}

  		/**
		 * Récupère la date de création du commentaire.
		 * @return string Date de création du commentaire.
		 */
		public function getDate(): string {
			return $this->_date;
		}

		/**
		 * Définit la date de création du commentaire.
		 * @param string $strDate Nouvelle date pour le commentaire.
		 */
		public function setDate(string $strDate) {
			$this->_date = $strDate;
		}

		/**
		 * Récupère l'image associée au commentaire.
		 * @return string Chemin vers l'image du commentaire.
		 */
		public function getImage(): string {
			return $this->_image;
		}

		/**
		 * Définit l'image associée au commentaire.
		 * @param string $strImage Nouveau chemin vers l'image pour le commentaire.
		 */
		public function setImage(string $strImage) {
			$this->_image = $strImage;
		}

		/**
		 * Récupère la date de création du commentaire au format français (jj/mm/aaaa).
		 * @return string Date au format français.
		 */
		public function getDateFr() {
			// Traitement de la date
			$objDate        = new DateTime($this->_date);
			return $objDate->format("d/m/Y");
		}

		/**
		 * Récupère le nom de l'auteur du commentaire.
		 * @return string Nom de l'auteur du commentaire.
		 */
		public function getCreator(): string {
			return $this->_creator;
		}
		
		/**
		 * Définit le nom de l'auteur du commentaire.
		 * @param string $strCreator Nouveau nom pour l'auteur du commentaire.
		 */
		public function setCreator(string $strCreator) {
			$this->_creator = $strCreator;
		}

		/**
		 * Récupère l'identifiant de l'auteur du commentaire.
		 * @return int Identifiant de l'auteur.
		 */
		public function getCreatorId(): int {
			return $this->_creatorId;
		}
		
		/**
		 * Définit l'identifiant de l'auteur du commentaire.
		 * @param int $intCreatorId Nouvel identifiant pour l'auteur du commentaire.
		 */
		public function setCreatorId(int $intCreatorId) {
			$this->_creatorId = $intCreatorId;
		}

		/**
		 * Récupère l'identifiant de l'article associé au commentaire.
		 * @return int Identifiant de l'article.
		 */
		public function getUtripId(): int {
			return $this->_utripId;
		}
		
		/**
		 * Définit l'identifiant de l'article associé au commentaire.
		 * @param int $intUtripId Nouvel identifiant pour l'article.
		 */
		public function setUtripId(int $intUtripId) {
			$this->_utripId = $intUtripId;
		}
	}
