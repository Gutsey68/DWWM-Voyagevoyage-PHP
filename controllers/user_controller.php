<?php

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'libs/PHPMailer/Exception.php';
	require 'libs/PHPMailer/PHPMailer.php';
	require 'libs/PHPMailer/SMTP.php';

    /** 
     * Controller des utilisateurs
     * @author Groupe1
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
		* Méthode permettant de créer un compte 
		*/
        public function create_account() {
            $arrErrors = array();
            $objUser = new User();

            if (count($_POST) > 0){
                $objUser->hydrate($_POST);
                $arrErrors = $this->_verifInfos($objUser);
                $arrErrors = array_merge($arrErrors, $this->_verifPwd($objUser->getPassword()));

                if(count($arrErrors) == 0){
					$objUserModel	= new UserModel;

					if ($objUserModel->insert($objUser)){
						Header("Location:".parent::BASE_URL."user/login");
					}else{
						$arrErrors[] = "L'insertion s'est mal passée";
					}
				}
            }else{ // Formulaire non envoyé
                $objUser->setName("");
                $objUser->setFirstname("");
                $objUser->setPseudo("");
                
                 
            }
            
            // Afficher
            $this->_arrData["strPage"] 		= "create_account";
            $this->_arrData["strTitle"] 	= "Créer un compte";
            $this->_arrData["strDesc"] 		= "Page permettant de créer un compte";
            $this->_arrData["arrErrors"] 	= $arrErrors;
            $this->_arrData["objUser"]		= $objUser;
            $this->afficheTpl("create_account");
        }

		/**
		* Méthode de connection d'un utilisateur
		*/
        public function login() {
            $arrErrors = array();

            /* Rechercher l'utilisateur dans la BDD */
            $strEmail     = $_POST['email'] ?? "";
            $strPassword     = $_POST['password'] ?? "";

            if (count($_POST) > 0){
                $objUserModel    = new UserModel;
                $arrUser = $objUserModel->searchUser($strEmail, $strPassword);
                if ($arrUser === false) {
                    /* 3. Si pas ok => Afficher un message d'erreur */
					$arrErrors[] = "Erreur de connexion";
				} else {
					/* Vérifier si l'utilisateur est banni */
					if ($arrUser['user_ban'] == 1) {
						/* Utilisateur banni - Détruire la session et afficher un message d'erreur */
						session_destroy();
						session_start(); // Recommencer une nouvelle session pour les messages d'erreur
						$arrErrors[] = "Votre compte a été banni. Veuillez contacter l'administrateur.";
					} else {
						//  Utilisateur non banni
						$_SESSION['user'] = $arrUser;
						Header("Location:".parent::BASE_URL);
					}
				}
			}
            
            $this->_arrData["strPage"]     = "login";
            $this->_arrData["strTitle"]    = "Se connecter";
            $this->_arrData["strDesc"]     = "Page permettant de se connecter";
            $this->_arrData["arrErrors"]   = $arrErrors;
            $this->_arrData["email"]   = $strEmail;

            $this->afficheTpl("login");
        }
        
		/**
		* Méthode permettant de se déconnecter
		*/
		public function logout() {
			session_destroy();
			header("Location:".parent::BASE_URL);
		}
	
		/**
		* Méthode permettant de modifier son profil
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
			
			// Afficher
			$this->_arrData["strPage"] 		= "edit_profile";
			$this->_arrData["strTitle"] 	= "Modifier mon compte";
			$this->_arrData["strDesc"] 		= "Page permettant de modifier mon compte";
			$this->_arrData["arrErrors"] 	= $arrErrors;
			$this->_arrData["objUser"]	= $objUser;

			$this->afficheTpl("edit_profile");
		}
	
		/**
		* Méthode permettant de modifier son profil
		*/
		public function edit_pp() {

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
	
			// Objet à partir du formulaire - à l'envoi du formulaire

			/* ------------------------------------------ */

			$strImgName	= $_FILES['pp']['name']??"";
			if ($strImgName != ""){
				// Si le type d'image est autorisé
				if (in_array($_FILES['pp']['type'], $this->_arrMimesType)){ 
					$strSource 	= $_FILES['pp']['tmp_name'];
					$strImgName	= bin2hex(random_bytes(5)).".webp";
					$strDest	= "uploads/".$strImgName;
					/* Avec redimensionnement */
					$percent 	= 0.5;
					// Calcul des nouvelles dimensions
					list($width, $height) = getimagesize($strSource);
					$newwidth	= intval($width* $percent);
					$newheight	= intval($height* $percent);
					// Création des GdImage
					$dest	= imagecreatetruecolor($newwidth, $newheight); // Image vide
					switch ($_FILES['pp']['type']){
						case "image/jpeg":
							$source = imagecreatefromjpeg($strSource); // Image importée
							break;
						case "image/png" :
							$source = imagecreatefrompng($strSource); // Image importée
							break;
						default :
							$source = imagecreatefromwebp($strSource); // Image importée
							break;
					}
					
					// Redimensionnement
					imagecopyresized($dest, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
					// Enregistrement du fichier
					if (imagewebp($dest, $strDest, IMG_WEBP_LOSSLESS)){
						$objUser->setPp($strImgName);
					}else{
						$arrErrors['img'] = "Erreur lors de l'enregistrement de l'image";
					}
					
				}else{
					$arrErrors['img'] = "Le type d'image n'est pas autorisé";
				}

				/* ------------------------------------------ */

				// Mise à jour en BDD

				if(count($arrErrors) == 0){
					$objUserModel->updatePp($objUser);

				// Attention si informations de session modifiées => modifier la session
				$_SESSION['user']['user_firstname'] = $objUser->getFirstname();
				$_SESSION['user']['user_name'] 		= $objUser->getName();

				$userId = $_SESSION['user']['user_id'];
					
				header("Location:".parent::BASE_URL."user/user?id=$userId");
					
				}else{
					$arrErrors[] = "L'insertion s'est mal passée";
				}
			}
			

			$this->_arrData["arrErrors"] 	= $arrErrors;
			$this->_arrData["objUser"]	= $objUser;
			
			$this->_arrData["strPage"] 		= "edit_pp";
			$this->_arrData["strTitle"] 	= "Modifier sa photo de profil";
			$this->_arrData["strDesc"] 		= "Page permettant de modifier sa photo de profil";


			$this->afficheTpl("edit_pp");
		}

		/**
		* Méthode privée de vérification des informations de l'utilisateur
		* @param object $objUser Objet à vérifier
		* @return array les erreurs générées
		*/
		private function _verifInfos(object $objUser, $boolVerifMail = true) {
			$arrErrors = array();

			if ($objUser->getName() == ""){
				$arrErrors['name'] = "Le nom est obligatoire";
			}elseif (strlen($objUser->getName()) < 2){
				$arrErrors['name'] = "Le nom est trop court";
			}
			if ($objUser->getFirstname() == ""){
				$arrErrors['firstname'] = "Le prénom est obligatoire";
			}
			if ($objUser->getEmail() == ""){
				$arrErrors['mail'] = "Le mail est obligatoire";
			}elseif (!filter_var($objUser->getEmail(), FILTER_VALIDATE_EMAIL)) {
				$arrErrors['mail'] = "Le mail n'est pas correct";
			}elseif ($boolVerifMail){
				$objUserModel	= new UserModel;
				// Test si le mail existe déjà
				$boolMailExists	= $objUserModel->verifMail($objUser->getEmail());
				if ($boolMailExists === true){
					$arrErrors['mail'] = "Le mail est déjà utilisé";
				}
			}
			return $arrErrors;
		}
		
		/**
		* Méthode privée de vérification du mot de passe de l'utilisateur
		* @param string $strPwd Mot de passe à vérifier
		* @return array les erreurs générées
		*/
		private function _verifPwd(string $strPassword) {
			$arrErrors	= array();
			$password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{16,}$/"; 
				
			if ($strPassword== ""){
				$arrErrors['pwd'] = "Le mot de passe est obligatoire";
			}elseif(!preg_match($password_regex, $strPassword)){
				$arrErrors['pwd'] = "Le mot de passe doit faire minimum 16 caractères 
									et contenir une minuscule, une majuscule, un chiffre et un caractère";
			}elseif ($strPassword != $_POST['passwd_confirm']){
				$arrErrors['pwd'] = "Le mot de passe et sa confirmation doivent être identiques";
			}
			return $arrErrors;
		}

		
		/**
		* Methode permettant de demander la réinitialisation du mot de passe
		* @TODO : Afficher le formulaire + envoyer le mail si adresse mail ok
		*/
		public function forgetPwd(){
			
			$arrErrors = array();
			$arrSuccess = array();
			if (count($_POST) > 0){
				if ($_POST['email'] == ''){
					$arrErrors['email'] = "Vous devez renseigner un mail";
				}else{
					$arrSuccess['email'] = "Si vous êtes inscrit vous allez recevoir un mail ....";
					$objUserModel	= new UserModel;
					$intUserId		= $objUserModel->getByMail($_POST['email']);
					if ($intUserId !== false){ 
						$strRecoCode 	= bin2hex(random_bytes(12));
						
						if ($objUserModel->updateReco($strRecoCode, $intUserId)){
							$strDestMail 	= $_POST['email'];
							$strSubject		= 'Récupération du mot de passe';
							
							$this->_arrData["code"] 	= $strRecoCode;
							$strBody		= $this->afficheTpl("mails/contact", false);
							
							$this->_sendMail($strDestMail, $strSubject, $strBody);
						}
					}
				}
			}
			
			$this->_arrData["strPage"] 	= "forgetPwd";
			$this->_arrData["strTitle"] = "Mot de passe oublié";
			$this->_arrData["strDesc"] 	= "Page permettant de régénérer son mot de passe";
			$this->_arrData["arrErrors"]= $arrErrors;
			$this->_arrData["arrSuccess"]= $arrSuccess;
			$this->afficheTpl("forget");

			
			

		}
		
		public function resetPwd(){
			if(is_null($_GET['code'])){
				Header("Location:".parent::BASE_URL."error/show404");
			}else{
				$strCode		= $_GET['code'];
			}

			$objUserModel	= new UserModel;
			$arrUser		= $objUserModel->searchByCode($strCode);

			$arrErrors		= array();
			if ($arrUser === false){
				$arrErrors['url']			= "La demande est expirée";
			}else{
				$_SESSION['user_recovery'] 	= $arrUser['user_id'];
				Header("Location:".parent::BASE_URL."user/doResetPwd");
			}

			$this->_arrData["strPage"] 	= "resetPwd";
			$this->_arrData["strTitle"] = "Réinitialisation du mot de passe";
			$this->_arrData["strDesc"] 	= "Page permettant de réinitialisation son mot de passe";
			$this->_arrData["arrErrors"]= $arrErrors;
			$this->afficheTpl("reset");
		}

		public function doResetPwd(){
			$arrErrors	= array();
			if (count($_POST) >0){
				// vérifier les mots de passe
				$arrErrors = $this->_verifPwd($_POST['pwd']);
				if (count($arrErrors) == 0){
					// mettre à jour la bdd
					$objUserModel	= new UserModel;
					if ($objUserModel->updatePwd($_POST['pwd'])){
						session_destroy();
						Header("Location:".parent::BASE_URL."user/login");
					}else{
						$arrErrors['mdp'] = "erreur de modification du mot de passe";
					}
				}
			}			

			$this->_arrData["strPage"] 	= "resetPwd";
			$this->_arrData["strTitle"] = "Réinitialisation du mot de passe";
			$this->_arrData["strDesc"] 	= "Page permettant de réinitialisation son mot de passe";
			$this->_arrData["arrErrors"]= $arrErrors;
			//$this->_arrData["arrSuccess"]= $arrSuccess;
			$this->afficheTpl("doreset");
		}		

		
		private function _sendMail($strDestMail, $strSubject, $strBody){
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->Mailer = "smtp";

			$mail->SMTPDebug  	= 0;  
			$mail->SMTPAuth   	= TRUE;
			$mail->SMTPSecure 	= "tls";
			$mail->Port       	= 587;
			$mail->Host       	= "smtp.gmail.com";
			$mail->Username 	= 'ceformation68@gmail.com';
			$mail->Password 	= 'lkpy yuoc ftuu qksu';
			$mail->CharSet		= PHPMailer::CHARSET_UTF8;
			$mail->IsHTML(true);
			$mail->setFrom('mon_blog@gmail.com', 'Exercice BLOG');
			$mail->addAddress($strDestMail);
			$mail->Subject 	= $strSubject;
			$mail->Body 	= $strBody;
			//$mail->addAttachment('test.txt');

			return $mail->send();
		}
		      		
		/**
		* Méthode permettant d'afficher les topics du forum pour les gérer
		*/
		public function manage(){
			// si l'utilisateur est connecté
			if (!isset($_SESSION['user']['user_id']) || $_SESSION['user']['user_id'] == ''){
				header("Location:".parent::BASE_URL."error/show403");
			}
			
			$objUserModel	= new UserModel;
			$arrUsers		= $objUserModel->findList();

			$arrUsersToDisplay	= array();
			foreach($arrUsers as $arrDetailUser){	
				$objUser = new User();
				$objUser->hydrate($arrDetailUser);
				$arrUsersToDisplay[] = $objUser;
			}		

			if ((isset($_POST['userId']) && $_POST['userId'] !== '') || (isset($_POST['userRole']) && $_POST['userRole'] !== '')) {
				$userId = $_POST['userId']??0; 
    			$newRole = $_POST['userRole']??0; 
				$objUserModel->updateRole($userId, $newRole);
				header("Location:".parent::BASE_URL."user/manage");
			}
			
			$this->_arrData["arrUsersToDisplay"] = $arrUsersToDisplay;

			$this->_arrData["strPage"] 	= "manage";
			$this->_arrData["strTitle"] = "Gérer les utilisateurs";
			$this->_arrData["strDesc"] 	= "Page permettant d'afficher les utilisateurs pour les gérer";

			$this->afficheTpl("user_manage");
		}

		/** 
		* Méthode permettant d'afficher le détail d'un profil d'utilisateur
		*/
		public function user(){
			$arrErrors = array();
			
			if (is_numeric($_GET['id'])){
				$intUserId	= $_GET['id']??0;
			}else{
				header("Location:".parent::BASE_URL."error/show404");
			}

			/* Utilisation de la classe model */
			$objUtripModel	= new UtripModel;
			$arrUtrips		= $objUtripModel->findUtripByUser($intUserId, 2);

			// Parcourir les articles pour créer des objets
			$arrUtripsToDisplay	= array();
			foreach($arrUtrips as $arrDetailUtrip){	
				$objUtrip = new Utrip();
				$objUtrip->hydrate($arrDetailUtrip);
				$arrUtripsToDisplay[] = $objUtrip;
			}

			 /* Utilisation de la classe model */
			 $objForumModel    = new ForumModel;
			 $arrForums        = $objForumModel->findForumByUser($intUserId, 2);
 
			 // Parcourir les articles pour créer des objets
			 $arrForumsToDisplay    = array();
			 foreach ($arrForums as $arrDetailForum) {
				 $objForum = new Forum();
				 $objForum->hydrate($arrDetailForum);
				 $arrForumsToDisplay[] = $objForum;
			 }
			

			$objUserModel	= new UserModel();
			$arrUser 		= $objUserModel->get($intUserId);

			$objUser 		= new User();
			$objUser->setBio("");
			$objUser->hydrate($arrUser);
			$objUser->setBan(0);
			$objUser->setComment('');

			if (count($_POST) >0){
				$objUser->setBan($_POST['moderation']);
				$objUser->setComment($_POST['comment']);
				
				if($objUser->getBan() && $objUser->getComment() == ''){
					$arrErrors['comment'] = "Vous devez écrire un commentaire pour bannir l'utilisateur";
				}else{
					$objUserModel->moderate($objUser);
					header("Location:".parent::BASE_URL."user/manage");
				}
			}

			$this->_arrData["objUser"] 	= $objUser;
			$this->_arrData["arrErrors"] 	= $arrErrors;

			$this->_arrData["strPage"] 	= "user";
			$this->_arrData["strTitle"] = "Détail d'un utilisateur";
			$this->_arrData["strDesc"] 	= "Page affichant le détail d'un utilisateur";
			$this->_arrData["arrUtripsToDisplay"] = $arrUtripsToDisplay;
			$this->_arrData["arrForumsToDisplay"] = $arrForumsToDisplay;

			$this->afficheTpl("user");
		}
		
    }
