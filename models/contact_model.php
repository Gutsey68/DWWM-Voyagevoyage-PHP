<?php

	/**
	 * Classe permettant la gestion des contacts en base de données.
	 * Fournit les fonctionnalités pour insérer de nouveaux contacts à partir des données soumises via un formulaire.
	 * 
	 * @author Groupe1
	 */
	include_once("connect.php");

	class ContactModel extends Model {

		/**
		 * Constructeur de la classe ContactModel.
		 * Initialise une nouvelle instance de la classe en établissant une connexion à la base de données via le constructeur de la classe parente.
		 */
		public function __construct() {
			parent::__construct();
		}

		/**
		 * Insère un nouveau contact dans la base de données.
		 * Utilise les informations fournies par un objet contact pour créer un nouveau record dans la table des contacts.
		 * 
		 * @param object $objContact Objet contact contenant les données à insérer.
		 * @return bool Retourne true si l'insertion a réussi, false en cas d'échec.
		 */
		public function insert(object $objContact) {
			$strQuery	= "	INSERT INTO contact (contact_mail, contact_name, contact_title, contact_content , contact_date, contact_user_id)
								VALUES (:mail, :name, :title, :content, NOW(), 22 );
								";

			$rqPrep	= $this->_db->prepare($strQuery);
			$rqPrep->bindValue(":mail", $objContact->getMail(), PDO::PARAM_STR);
			$rqPrep->bindValue(":name", $objContact->getName(), PDO::PARAM_STR);
			$rqPrep->bindValue(":title", $objContact->getTitle(), PDO::PARAM_STR);
			$rqPrep->bindValue(":content", $objContact->getContent(), PDO::PARAM_STR);

			return $rqPrep->execute();
		}
	}
