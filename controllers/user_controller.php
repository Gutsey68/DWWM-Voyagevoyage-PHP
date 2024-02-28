<?php

    /** 
     * Controller des utilisateurs
     * @author Groupe1
     */
    include_once("models/user_model.php");
    include_once("entities/user_entity.php");

    class UserCtrl extends Ctrl {

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
						header("Location:index.php?ctrl=utrip&action=home");
					}else{
						$arrErrors[] = "L'insertion s'est mal passée";
					}
				}
            }else{ // Formulaire non envoyé
                $objUser->setName("");
                $objUser->setFirstname("");
                $objUser->setPseudo("");
                $objUser->setEmail("");
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
                    /* 3. Si ok => Session */
                    $_SESSION['user'] = $arrUser;
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
			header("Location:http://localhost/projet_2/index.php");
		}
	
		/**
		* Méthode permettant de modifier son profil
		*/
		public function edit_profile() {

			var_dump($_POST);
			// Est-ce que l'utilisateur est connecté ?
			if (!isset($_SESSION['user']['user_id']) || $_SESSION['user']['user_id'] == ''){
				header("Location:http://localhost/projet_2/index.php");
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

				// Attention si informations de session modifiées => modifier la session
				$_SESSION['user']['user_firstname'] = $objUser->getFirstname();
				$_SESSION['user']['user_name'] 		= $objUser->getName();
				
					
				header("Location:http://localhost/projet_2/index.php");
					
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
    }
