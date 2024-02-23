<?php
/** 
 * Controller des érreurs
 * @author Groupe1
 */
    class ErrorCtrl extends Ctrl {
        
		/**
		* Méthode qui permet d'afficher la page d'érreur 404
		*/
        public function show404() {
            $this->_arrData["strPage"]     = "404";
            $this->_arrData["strTitle"] = "Page non trouvée";
            $this->_arrData["strDesc"]     = "Page affichant le fait que la page demandée n'a pas été trouvée";
            $this->afficheTpl("show404");
        }

        /**
		* Méthode qui permet d'afficher la page d'érreur 404
		*/
        public function show403() {
            $this->_arrData["strPage"]     = "403";
            $this->_arrData["strTitle"] = "Page non autorisée";
            $this->_arrData["strDesc"]     = "Page affichant le fait que la page demandée n'est pas autorisée";
            $this->afficheTpl("show403");
        }
    }
