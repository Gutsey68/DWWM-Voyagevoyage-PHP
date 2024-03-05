<?php

	include_once("parent_entity.php");

	/**
	 * Classe entité représentant un forum.
	 * Cette classe hérite de Entity et permet de gérer les données liées à un sujet de forum.
	 *
	 * @author Gauthier
	 * @version 2024
	 */
	class Forum extends Entity {

		protected string $_strPrefixe = "topic_";

		private int $_id;
		private string $_title;
		private string $_content;
		private string $_date;
		private string $_code;
		private string $_creator;
		private int $_creatorId;
		private int $_valid;
		private string $_comment;

		/**
		 * Retourne l'identifiant unique du sujet du forum.
		 * @return int L'identifiant du sujet.
		 */
		public function getId(): int {
			return $this->_id;
		}

		/**
		 * Définit l'identifiant unique du sujet du forum.
		 * @param int $intId L'identifiant du sujet.
		 */
		public function setId(int $intId) {
			$this->_id = $intId;
		}

		/**
		 * Retourne le titre du sujet du forum.
		 * @return string Le titre du sujet.
		 */
		public function getTitle(): string {
			return $this->_title;
		}

		/**
		 * Définit le titre du sujet du forum.
		 * @param string $strTitle Le titre du sujet.
		 */
		public function setTitle(string $strTitle) {
			$this->_title = $strTitle;
		}

		/**
		 * Retourne le contenu du sujet du forum.
		 * @return string Le contenu du sujet.
		 */
		public function getContent(): string {
			return $this->_content;
		}

		/**
		 * Définit le contenu du sujet du forum.
		 * @param string $strContent Le contenu du sujet.
		 */
		public function setContent(string $strContent) {
			$this->_content = $strContent;
		}

		/**
		 * Retourne un résumé du contenu du sujet du forum.
		 * @param int $max La longueur maximale du résumé.
		 * @return string Le résumé du contenu.
		 */
		public function getContentSummary(int $max) {
			$strContent        = $this->_content;
			if (strlen($strContent) > $max) {
				$strContent    = substr($strContent, 0, $max)."...";
			}
			return $strContent;
		}

		/**
		 * Retourne le code unique associé au sujet du forum.
		 * @return string Le code du sujet.
		 */
		public function getCode(): string {
			return $this->_code;
		}

		/**
		 * Définit le code unique associé au sujet du forum.
		 * @param string $strCode Le code du sujet.
		 */
		public function setCode(string $strCode) {
			$this->_code = $strCode;
		}

		/**
		 * Retourne la date de création du sujet du forum.
		 * @return string La date de création.
		 */
		public function getDate(): string {
			return $this->_date;
		}

		/**
		 * Définit la date de création du sujet du forum.
		 * @param string $strDate La date de création.
		 */
		public function setDate(string $strDate) {
			$this->_date = $strDate;
		}

		/**
		 * Retourne la date de création du sujet du forum au format français.
		 * @return string La date de création au format français.
		 */
		public function getDateFr() {
			// Traitement de la date
			$objDate        = new DateTime($this->_date);
			return $objDate->format("d/m/Y");
		}

		/**
		 * Retourne le nom de l'auteur du sujet du forum.
		 * @return string Le nom de l'auteur.
		 */
		public function getCreator(): string {
			return $this->_creator;
		}
		
		/**
		 * Définit le nom de l'auteur du sujet du forum.
		 * @param string $strCreator Le nom de l'auteur.
		 */
		public function setCreator(string $strCreator) {
			$this->_creator = $strCreator;
		}

		/**
		 * Retourne l'identifiant de l'auteur du sujet du forum.
		 * @return int L'identifiant de l'auteur.
		 */
		public function getCreatorId(): int {
			return $this->_creatorId;
		}
		
		/**
		 * Définit l'identifiant de l'auteur du sujet du forum.
		 * @param int $intCreatorId L'identifiant de l'auteur.
		 */
		public function setCreatorId(int $intCreatorId) {
			$this->_creatorId = $intCreatorId;
		}

		
		/**
		* Retourne l'état de validation du sujet du forum.
		* @return int L'état de validation.
		*/
		public function getValid():int{ 
			return $this->_valid;
		}

		/**
		* Définit l'état de validation du sujet du forum.
		* @param int $intValid L'état de validation.
		*/
		public function setValid(int $intValid){ 
			$this->_valid = $intValid;
		}		
		
		/**
		* Retourne le commentaire associé à la validation du sujet du forum.
		* @return string Le commentaire de validation.
		*/
		public function getComment():string{ 
			return $this->_comment;
		}

		/**
		* Définit le commentaire associé à la validation du sujet du forum.
		* @param string $strComment Le commentaire de validation.
		*/
		public function setComment(string $strComment){ 
			$this->_comment = trim($strComment); // Enlève les espaces avant et après
			$this->_comment = filter_var($this->_comment, FILTER_SANITIZE_FULL_SPECIAL_CHARS); // nettoyage
		}		
	}
