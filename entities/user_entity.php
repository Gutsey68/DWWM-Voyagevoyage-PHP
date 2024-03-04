<?php
    include_once("parent_entity.php");
    /**
     * Classe entité de l'objet utilisateur
     * @author Gauthier
     * @version 2024
     */
    class User extends Entity {
        
        // Propriétés
        protected string $_strPrefixe = "user_";

        private int $_id;
        private string $_name;
        private string $_firstname;
        private string $_pseudo;
        private string $_email;
        private string $_password;
        private string $_phone;
        private string $_regisdate;
        private string $_pp;
        private string $_ban;
        private string $_bio;
        private string $_role;
		private string $_comment;

        // Méthodes

        /**
         * Getter de récupération de la valeur de l'id
         * @return identifiant de l'objet
         */
        public function getId(): int {
            return $this->_id;
        }
        
        /**
         * Setter de récupération de la valeur de l'id
         * @return identifiant de l'objet
         */
        public function setId(int $intId) {
            $this->_id = $intId;
        }

        /**
         * Getter de récupération du nom
         * @return nom de l'objet
         */
        public function getName(): string {
            return $this->_name;
        }

        /**
         * Setter de récupération du nom
         * @return nom de l'objet
         */
        public function setName(string $strName) {
            $this->_name = $strName;
        }

        /**
         * Getter de récupération du prénom
         * @return prenom de l'objet
         */
        public function getFirstname(): string {
            return $this->_firstname;
        }

        /**
         * Setter de récupération du prénom
         * @return prenom de l'objet
         */
        public function setFirstname(string $strFirstname) {
            $this->_firstname = $strFirstname;
        }

        /**
         * Getter de récupération du pseudo
         * @return pseudo de l'objet
         */
        public function getPseudo(): string {
            return $this->_pseudo;
        }

        /**
         * Setter de récupération du pseudo
         * @return pseudo de l'objet
         */
        public function setPseudo(string $strPseudo) {
            $this->_pseudo = $strPseudo;
        }

        /**
         * Getter de récupération de l'email
         * @return email de l'objet
         */
        public function getEmail(): string {
            return $this->_email;
        }

        /**
         * Setter de récupération de l'email
         * @return email de l'objet
         */
        public function setEmail(string $strEmail) {
            $this->_email = $strEmail;
        }

        /**
         * Getter de récupération du mot de passe
         * @return mdp de l'objet
         */
        public function getPassword(): string {
            return $this->_password;
        }

        /**
         * Setter de récupération du mot de passe
         * @return mdp de l'objet
         */
        public function setPassword(string $strPassword) {
            $this->_password = $strPassword;
        }

        /**
         * Getter de récupération du numéro de téléphone
         * @return telephone de l'objet
         */
        public function getPhone(): string {
            return $this->_phone;
        }

        /**
         * Setter de récupération du numéro de téléphone
         * @return telephone de l'objet
         */
        public function setPhone(string $strPhone) {
            $this->_phone = $strPhone;
        }

        /**
         * Getter de récupération de la date de création de compte
         * @return regisdate de l'objet
         */
        public function getRegisdate(): string {
            return $this->_regisdate;
        }

        /**
         * Setter de récupération de la date de création de compte
         * @return regisdate de l'objet
         */
        public function setRegisdate(string $strRegisdate) {
            $this->_regisdate = $strRegisdate;
        }

        /**
		 * Getter de récupération de la date de création sous le format français
		 * @return identifiant de l'objet
		 */
		public function getRegisdateFr() {
			// Traitement de la date
			$objDate        = new DateTime($this->_regisdate);
			return $objDate->format("d/m/Y");
		}

        /**
         * Getter de récupération du numéro de la photo de profil
         * @return pp de l'objet
         */
        public function getPp(): string {
            return $this->_pp;
        }

        /**
         * Setter de récupération du numéro de la photo de profil
         * @return pp de l'objet
         */
        public function setPp(string $strPp) {
            $this->_pp = $strPp;
        }

        /**
         * Getter de récupération de si ban ou non
         * @return ban de l'objet
         */
        public function getBan(): string {
            return $this->_ban;
        }

        /**
         * Setter de récupération de si ban ou non
         * @return ban de l'objet
         */
        public function setBan(string $strBan) {
            $this->_ban = $strBan;
        }

        /**
         * Getter de récupération de la bio
         * @return bio de l'objet
         */
        public function getBio(): string {
            return $this->_bio;
        }

        /**
         * Setter de récupération de la bio
         * @return ibio de l'objet
         */
        public function setBio(string $strBio) {
            $this->_bio = $strBio;
        }

        /**
         * Getter de récupération du role
         * @return role de l'objet
         */
        public function getRole(): string {
            return $this->_role;
        }

        /**
         * Setter de récupération du role
         * @return irole de l'objet
         */
        public function setRole(string $strRole) {
            $this->_role = $strRole;
        }

        /**
        * Getter de récupération du mot de passe haché
        * @return mot de passe haché
        */
        public function getPwdHash():string { 
            return password_hash($this->_password, PASSWORD_DEFAULT);
        }
        
		/**
		* Getter de récupération du commentaire de validation
		* @return string commentaire de validation
		*/
		public function getComment():string{ 
			return $this->_comment;
		}
		/**
		* Setter de modification du commentaire de validation
		* @param string commentaire de validation
		*/
		public function setComment(string $strComment){ 
			$this->_comment = trim($strComment); // Enlève les espaces avant et après
			$this->_comment = filter_var($this->_comment, FILTER_SANITIZE_FULL_SPECIAL_CHARS); // nettoyage
		}		
    }
