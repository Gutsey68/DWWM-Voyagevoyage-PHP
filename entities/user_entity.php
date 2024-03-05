<?php

    include_once("parent_entity.php");

    /**
     * Classe représentant un utilisateur. Hérite de Entity pour une structure commune et la capacité d'hydratation.
     * Gère les informations utilisateur telles que l'identifiant, le nom, le prénom, etc.
     * Fournit des getters et setters pour manipuler les propriétés de l'utilisateur de manière sécurisée.
     * 
     * @author Gauthier
     * @version 2024
     */
    class User extends Entity {
        
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


        /**
         * Getter pour l'identifiant de l'utilisateur.
         * Récupère l'identifiant unique attribué à l'utilisateur lors de sa création. Cet identifiant est utilisé pour référencer l'utilisateur dans la base de données.
         * @return int L'identifiant de l'utilisateur.
         */
        public function getId(): int {
            return $this->_id;
        }
        
    /**
     * Setter pour l'identifiant de l'utilisateur.
     * Définit l'identifiant unique pour l'utilisateur. 
     * @param int $intId Nouvel identifiant de l'utilisateur.
     */
        public function setId(int $intId) {
            $this->_id = $intId;
        }

        /**
         * Getter pour le nom de l'utilisateur.
         * Récupère le nom de l'utilisateur.
         * @return string Le nom de l'utilisateur.
         */
        public function getName(): string {
            return $this->_name;
        }

        /**
         * Setter pour le nom de l'utilisateur.
         * Définit le nom de l'utilisateur.
         * @param string $strName Nouveau nom de l'utilisateur.
         */
        public function setName(string $strName) {
            $this->_name = $strName;
        }

        /**
         * Getter pour le prénom de l'utilisateur.
         * Récupère le prénom de l'utilisateur.
         * @return string Le prénom de l'utilisateur.
         */
        public function getFirstname(): string {
            return $this->_firstname;
        }

        /**
         * Setter pour le prénom de l'utilisateur.
         * Définit le prénom de l'utilisateur.
         * @param string $strFirstname Nouveau prénom de l'utilisateur.
         */
        public function setFirstname(string $strFirstname) {
            $this->_firstname = $strFirstname;
        }

        /**
         * Getter pour le pseudo de l'utilisateur.
         * Récupère le pseudo attribué à l'utilisateur, utilisé pour l'identifier de manière unique sur la plateforme.
         * @return string Le pseudo de l'utilisateur.
         */
        public function getPseudo(): string {
            return $this->_pseudo;
        }

        /**
         * Setter pour le pseudo de l'utilisateur.
         * Attribue ou modifie le pseudo de l'utilisateur. Le pseudo est utilisé pour identifier l'utilisateur sur la plateforme.
         * @param string $strPseudo Le nouveau pseudo à attribuer à l'utilisateur.
         */
        public function setPseudo(string $strPseudo) {
            $this->_pseudo = $strPseudo;
        }

        /**
         * Getter pour l'email de l'utilisateur.
         * Récupère l'adresse email de l'utilisateur.
         * @return string L'email de l'utilisateur.
         */
        public function getEmail(): string {
            return $this->_email;
        }

        /**
         * Setter pour l'email de l'utilisateur.
         * Définit l'adresse email de l'utilisateur. Effectue une validation de format d'email basique.
         * @param string $strEmail Nouvel email de l'utilisateur.
         */
        public function setEmail(string $strEmail) {
            $this->_email = $strEmail;
        }

        /**
         * Getter pour le mot de passe de l'utilisateur.
         * Récupère le mot de passe non crypté de l'utilisateur. Utilisation non recommandée pour des raisons de sécurité.
         * @return string Le mot de passe en clair de l'utilisateur.
         */
        public function getPassword(): string {
            return $this->_password;
        }

        /**
         * Setter pour le mot de passe de l'utilisateur.
         * Définit le mot de passe de l'utilisateur. Le mot de passe n'est pas crypté à ce niveau.
         * @param string $strPassword Nouveau mot de passe de l'utilisateur.
         */
        public function setPassword(string $strPassword) {
            $this->_password = $strPassword;
        }

        /**
         * Getter pour le numéro de téléphone de l'utilisateur.
         * Récupère le numéro de téléphone associé au compte de l'utilisateur.
         * @return string Le numéro de téléphone de l'utilisateur.
         */
        public function getPhone(): string {
            return $this->_phone;
        }

        /**
         * Setter pour le numéro de téléphone de l'utilisateur.
         * Définit le numéro de téléphone associé au compte utilisateur.
         * @param string $strPhone Nouveau numéro de téléphone de l'utilisateur.
         */
        public function setPhone(string $strPhone) {
            $this->_phone = $strPhone;
        }

        /**
         * Getter pour la date d'inscription de l'utilisateur.
         * Récupère la date à laquelle l'utilisateur a créé son compte.
         * @return string La date de création de compte de l'utilisateur.
         */
        public function getRegisdate(): string {
            return $this->_regisdate;
        }

        /**
         * Setter pour la date d'inscription de l'utilisateur.
         * Définit la date de création du compte utilisateur.
         * @param string $strRegisdate Nouvelle date de création du compte utilisateur.
         */
        public function setRegisdate(string $strRegisdate) {
            $this->_regisdate = $strRegisdate;
        }

        /**
         * Méthode pour obtenir la date d'enregistrement de l'utilisateur au format français (jj/mm/aaaa).
         * Transforme la date d'enregistrement stockée dans la base de données au format standard en une version lisible.
         * @return string La date d'enregistrement formatée au format français.
         */
		public function getRegisdateFr() {
			// Traitement de la date
			$objDate        = new DateTime($this->_regisdate);
			return $objDate->format("d/m/Y");
		}

        /**
         * Getter pour la photo de profil de l'utilisateur.
         * Récupère l'identifiant unique de la photo de profil de l'utilisateur.
         * @return string L'identifiant de la photo de profil de l'utilisateur.
         */
        public function getPp(): string {
            return $this->_pp;
        }

        /**
         * Setter pour la photo de profil de l'utilisateur.
         * Définit l'identifiant unique de la photo de profil de l'utilisateur.
         * @param string $strPp Nouvel identifiant de la photo de profil de l'utilisateur.
         */
        public function setPp(string $strPp) {
            $this->_pp = $strPp;
        }

        /**
         * Getter pour le statut de bannissement de l'utilisateur.
         * Récupère le statut indiquant si l'utilisateur est banni ou non.
         * @return string Le statut de bannissement de l'utilisateur.
         */
        public function getBan(): string {
            return $this->_ban;
        }

        /**
         * Setter pour le statut de bannissement de l'utilisateur.
         * Définit si l'utilisateur est banni ou non.
         * @param string $strBan Nouveau statut de bannissement de l'utilisateur.
         */
        public function setBan(string $strBan) {
            $this->_ban = $strBan;
        }

        /**
         * Getter pour la biographie de l'utilisateur.
         * Récupère la biographie définie par l'utilisateur dans son profil.
         * @return string La biographie de l'utilisateur.
         */
        public function getBio(): string {
            return $this->_bio;
        }

        /**
         * Setter pour la biographie de l'utilisateur.
         * Définit la biographie de l'utilisateur dans son profil.
         * @param string $strBio Nouvelle biographie de l'utilisateur.
         */
        public function setBio(string $strBio) {
            $this->_bio = $strBio;
        }

        /**
         * Getter pour le rôle de l'utilisateur.
         * Récupère le rôle assigné à l'utilisateur (ex : admin, user, guest).
         * @return string Le rôle de l'utilisateur.
         */
        public function getRole(): string {
            return $this->_role;
        }

        /**
         * Setter pour le rôle de l'utilisateur.
         * Définit le rôle de l'utilisateur (ex : admin, user, guest).
         * @param string $strRole Nouveau rôle assigné à l'utilisateur.
         */
        public function setRole(string $strRole) {
            $this->_role = $strRole;
        }


        /**
         * Méthode pour obtenir le hash du mot de passe de l'utilisateur.
         * Utilise l'algorithme de hachage PASSWORD_DEFAULT de PHP pour sécuriser le mot de passe avant son stockage ou sa vérification.
         * @return string Le hash du mot de passe de l'utilisateur.
         */
        public function getPwdHash():string { 
            return password_hash($this->_password, PASSWORD_DEFAULT);
        }
        
        /**
         * Getter pour le commentaire associé à l'utilisateur.
         * Récupère le commentaire lié à l'utilisateur, typiquement utilisé pour des notes internes ou des commentaires de modération.
         * @return string Le commentaire associé à l'utilisateur.
         */
		public function getComment():string{ 
			return $this->_comment;
		}

        /**
         * Setter pour le commentaire associé à l'utilisateur.
         * Définit un commentaire lié à l'utilisateur, pouvant être utilisé pour des notes internes ou des commentaires de modération.
         * @param string $strComment Nouveau commentaire associé à l'utilisateur.
         */
		public function setComment(string $strComment){ 
			$this->_comment = trim($strComment); // Enlève les espaces avant et après
			$this->_comment = filter_var($this->_comment, FILTER_SANITIZE_FULL_SPECIAL_CHARS); // nettoyage
		}		
    }
