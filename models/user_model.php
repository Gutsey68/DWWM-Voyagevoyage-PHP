<?php

/***
 * Récupérer les utilisateurs dans la BDD 
 * @author Gauthier
 */
include_once("connect.php");

class UserModel extends Model
{

	/**
	 * Constructeur de la classe 
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Méthode de récupération de tous les utilisateurs
	 * @return Tableau des utilisateurs
	 */
	public function findAll()
	{
		$strQuery 	= "SELECT user_id, user_firstname 
							FROM users";
		return $this->_db->query($strQuery)->fetchAll();
	}

	/**
	 * Méthode de récupération d'un utilisateur
	 * @return Tableau de l'utilisateur
	 */
	public function get(int $id)
	{
		$strQuery 	= "SELECT user_firstname 
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
	public function searchUser(string $strEmail, string $strPwd)
	{
		$strQuery 	= "SELECT user_id, user_firstname, user_name
							FROM users
							WHERE user_email = :mail
								AND user_password = :pwd ;";

		$rqPrep	= $this->_db->prepare($strQuery);

		$rqPrep->bindValue(":mail", $strEmail, PDO::PARAM_STR);
		$rqPrep->bindValue(":pwd", $strPwd, PDO::PARAM_STR);

		$rqPrep->execute();
		return $rqPrep->fetch();
	}
	/**
	 * Méthode qui vérifie la présence du mail dans la BDD
	 * @param string $strEmail Email à chercher dans la table user
	 * @return bool L'adresse existe ou non dans la table
	 */
	public function verifMail(string $strEmail): bool
	{
		$strQuery   = "SELECT user_email
						FROM users
						WHERE user_email = :mail;";

		$rqPrep = $this->_db->prepare($strQuery);

		$rqPrep->bindValue(":mail", $strEmail, PDO::PARAM_STR);

		$rqPrep->execute();
		return is_array($rqPrep->fetch());
	}

	/**
	 * Méthode d'insertion d'un utilisateur en bdd
	 * param object $objUser Objet utilisateur
	 */
	public function insert(object $objUser)
	{
		$strQuery   = "INSERT INTO users (user_name, user_firstname, user_email, user_password, user_phone, user_regisdate, user_pp, user_ban, user_role_id)
						VALUES (:name, :firstname, :mail, :pwd, '', NOW(), 'profil_pic_default.png', 0, 3);";
		$rqPrep = $this->_db->prepare($strQuery);
		$rqPrep->bindValue(":name", $objUser->getName(), PDO::PARAM_STR);
		$rqPrep->bindValue(":firstname", $objUser->getFirstname(), PDO::PARAM_STR);
		$rqPrep->bindValue(":mail", $objUser->getEmail(), PDO::PARAM_STR);
		$rqPrep->bindValue(":pwd", $objUser->getPwdHash(), PDO::PARAM_STR);
		return $rqPrep->execute();
	}
}
