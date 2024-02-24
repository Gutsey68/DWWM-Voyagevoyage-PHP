<?php
	/***
	* Récupérer les mail de contact dans la BDD 
	* @author Groupe1
	*/
	include_once("connect.php");

	class ContactModel extends Model {

		/**
		* Constructeur de la classe 
		*/
		public function __construct() {
			parent::__construct();
		}

		/**
		* Méthode d'insertion d'un formulaire de contact en BDD
		* param object $objContact Objet contact
		*/
		public function insert(object $objContact) {
			$strQuery	= "	INSERT INTO contact (contact_mail, contact_name, contact_title, contact_content , contact_date, contact_user_id)
								VALUES (:mail, :name, :title, :content, NOW(), 2);
								";
			// On prépare la requête
			$rqPrep	= $this->_db->prepare($strQuery);
			$rqPrep->bindValue(":mail", $objContact->getMail(), PDO::PARAM_STR);
			$rqPrep->bindValue(":name", $objContact->getName(), PDO::PARAM_STR);
			$rqPrep->bindValue(":title", $objContact->getTitle(), PDO::PARAM_STR);
			$rqPrep->bindValue(":content", $objContact->getContent(), PDO::PARAM_STR);

			return $rqPrep->execute();
		}
	}
