<?php
/** 
 * Controller des pages
 * @author Gauthier
 */
    class PageCtrl extends Ctrl {

		/**
		* Méthode qui permet d'afficher la page about
		*/
        public function about() {

            $this->_arrData["strPage"]     = "about";
            $this->_arrData["strTitle"] = "A propos";
            $this->_arrData["strDesc"]     = "Page de contenu";
            $this->afficheTpl("about");
        }

		/**
		* Méthode qui permet d'afficher la page de mentions légales
		*/

        public function mentions() {

            $this->_arrData["strPage"]     = "mentions";
            $this->_arrData["strTitle"] = "Mentions légales";
            $this->_arrData["strDesc"]     = "Page de contenu";
            $this->afficheTpl("mentions");
        }

		/**
		* Méthode qui permet d'afficher la page de contact
		*/
        public function contact() {

            $this->_arrData["strPage"]     = "contact";
            $this->_arrData["strTitle"] = "Contact";
            $this->_arrData["strDesc"]     = "Page de contact";
            $this->afficheTpl("contact");
        }

		/**
		* Méthode qui permet d'afficher la page du plan du site
		*/
        public function plan() {
            
            $this->_arrData["strPage"]     = "plan";
            $this->_arrData["strTitle"] = "Plan du site";
            $this->_arrData["strDesc"]     = "Page du plan du site";
            $this->afficheTpl("plan");
        }
    }
