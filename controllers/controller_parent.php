<?php
	/**
	* Classe de base pour les contrôleurs. Fournit des méthodes communes pour la gestion des templates, des erreurs et des données.
	* Inclut des fonctionnalités pour la configuration des cookies, la gestion des types MIME et la sécurité des pages d'administration.
	* @author Groupe1
	*/
    class Ctrl {

		// URL de base de l'application
		const BASE_URL = "http://localhost/projet_2/";
		
		// Stocke les messages d'erreur à afficher dans les templates
		protected array $_arrErrors = array();
		
		// Données à transmettre aux templates
		protected array $_arrData	= array(); 
		
		// Types MIME autorisés pour les uploads
        protected array $_arrMimesType = array("image/jpeg", "image/png" , "image/webp");

        // Options de configuration pour les cookies
		protected array $_arrCookieOptions = array ();

        // Identifie les pages accessibles uniquement par l'administrateur
		protected array $_arrAdminPages = array("", "");

		/**
		 * Constructeur de la classe Ctrl. Initialise les options de cookies et gère l'accès aux pages d'administration.
		 */
		public function __construct() {
			// Configuration par défaut des cookies
			$this->_arrCookieOptions = array (
									'expires' 	=> time() + (365*24*60*60),
									'path' 		=> '/', 
									'domain' 	=> '',
									'secure' 	=> false,  
									'httponly' 	=> true,   
									'samesite' 	=> 'Strict' 
									);

			// Restriction d'accès aux pages administratives
			if (count($_GET) > 0) {
				$strPage	= $_GET['ctrl'].'/'.$_GET['action'];
				
				// Redirection si l'utilisateur n'est pas admin et tente d'accéder à une page admin
				if (in_array($strPage, $this->_arrAdminPages) && $_SESSION['user']['user_role_id'] != "1") {
					header("Location:".self::BASE_URL."error/show403");
				}
			}
		}

		/**
		* Méthode d'affichage des templates. Charge le template spécifié et assigne les données à Smarty.
		* @param string $strTpl Nom du template à afficher.
		* @param bool $boolDisplay Si vrai, affiche le template directement, sinon retourne le contenu.
		*/
		public function afficheTpl($strTpl, $boolDisplay = true){
			// Initialisation de Smarty
			include_once("libs/smarty/Smarty.class.php");
			$smarty = new Smarty();

			// Assignation des données pour le template
			foreach($this->_arrData as $key=>$value){
				$smarty->assign($key, $value);
			}

			// Assignation de données supplémentaires
			$smarty->assign("user", $_SESSION['user']??array());
			$smarty->assign("base_url", self::BASE_URL);
			
			// Affichage ou récupération du contenu du template
			if ($boolDisplay){
				$smarty->display("views/".$strTpl.".tpl");
			}else{
				return $smarty->fetch("views/".$strTpl.".tpl");
			}
		}

		/**
		* Gère la recherche d'articles depuis la navbar. Récupère les mots-clés, effectue la recherche et affiche les résultats.
		*/
		public function explore(){
			$strKeywords     = $_POST['keywords']??"";

			$arrSearch         = array('keywords'     => $strKeywords);
			
            // Instance du modèle et recherche
            $objUtripModel    = new UtripModel;
			$arrUtrips        = $objUtripModel->findAll
			(0, $arrSearch);

			// Transformation des résultats de recherche en objets et préparation pour l'affichage
			$arrUtripsToDisplay    = array();
			foreach ($arrUtrips as $arrDetailUtrip) {
				$objUtrip = new Utrip(); 
				$objUtrip->hydrate($arrDetailUtrip);
				$arrUtripsToDisplay[] = $objUtrip;
	
				// Préparation des données pour le template
				$this->_arrData["strKeywords"]     = $strKeywords;
				$this->_arrData["strPage"]     = "explore";
				$this->_arrData["arrUtripsToDisplay"] = $arrUtripsToDisplay;
	
				// Affichage du template explore avec les données de recherche
				$this->afficheTpl("explore");
			}
		}
	}
	