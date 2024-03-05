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
         * @param int $id Identifiant de l'utilisateur
         * @return array Tableau de l'utilisateur
         */
		public function get(int $id) {

			$strQuery 	= "SELECT user_id, user_name, user_firstname, user_email, user_password ,user_pp , user_pseudo , user_regisdate , user_bio, user_role
							FROM users
							WHERE user_id = " . $id;

			return $this->_db->query($strQuery)->fetch();
		}

        /**
         * Méthode de récupération d'un utilisateur en fonction de son mail et son mot de passe
         * @param string $strEmail Email de l'utilisateur
         * @param string $strPassword Mot de passe de l'utilisateur
         * @return array|false Tableau contenant les informations de l'utilisateur ou false si non trouvé
         */
		public function searchUser(string $strEmail, string $strPassword) {

			$strQuery 	= "SELECT user_id, user_firstname, user_name, user_email, user_password, user_role, user_regisdate , user_ban
							FROM users
							WHERE user_email = :mail;";

			$rqPrep	= $this->_db->prepare($strQuery);

			$rqPrep->bindValue(":mail", $strEmail, PDO::PARAM_STR);

			$rqPrep->execute();
			
			$arrUser = $rqPrep->fetch();

			if(is_array($arrUser) && password_verify($strPassword, $arrUser['user_password'])){
				unset($arrUser['user_password']);
				return $arrUser;
			}
			
			return false;
		}
		
        /**
         * Méthode qui vérifie la présence de l'email dans la BDD
         * @param string $strMail Email à vérifier
         * @return bool Vrai si l'email existe déjà, faux sinon
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
         * Méthode d'insertion d'un utilisateur en BDD
         * @param object $objUser Objet représentant l'utilisateur à insérer
         * @return bool Vrai si l'insertion a réussi, faux sinon
         */
		public function insert(object $objUser) {

			$strQuery   = "INSERT INTO users (user_name, user_firstname, user_email, user_password, user_phone, user_regisdate, user_pp, user_ban, user_role_id , user_bio, user_pseudo)
						VALUES (:name, :firstname, :mail, :pwd, '', NOW(), 'profil_pic_default.webp', 0, 3, '' , :pseudo)";

			$rqPrep = $this->_db->prepare($strQuery);

			$rqPrep->bindValue(":name", $objUser->getName(), PDO::PARAM_STR);
			$rqPrep->bindValue(":firstname", $objUser->getFirstname(), PDO::PARAM_STR);
			$rqPrep->bindValue(":mail", $objUser->getEmail(), PDO::PARAM_STR);
			$rqPrep->bindValue(":pseudo", $objUser->getPseudo(), PDO::PARAM_STR);
			$rqPrep->bindValue(":pwd", $objUser->getPwdHash(), PDO::PARAM_STR);

			return $rqPrep->execute();
		}


        /**
         * Méthode de mise à jour d'un utilisateur en BDD
         * @param object $objUser Objet représentant l'utilisateur à mettre à jour
         * @return bool Vrai si la mise à jour a réussi, faux sinon
         */
		public function update(object $objUser) {

			$strQuery 	= "UPDATE users 
							SET user_name = :name, 
								user_firstname = :firstname, 
								user_email = :mail ,
								user_pseudo = :pseudo , 
								user_bio = :bio";

			if ($objUser->getPassword() != ''){
				$strQuery 	.= ", user_password = :pwd";
			}

			$strQuery 	.= " WHERE user_id = :id	;";
			$rqPrep	= $this->_db->prepare($strQuery);
			
			$rqPrep->bindValue(":name", $objUser->getName(), PDO::PARAM_STR);
			$rqPrep->bindValue(":firstname", $objUser->getFirstname(), PDO::PARAM_STR);
			$rqPrep->bindValue(":mail", $objUser->getEmail(), PDO::PARAM_STR);
			$rqPrep->bindValue(":pseudo", $objUser->getPseudo(), PDO::PARAM_STR);
			$rqPrep->bindValue(":bio", $objUser->getBio(), PDO::PARAM_STR);
			$rqPrep->bindValue(":id", $objUser->getId(), PDO::PARAM_INT);

			if ($objUser->getPassword() != ''){
				$rqPrep->bindValue(":pwd", $objUser->getPwdHash(), PDO::PARAM_STR);
			}

			return $rqPrep->execute();
		}

        /**
         * Méthode de mise à jour de la photo de profil d'un utilisateur
         * @param object $objUser Objet représentant l'utilisateur
         * @return bool Vrai si la mise à jour a réussi, faux sinon
         */
		public function updatePp(object $objUser) {

			$strQuery 	= "UPDATE users 
							SET user_pp = :pp";
			$strQuery 	.= " WHERE user_id = ". $_SESSION['user']['user_id'];

			$rqPrep	= $this->_db->prepare($strQuery);
			
			$rqPrep->bindValue(":pp", $objUser->getPp(), PDO::PARAM_STR);

			return $rqPrep->execute();
		}
		
        /**
         * Méthode qui récupère l'ID d'un utilisateur en fonction de son email
         * @param string $strEmail Email de l'utilisateur
         * @return int|false ID de l'utilisateur ou false si non trouvé
         */
		public function getByMail(string $strEmail):int|false{

			$strQuery 	= "SELECT user_id
							FROM users
							WHERE user_email = :mail;";

			$rqPrep	= $this->_db->prepare($strQuery);			

			$rqPrep->bindValue(":mail", $strEmail, PDO::PARAM_STR);

			$rqPrep->execute();

			$arrUser	= $rqPrep->fetch();

			if (is_array($arrUser)){
				return $arrUser['user_id'];
			}		

			return false;
		}

		/**
         * Méthode de mise à jour du code et de la date de récupération du mot de passe
         * @param string $strCode Code de récupération
         * @param int $intId ID de l'utilisateur
         * @return bool Vrai si la mise à jour a réussi, faux sinon
         */
		public function updateReco(string $strCode, int $intId):bool{

			$strQuery 	= "UPDATE users 
							SET user_recocode = '".$strCode."',
								user_recodate = NOW(),
								user_recoexp = DATE_ADD(NOW(), INTERVAL 15 MINUTE)
								WHERE user_id = ".$intId.";";

			return $this->_db->exec($strQuery);				
		}

		/**
         * Méthode de recherche d'un utilisateur par son code de récupération
         * @param string $strCode Code de récupération
         * @return array|false Informations de l'utilisateur ou false si non trouvé
         */
		public function searchByCode($strCode){

			$strQuery 	= "SELECT * 
							FROM users
							WHERE user_recocode = :code
							AND user_recoexp > NOW()";

			$rqPrep	= $this->_db->prepare($strQuery);

			$rqPrep->bindValue(":code", $strCode, PDO::PARAM_STR);

			$rqPrep->execute();

			return $rqPrep->fetch();
		}

		/**
         * Méthode de mise à jour du mot de passe d'un utilisateur
         * @param string $strPassword Nouveau mot de passe
         * @return bool Vrai si la mise à jour a réussi, faux sinon
         */
		public function updatePwd($strPassword){

			$strQuery 	= "UPDATE users
							SET user_password = :pwd
							WHERE user_id = ".$_SESSION['user_recovery'].";";

			$rqPrep	= $this->_db->prepare($strQuery);

			$rqPrep->bindValue(":pwd", password_hash($strPassword, PASSWORD_DEFAULT), PDO::PARAM_STR);

			return $rqPrep->execute();
		}
		
        /**
         * Méthode d'administration de la gestion des utilisateurs
         * @return array Liste des utilisateurs pour administration
         */
		public function findList(){

			$strQuery 	= "SELECT user_id , user_name , user_firstname , user_pseudo , user_email , user_password , user_phone , user_regisdate , user_pp , user_ban , user_role_id , user_role, user_modo
							FROM users";
							
			if (!in_array($_SESSION['user']['user_role'], array('admin', 'modo'))){
				$strQuery 	.= " WHERE utrip_user_id = ".$_SESSION['user']['user_id'];
			}
			$strQuery 	.= " ORDER BY user_regisdate DESC;";

			return $this->_db->query($strQuery)->fetchAll();			
		}
				
        /**
         * Méthode permettant de mettre à jour l'utilisateur avec les informations de modération
         * @param object $objUser Objet utilisateur
         * @return bool Vrai si la modération a réussi
		*/
		public function moderate($objUser){

			$strQuery	= "	UPDATE users
							SET user_ban = :ban, 
								user_comment = :comment, 
								user_modo = :modo
							WHERE user_id = :id";

			$rqPrep	= $this->_db->prepare($strQuery);

			$rqPrep->bindValue(":ban", $objUser->getBan(), PDO::PARAM_INT);
			$rqPrep->bindValue(":comment", $objUser->getComment(), PDO::PARAM_STR);
			$rqPrep->bindValue(":modo", $_SESSION['user']['user_id'], PDO::PARAM_INT);
			$rqPrep->bindValue(":id", $objUser->getId(), PDO::PARAM_INT);
			
			return $rqPrep->execute();			
		}

		/**
		 * Met à jour le rôle d'un utilisateur dans la base de données.
		 * @param int $id L'identifiant de l'utilisateur.
		 * @param string $role Le nouveau rôle de l'utilisateur.
		 * @return bool Renvoie true si la mise à jour a réussi, false sinon.
		 */
		public function updateRole($id, $role){

			$strQuery = "UPDATE users
						SET user_role = :role
						WHERE user_id = :id";

			$rqPrep = $this->_db->prepare($strQuery);

			$rqPrep->bindValue(":role", $role, PDO::PARAM_STR);
			$rqPrep->bindValue(":id", $id, PDO::PARAM_INT);

			return $rqPrep->execute();
		}

	}
