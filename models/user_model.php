<?php

	/***
	 * Récupérer les utilisateurs dans la BDD 
	 * @author Gauthier
	 */
	include_once("connect.php");

	class UserModel extends Model {

		/**
		 * Constructeur de la classe 
		 */
		public function __construct() {
			parent::__construct();
		}

		/**
		 * Méthode de récupération de tous les utilisateurs
		 * @return Tableau des utilisateurs
		 */
		public function findAll() {

			$strQuery 	= "SELECT user_id, user_firstname
							FROM users";
			return $this->_db->query($strQuery)->fetchAll();
		}

		/**
		 * Méthode de récupération d'un utilisateur
		 * @return Tableau de l'utilisateur
		 */
		public function get(int $id) {

			$strQuery 	= "SELECT user_id, user_name, user_firstname, user_email, user_password 

							FROM users
							WHERE user_id = " . $id;
			return $this->_db->query($strQuery)->fetch();
		}

		/**
		 * Méthode de récupération d'un utilisateur en fonction de son mail et son pwd
		 * @param string $strEmail Adresse mail de l'utilisateur
		 * @param string $strPwd Mot de passe de l'utilisateur
		 * @return 
		 */
		public function searchUser(string $strEmail, string $strPassword) {

			$strQuery 	= "SELECT user_id, user_firstname, user_name, user_email, user_password, user_role
							FROM users
							WHERE user_email = :mail;";

			$rqPrep	= $this->_db->prepare($strQuery);

			$rqPrep->bindValue(":mail", $strEmail, PDO::PARAM_STR);

			$rqPrep->execute();
			//return $rqPrep->fetch();
			$arrUser = $rqPrep->fetch();

			if(is_array($arrUser) && password_verify($strPassword, $arrUser['user_password'])){
				unset($arrUser['user_password']);
				return $arrUser;
			}
			
			return false;
		}
		
		/**
		* Méthode qui vérifie la présence du mail dans la BDD
		* @param string $strEmail Email à chercher dans la table user
		* @return bool L'adresse existe ou non dans la table
		*/
		public function verifMail(string $strMail):bool {

			$strQuery 	= "SELECT user_email
							FROM users
							WHERE user_email = :mail;";
			
			$rqPrep	= $this->_db->prepare($strQuery);			
			
			$rqPrep->bindValue(":mail", $strMail, PDO::PARAM_STR);
			
			$rqPrep->execute();
			return is_array($rqPrep->fetch());
		}
		
		/**
		* Méthode d'insertion d'un utilisateur en bdd
		* param object $objUser Objet utilisateur
		*/
		public function insert(object $objUser) {

			$strQuery   = "INSERT INTO users (user_name, user_firstname, user_email, user_password, user_phone, user_regisdate, user_pp, user_ban, user_role_id)
						VALUES (:name, :firstname, :mail, :pwd, '', NOW(), 'profil_pic_default.png', 0, 3);";

			$rqPrep = $this->_db->prepare($strQuery);
			$rqPrep->bindValue(":name", $objUser->getName(), PDO::PARAM_STR);
			$rqPrep->bindValue(":firstname", $objUser->getFirstname(), PDO::PARAM_STR);
			$rqPrep->bindValue(":mail", $objUser->getEmail(), PDO::PARAM_STR);
			$rqPrep->bindValue(":pwd", $objUser->getPwdHash(), PDO::PARAM_STR);

			return $rqPrep->execute();
		}

		/**
		* Méthode de modification d'un utilisateur en bdd
		* param object $objUser Objet utilisateur
		*/
		public function update(object $objUser) {

			$strQuery 	= "UPDATE users 
							SET user_name = :name, 
								user_firstname = :firstname, 
								user_email = :mail";
			if ($objUser->getPassword() != ''){
				$strQuery 	.= ", user_password = :pwd";
			}
			$strQuery 	.= " WHERE user_id = :id	;";
			$rqPrep	= $this->_db->prepare($strQuery);
			
			$rqPrep->bindValue(":name", $objUser->getName(), PDO::PARAM_STR);
			$rqPrep->bindValue(":firstname", $objUser->getFirstname(), PDO::PARAM_STR);
			$rqPrep->bindValue(":mail", $objUser->getEmail(), PDO::PARAM_STR);
			$rqPrep->bindValue(":id", $objUser->getId(), PDO::PARAM_INT);
			if ($objUser->getPassword() != ''){
				$rqPrep->bindValue(":pwd", $objUser->getPwdHash(), PDO::PARAM_STR);
			}
			return $rqPrep->execute();
		}
		
		/**
		* Méthode qui récupère l'identifiant d'un utilisateur en fonction de son mail
		* @param string $strEmail Email à chercher dans la table user
		* @return int Identifiant de l'utilisateur
		*/
		public function getByMail(string $strEmail):int|false{
			$strQuery 	= "SELECT user_id
							FROM users
							WHERE user_mail = :mail;";

			$rqPrep	= $this->_db->prepare($strQuery);			

			$rqPrep->bindValue(":mail", $strEmail, PDO::PARAM_STR);

			$rqPrep->execute();
			$arrUser	= $rqPrep->fetch();
			if (is_array($arrUser)){
				return $arrUser['user_id'];
			}		

			return false;
		}

		public function updateReco(string $strCode, int $intId):bool{
			$strQuery 	= "UPDATE users 
							SET user_recocode = '".$strCode."',
								user_recodate = NOW(),
								user_recoexp = DATE_ADD(NOW(), INTERVAL 15 MINUTE)
							WHERE user_id = ".$intId.";";
			return $this->_db->exec($strQuery);				
		}

	}
