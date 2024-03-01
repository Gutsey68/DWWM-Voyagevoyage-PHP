<?php
	include_once("parent_entity.php");
	/**
	 * Classe entité de l'objet forum
	 * @author Gauthier
	 * @version 2024
	 */
	class Forum extends Entity {
		// Propriétés
		protected string $_strPrefixe = "topic_";

		private int $_id;
		private string $_title;
		private string $_content;
		private string $_date;
		private string $_code;
		private string $_creator;
		private int $_valid;
		private string $_comment;

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
		 * Getter de récupération du titre
		 * @return titre de l'objet
		 */
		public function getTitle(): string {
			return $this->_title;
		}

		/**
		 * Setter de récupération du titre
		 * @return titre de l'objet
		 */
		public function setTitle(string $strTitle) {
			$this->_title = $strTitle;
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
		 * Getter de récupération du résumé du contenu
		 * @return resume de l'objet
		 */
		public function getContentSummary(int $max) {
			$strContent        = $this->_content;
			if (strlen($strContent) > $max) {
				$strContent    = substr($strContent, 0, $max)."...";
			}
			return $strContent;
		}

		/**
		 * Getter de récupération du code
		 * @return code de l'objet
		 */
		public function getCode(): string {
			return $this->_code;
		}

		/**
		 * Setter de récupération du code
		 * @return code de l'objet
		 */
		public function setCode(string $strCode) {
			$this->_code = $strCode;
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
		* Getter de récupération de l'état de validation
		* @return int état de validation
		*/
		public function getValid():int{ 
			return $this->_valid;
		}
		/**
		* Setter de modification de l'état de validation
		* @param int état de validation
		*/
		public function setValid(int $intValid){ 
			$this->_valid = $intValid;
		}		
		
		/**
		* Getter de récupération du commentaire de validation
		* @return string commentaire de validation
		*/
		public function getComment():string{ 
			return $this->_comment;
		}
		/**
		* Setter de modification du commentaire de validation
		* @param string commentaire de validation
		*/
		public function setComment(string $strComment){ 
			$this->_comment = trim($strComment); // Enlève les espaces avant et après
			$this->_comment = filter_var($this->_comment, FILTER_SANITIZE_FULL_SPECIAL_CHARS); // nettoyage
		}		
	}
