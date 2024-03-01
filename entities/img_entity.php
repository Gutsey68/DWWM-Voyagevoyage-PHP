<?php
	include_once("parent_entity.php");
	/**
	 * Classe entité de l'objet img
	 * @author Gauthier
	 * @version 2024
	 */
	class Img extends Entity {
		// Propriétés
		protected string $_strPrefixe = "img_";

		private int $_id;
		private string $_link;
		private string $_utrip;

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
		 * Getter de récupération du lien
		 * @return lien de l'objet
		 */
		public function getLink(): string {
			return $this->_link;
		}

		/**
		 * Setter de récupération du lien
		 * @return lien de l'objet
		 */
		public function setLink(string $strLink) {
			$this->_link = $strLink;
		}

		/**
		 * Getter de récupération de l'article
		 * @return article de l'objet
		 */
		public function getUtrip(): string {
			return $this->_utrip;
		}

		/**
		 * Setter de récupération de l'article
		 * @return article de l'objet
		 */
		public function setUtrip(string $strUtrip) {
			$this->_utrip = $strUtrip;
		}
	}