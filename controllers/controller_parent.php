<?php
	/**
	* Controller mère
	* @author Groupe1
	*/
    class Ctrl {
        // Tableau des données à utiliser dans le template
        protected array $_arrData = array();
        protected array $_arrMimesType = array("image/jpeg", "image/png");

        // Tableau de configuration des cookies
		protected array $_arrCookieOptions = array ();

        // Tableau de sécurisation des pages => uniquement pour l'admin (à définir)
		protected array $_arrAdminPages = array("", "");

		public function __construct() {
			
			$this->_arrCookieOptions = array (
									'expires' 	=> time() + (365*24*60*60), // nbjours*nbheures*nbminutes*nbsecondes
									'path' 		=> '/', 
									'domain' 	=> '', // domaine !!!!!! A préciser pour Firefox !!!!!!
									'secure' 	=> false,     // HTTPS
									'httponly' 	=> true,    // accessible uniquement en http, pas en js par exemple
									'samesite' 	=> 'Strict' // None || Lax  || Strict
									);

			// Pages admin uniquement
			if (count($_GET) > 0) {
				$strPage	= $_GET['ctrl'].'/'.$_GET['action'];
				
				if (in_array($strPage, $this->_arrAdminPages) && $_SESSION['user']['user_role_id'] != "1") {
					header("Location:http://localhost/blog/error/show403");
				}
			}
		}
			
		/**
		* Méthode d'affichage des templates
		* @param $strTpl Nom du template à afficher
		*/
        public function afficheTpl($strTpl) {
            include("libs/smarty/Smarty.class.php");
            $smarty = new Smarty();

            foreach ($this->_arrData as $key => $value) {
                $smarty->assign($key, $value);
            }
            $smarty->display("views/" . $strTpl . ".tpl");
        }
    }
