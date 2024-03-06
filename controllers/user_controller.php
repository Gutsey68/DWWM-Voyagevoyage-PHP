<?php

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	// Inclusion des classes PHPMailer nécessaires pour l'envoi d'e-mails
	require 'libs/PHPMailer/Exception.php';
	require 'libs/PHPMailer/PHPMailer.php';
	require 'libs/PHPMailer/SMTP.php';

	/**
	 * Contrôleur pour la gestion des utilisateurs. Gère les actions telles que la création de compte, la connexion, la déconnexion, et l'édition de profil des utilisateurs.
	 */
	include_once("models/utrip_model.php");
	include_once("models/user_model.php");
	include_once("models/forum_model.php");
	include_once("entities/user_entity.php");
	include_once("entities/utrip_entity.php");
	include_once("entities/forum_entity.php");

	class UserCtrl extends Ctrl {

		const MAX_CONTENT = 220; 

		/**
		 * Crée un compte utilisateur.
		 * Valide les données du formulaire et, si elles sont correctes, insère le nouvel utilisateur dans la base de données.
		 */
		public function create_account() {

			// Tableau pour stocker les erreurs de validation
			$arrErrors = [];
			// Instanciation d'un nouvel objet User
			$objUser = new User(); 

			// Traitement du formulaire lorsqu'il est soumis
			if (count($_POST) > 0) {

				// Hydratation de l'objet User avec les données du formulaire
				$objUser->hydrate($_POST); 

				// Validation des informations
				$arrErrors = $this->_verifInfos($objUser); 
				$arrErrors = array_merge($arrErrors, $this->_verifPwd($objUser->getPassword()));

				// S'il n'y a pas d'erreurs, tente d'insérer l'utilisateur dans la base de données
				if (empty($arrErrors)) {
					$objUserModel = new UserModel();

					if ($objUserModel->insert($objUser)) {
						// Redirection vers la page de connexion en cas de succès
						Header("Location:" . parent::BASE_URL . "user/login"); 
					} else {
						$arrErrors[] = "Une erreur est survenue lors de la création de votre compte.";
					}
				}
			}

			// Préparation des données à envoyer à la vue
			$this->_arrData = [
				"strPage" => "create_account",
				"arrErrors" => $arrErrors,
				"objUser" => $objUser
			];

			$this->afficheTpl("create_account");
		}

	/**
	 * Gère la connexion des utilisateurs.
	 * Vérifie les informations de connexion contre la base de données et établit la session utilisateur en cas de succès.
	 * Affiche un message d'erreur en cas d'échec de la connexion.
	 */
	public function login() {

		$arrErrors = [];

		// Récupération des données envoyées par le formulaire
		$strEmail = $_POST['email'] ?? "";
		$strPassword = $_POST['password'] ?? "";

		if (count($_POST) > 0) {
			$objUserModel = new UserModel();
			$arrUser = $objUserModel->searchUser($strEmail, $strPassword);

			if ($arrUser === false) {

				// Si aucune correspondance n'est trouvée dans la base de données
				$arrErrors[] = "Erreur de connexion";
			} else {

				// Vérification si l'utilisateur est banni
				if ($arrUser['user_ban'] == 1) {

					// Si l'utilisateur est banni, détruire la session et afficher un message d'erreur
					session_destroy();

					// Nécessaire pour afficher le message d'erreur après la redirection
					session_start(); 
					$arrErrors[] = "Votre compte a été banni. Veuillez contacter l'administrateur.";
				} else {

					// Si l'utilisateur n'est pas banni, établir la session utilisateur et rediriger vers l'accueil
					$_SESSION['user'] = $arrUser;
					header("Location:" . parent::BASE_URL);
				}
			}
		}

		// Préparation des données pour l'affichage du formulaire de connexion
		$this->_arrData["strPage"] = "login";
		$this->_arrData["arrErrors"] = $arrErrors;
		$this->_arrData["email"] = $strEmail;

		$this->afficheTpl("login");
	}

	/**
	 * Gère la déconnexion de l'utilisateur.
	 * Détruit la session utilisateur et redirige vers la page d'accueil.
	 */
	public function logout() {

		// Destruction de la session active et redirection vers la page d'accueil
		session_destroy(); 
		header("Location:" . parent::BASE_URL);
	}

	/**
	 * Gère la modification du profil utilisateur.
	 * Nécessite que l'utilisateur soit connecté pour accéder à cette fonctionnalité.
	 */
	public function edit_profile() {

		// Est-ce que l'utilisateur est connecté ?
		if (!isset($_SESSION['user']['user_id']) || $_SESSION['user']['user_id'] == ''){
			header("Location:".parent::BASE_URL);
		}
		
		$arrErrors	= array();
		$objUser 	= new User;

		// Objet à partir de la BDD - à l'affichage du formulaire
		$objUserModel	= new UserModel;
		$arrUser		= $objUserModel->get($_SESSION['user']['user_id']);
		$objUser->hydrate($arrUser);
		
		// Récupère les valeurs actuelles pour vérification
		$strActualMail 	= $objUser->getEmail();			
		$strOldPwd 		= $objUser->getPassword();			
		
		// Objet à partir du formulaire - à l'envoi du formulaire
		if (count($_POST) > 0){
			// Mettre à jour l'objet
			$objUser->hydrate($_POST);

			// Vérifier 
			$boolVerifMail = ($strActualMail != $objUser->getEmail());
			$arrErrors = $this->_verifInfos($objUser, $boolVerifMail);

			if ($objUser->getPassword() != ''){
				if (password_verify($_POST['oldpwd'], $strOldPwd)){
					$arrErrors = array_merge($arrErrors, $this->_verifPwd($objUser->getPassword()));
				}else{
					$arrErrors['pwd']	= "Erreur de mdp";
				}
			}
			// Mise à jour en BDD

			if(count($arrErrors) == 0){
				$objUserModel->update($objUser);
				// $objUserModel->insertPp($objUser);

			// Attention si informations de session modifiées => modifier la session
			$_SESSION['user']['user_firstname'] = $objUser->getFirstname();
			$_SESSION['user']['user_name'] 		= $objUser->getName();
			
			$userId = $_SESSION['user']['user_id'];
				
			header("Location:".parent::BASE_URL."user/user?id=$userId");
				
			}else{
				$arrErrors[] = "L'insertion s'est mal passée";
			}

			
		}
		
		// Préparation des données pour l'affichage
		$this->_arrData["strPage"] = "edit_profile";
		$this->_arrData["arrErrors"] = $arrErrors;
		$this->_arrData["objUser"] = $objUser;

		$this->afficheTpl("edit_profile");
	}


	/**
	 * Méthode permettant à l'utilisateur de modifier sa photo de profil.
	 * Nécessite que l'utilisateur soit connecté pour accéder à cette fonctionnalité.
	 */
	public function edit_pp() {

		// Vérifie si l'utilisateur est connecté, sinon redirige vers la page de connexion.
		if (!isset($_SESSION['user']['user_id']) || $_SESSION['user']['user_id'] == '') {
			header("Location:" . parent::BASE_URL . "index.php");
			return;
		}

		// Initialise un tableau pour stocker les erreurs potentielles et crée une nouvelle instance de User.
		$arrErrors = array(); 
		$objUser = new User();

		// Récupère les informations actuelles de l'utilisateur depuis la base de données.
		$objUserModel = new UserModel();
		$arrUser = $objUserModel->get($_SESSION['user']['user_id']);

		// Hydrate l'objet User avec les données récupérées.
		$objUser->hydrate($arrUser); 

		// Traitement du fichier téléchargé pour la photo de profil.
		$strImgName = $_FILES['pp']['name'] ?? "";
		if ($strImgName != "") {

			// Vérifie si le type du fichier téléchargé est autorisé.
			if (in_array($_FILES['pp']['type'], $this->_arrMimesType)) {
				$strSource = $_FILES['pp']['tmp_name'];

				// Génère un nouveau nom pour le fichier et définit le chemin de destination du fichier.
				$strImgName = bin2hex(random_bytes(5)) . ".webp"; 
				$strDest = "uploads/" . $strImgName;

				// Préparation pour le redimensionnement de l'image.
				$percent = 0.5;
				list($width, $height) = getimagesize($strSource);
				$newwidth = intval($width * $percent);
				$newheight = intval($height * $percent);
				$dest = imagecreatetruecolor($newwidth, $newheight);

				// Selon le type de l'image, crée une image à partir du fichier téléchargé.
				switch ($_FILES['pp']['type']) {
					case "image/jpeg":
						$source = imagecreatefromjpeg($strSource);
						break;
					case "image/png":
						$source = imagecreatefrompng($strSource);
						break;
					default:
						$source = imagecreatefromwebp($strSource);
						break;
				}

				// Redimensionne l'image.
				imagecopyresized($dest, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

				// Enregistre l'image redimensionnée dans le fichier de destination.
				if (imagewebp($dest, $strDest, IMG_WEBP_LOSSLESS)) {
					// Met à jour l'objet User avec le nouveau nom de fichier.
					$objUser->setPp($strImgName); 
				} else {
					$arrErrors['img'] = "Erreur lors de l'enregistrement de l'image.";
				}
			} else {
				$arrErrors['img'] = "Le type d'image n'est pas autorisé.";
			}

			// Si aucune erreur, met à jour la photo de profil de l'utilisateur dans la base de données.
			if (count($arrErrors) == 0) {
				$objUserModel->updatePp($objUser);

				// Met à jour les informations de session de l'utilisateur.
				$_SESSION['user']['user_firstname'] = $objUser->getFirstname();
				$_SESSION['user']['user_name'] = $objUser->getName();

				// Redirige l'utilisateur vers son profil mis à jour.
				header("Location:" . parent::BASE_URL . "user/user?id=" . $_SESSION['user']['user_id']);
			}
		}

		// Prépare les données à afficher dans le formulaire de modification de la photo de profil.
		$this->_arrData["arrErrors"] = $arrErrors;
		$this->_arrData["objUser"] = $objUser;
		$this->_arrData["strPage"] = "edit_pp";

		$this->afficheTpl("edit_pp");
	}

	/**
	 * Vérifie les informations du profil utilisateur.
	 * Cette méthode vérifie le nom, le prénom, et l'email de l'utilisateur,
	 * en s'assurant qu'ils respectent les critères définis (présence, longueur, format).
	 * En option, elle vérifie également si l'email est déjà utilisé dans la base de données.
	 *
	 * @param object $objUser L'objet utilisateur dont les informations doivent être vérifiées.
	 * @param bool $boolVerifMail Indique si la vérification de l'unicité de l'email est requise.
	 * @return array Un tableau des erreurs détectées lors de la vérification.
	 */
	private function _verifInfos(object $objUser, $boolVerifMail = true) {

		$arrErrors = array();

		// Validation du nom
		if ($objUser->getName() == ""){
			$arrErrors['name'] = "Le nom est obligatoire";
		} elseif (strlen($objUser->getName()) < 2) {
			$arrErrors['name'] = "Le nom est trop court";
		}

		// Validation du prénom
		if ($objUser->getFirstname() == ""){
			$arrErrors['firstname'] = "Le prénom est obligatoire";
		}

		// Validation de l'email
		if ($objUser->getEmail() == ""){
			$arrErrors['mail'] = "Le mail est obligatoire";
		} elseif (!filter_var($objUser->getEmail(), FILTER_VALIDATE_EMAIL)) {
			$arrErrors['mail'] = "Le mail n'est pas correct";
		} elseif ($boolVerifMail) {

			// Vérification de l'unicité de l'email dans la base de données
			$objUserModel = new UserModel();
			$boolMailExists = $objUserModel->verifMail($objUser->getEmail());
			if ($boolMailExists === true) {
				$arrErrors['mail'] = "Le mail est déjà utilisé";
			}
		}
		return $arrErrors;
	}

	/**
	 * Vérifie la conformité du mot de passe selon des critères spécifiques.
	 * Le mot de passe doit contenir au minimum 16 caractères, dont au moins une majuscule, une minuscule,
	 * un chiffre, et un caractère spécial.
	 *
	 * @param string $strPassword Le mot de passe à vérifier.
	 * @return array Un tableau des erreurs détectées lors de la vérification.
	 */
	private function _verifPwd(string $strPassword) {

		$arrErrors = array();
		$password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{16,}$/";

		if ($strPassword == "") {
			$arrErrors['pwd'] = "Le mot de passe est obligatoire";
		} elseif (!preg_match($password_regex, $strPassword)) {
			$arrErrors['pwd'] = "Le mot de passe doit respecter les critères de complexité";
		} elseif ($strPassword != $_POST['passwd_confirm']) {
			$arrErrors['pwd'] = "Le mot de passe et sa confirmation doivent être identiques";
		}
		return $arrErrors;
	}

	/**
	 * Permet à l'utilisateur de demander la réinitialisation de son mot de passe.
	 * Si l'email fourni est associé à un compte existant, un code de réinitialisation est généré
	 * et un email est envoyé à l'utilisateur pour lui permettre de réinitialiser son mot de passe.
	 */
	public function forgetPwd() {

		$arrErrors = array();
		$arrSuccess = array();

		if (count($_POST) > 0) {
			if ($_POST['email'] == '') {
				$arrErrors['email'] = "Vous devez renseigner un mail";
			} else {
				$arrSuccess['email'] = "Si vous êtes inscrit, vous allez recevoir un mail de réinitialisation.";
				$objUserModel = new UserModel();
				$intUserId = $objUserModel->getByMail($_POST['email']);
				if ($intUserId !== false) {
					$strRecoCode = bin2hex(random_bytes(12));

					if ($objUserModel->updateReco($strRecoCode, $intUserId)) {
						$strDestMail = $_POST['email'];
						$strSubject = 'Récupération du mot de passe';
						
						// Préparation et envoi de l'email
						$this->_arrData["code"] = $strRecoCode;
						$strBody = $this->afficheTpl("mails/contact", false);
						$this->_sendMail($strDestMail, $strSubject, $strBody);
					}
				}
			}
		}

		// Préparation des données pour l'affichage
		$this->_arrData["strPage"] = "forgetPwd";
		$this->_arrData["strTitle"] = "Mot de passe oublié";
		$this->_arrData["strDesc"] = "Page permettant de demander la réinitialisation du mot de passe";
		$this->_arrData["arrErrors"] = $arrErrors;
		$this->_arrData["arrSuccess"] = $arrSuccess;
		$this->afficheTpl("forget");
	}

			

	/**
	 * Gère la demande de réinitialisation du mot de passe en vérifiant le code de réinitialisation.
	 * Si le code est valide, redirige l'utilisateur vers la page de création d'un nouveau mot de passe.
	 */
	public function resetPwd(){

		// Vérification de l'existence du code de réinitialisation dans l'URL.
		if(is_null($_GET['code'])){
			Header("Location:" . parent::BASE_URL . "error/show404");
		} else {
			$strCode = $_GET['code'];
		}

		// Recherche de l'utilisateur par le code de réinitialisation.
		$objUserModel = new UserModel();
		$arrUser = $objUserModel->searchByCode($strCode);

		$arrErrors = array();

		// Vérification de la validité du code.
		if ($arrUser === false) {
			$arrErrors['url'] = "La demande est expirée";
		} else {
			$_SESSION['user_recovery'] = $arrUser['user_id'];
			Header("Location:" . parent::BASE_URL . "user/doResetPwd");
		}

		// Préparation des données pour l'affichage.
		$this->_arrData["strPage"] = "resetPwd";
		$this->_arrData["strTitle"] = "Réinitialisation du mot de passe";
		$this->_arrData["strDesc"] = "Page permettant de réinitialiser son mot de passe";
		$this->_arrData["arrErrors"] = $arrErrors;
		$this->afficheTpl("reset");
	}

	/**
	 * Traite la soumission du nouveau mot de passe par l'utilisateur.
	 * Vérifie la conformité du nouveau mot de passe avant de le mettre à jour dans la base de données.
	 */
	public function doResetPwd(){

		$arrErrors = array();

		// Traitement du formulaire de réinitialisation.
		if (count($_POST) > 0) {
			// Validation du nouveau mot de passe.
			$arrErrors = $this->_verifPwd($_POST['pwd']); 
			if (count($arrErrors) == 0) {

				// Mise à jour du mot de passe dans la base de données.
				$objUserModel = new UserModel();
				if ($objUserModel->updatePwd($_POST['pwd'], $_SESSION['user_recovery'])) {
					session_destroy();
					Header("Location:" . parent::BASE_URL . "user/login");
				} else {
					$arrErrors['mdp'] = "Erreur de modification du mot de passe";
				}
			}
		}

		// Préparation des données pour l'affichage.
		$this->_arrData["strPage"] = "resetPwd";
		$this->_arrData["strTitle"] = "Réinitialisation du mot de passe";
		$this->_arrData["strDesc"] = "Page permettant de réinitialiser son mot de passe";
		$this->_arrData["arrErrors"] = $arrErrors;
		$this->afficheTpl("doreset");
	}

	/**
	 * Envoie un email à l'aide de la bibliothèque PHPMailer.
	 * 
	 * @param string $strDestMail Adresse email du destinataire.
	 * @param string $strSubject Sujet de l'email.
	 * @param string $strBody Corps de l'email.
	 * @return bool Retourne true si l'email est envoyé avec succès, sinon false.
	 */
	private function _sendMail($strDestMail, $strSubject, $strBody){

		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Mailer = "smtp";

		$mail->SMTPDebug  = 0;
		$mail->SMTPAuth   = TRUE;
		$mail->SMTPSecure = "tls";
		$mail->Port       = 587;
		$mail->Host       = "smtp.gmail.com";
		$mail->Username   = 'ceformation68@gmail.com';
		$mail->Password   = 'lkpy yuoc ftuu qksu';
		$mail->CharSet    = PHPMailer::CHARSET_UTF8;
		$mail->IsHTML(true);
		$mail->setFrom('mon_blog@gmail.com', 'Exercice BLOG');
		$mail->addAddress($strDestMail);
		$mail->Subject = $strSubject;
		$mail->Body = $strBody;

		return $mail->send();
	}

	/**
	 * Permet d'afficher et de gérer les utilisateurs du forum.
	 * Cette fonction est accessible uniquement aux utilisateurs connectés ayant des droits d'administration.
	 * Elle permet de visualiser la liste des utilisateurs et de modifier leur rôle au besoin.
	 */
	public function manage() {

		// Vérification de la connexion et des droits de l'utilisateur.
		if (!isset($_SESSION['user']['user_id']) || $_SESSION['user']['user_id'] == '') {
			header("Location:" . parent::BASE_URL . "error/show403");
			return;
		}

		// Récupération de la liste des utilisateurs depuis la base de données.
		$objUserModel = new UserModel();
		$arrUsers = $objUserModel->findList();

		$arrUsersToDisplay = array();
		// Hydratation des objets User avec les données récupérées et préparation pour l'affichage.
		foreach ($arrUsers as $arrDetailUser) {
			$objUser = new User();
			$objUser->hydrate($arrDetailUser);
			$arrUsersToDisplay[] = $objUser;
		}

		// Traitement de la modification du rôle d'un utilisateur si un formulaire a été soumis.
		if ((isset($_POST['userId']) && $_POST['userId'] !== '') || (isset($_POST['userRole']) && $_POST['userRole'] !== '')) {
			$userId = $_POST['userId'] ?? 0;
			$newRole = $_POST['userRole'] ?? 0;
			$objUserModel->updateRole($userId, $newRole);
			header("Location:" . parent::BASE_URL . "user/manage");
		}

		// Préparation des données pour l'affichage de la page de gestion des utilisateurs.
		$this->_arrData["arrUsersToDisplay"] = $arrUsersToDisplay;
		$this->_arrData["strPage"] = "manage";
		$this->_arrData["strTitle"] = "Gérer les utilisateurs";
		$this->_arrData["strDesc"] = "Page permettant d'afficher les utilisateurs pour les gérer";

		// Affichage du template de gestion des utilisateurs.
		$this->afficheTpl("user_manage");
	}

	/** 
	 * Affiche le détail d'un profil utilisateur spécifique.
	 * Cette méthode récupère et affiche les informations d'un utilisateur ainsi que ses contributions 
	 * sur le site, telles que les Utrips et les participations au forum.
	 */
	public function user() {

		$arrErrors = array();
		
		// Vérification que l'ID fourni est numérique, sinon redirection vers une erreur 404.
		if (is_numeric($_GET['id'])) {
			$intUserId = $_GET['id'] ?? 0;
		} else {
			header("Location:" . parent::BASE_URL . "error/show404");
			return;
		}

		// Récupération des Utrips liés à l'utilisateur.
		$objUtripModel = new UtripModel();
		$arrUtrips = $objUtripModel->findUtripByUser($intUserId, 2);
		$arrUtripsToDisplay = array();
		foreach ($arrUtrips as $arrDetailUtrip) {
			$objUtrip = new Utrip();
			$objUtrip->hydrate($arrDetailUtrip);
			$arrUtripsToDisplay[] = $objUtrip;
		}

		// Récupération des participations au forum de l'utilisateur.
		$objForumModel = new ForumModel();
		$arrForums = $objForumModel->findForumByUser($intUserId, 2);
		$arrForumsToDisplay = array();
		foreach ($arrForums as $arrDetailForum) {
			$objForum = new Forum();
			$objForum->hydrate($arrDetailForum);
			$arrForumsToDisplay[] = $objForum;
		}

		// Récupération des informations de l'utilisateur.
		$objUserModel = new UserModel();
		$arrUser = $objUserModel->get($intUserId);
		$objUser = new User();
		$objUser->setBio("");
		$objUser->hydrate($arrUser);
		$objUser->setBan(0);
		$objUser->setComment('');

		// Gestion de la modération de l'utilisateur.
		if (count($_POST) > 0) {
			$objUser->setBan($_POST['moderation']);
			$objUser->setComment($_POST['comment']);
			
			// Condition pour bannir un utilisateur avec un commentaire obligatoire.
			if ($objUser->getBan() && $objUser->getComment() == '') {
				$arrErrors['comment'] = "Vous devez écrire un commentaire pour bannir l'utilisateur";
			} else {
				$objUserModel->moderate($objUser);
				header("Location:" . parent::BASE_URL . "user/manage");
			}
		}

		// Préparation des données pour l'affichage.
		$this->_arrData["objUser"] = $objUser;
		$this->_arrData["arrErrors"] = $arrErrors;
		$this->_arrData["strPage"] = "user";
		$this->_arrData["strTitle"] = "Détail d'un utilisateur";
		$this->_arrData["strDesc"] = "Page affichant le détail d'un utilisateur";
		$this->_arrData["arrUtripsToDisplay"] = $arrUtripsToDisplay;
		$this->_arrData["arrForumsToDisplay"] = $arrForumsToDisplay;

		// Affichage du template du profil utilisateur.
		$this->afficheTpl("user");
	}
}