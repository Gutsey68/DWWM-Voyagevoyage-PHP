<?php

    /** 
     * Contrôleur pour la gestion des erreurs, étend le contrôleur de base Ctrl.
     * Permet d'afficher des pages spécifiques en cas d'erreurs HTTP comme 404 ou 403.
     * @author Groupe1
     */
    class ErrorCtrl extends Ctrl {
        
        /**
        * Génère et affiche la page d'erreur 404 - Page non trouvée.
        * Configure les données nécessaires au template et appelle la méthode d'affichage.
        */
        public function show404() {

            // Configuration des données pour le template 404
            $this->_arrData["strPage"] = "404";

            // Appel de la méthode d'affichage du template
            $this->afficheTpl("show404");
        }

        /**
        * Génère et affiche la page d'erreur 403 - Accès refusé.
        * Configure les données nécessaires au template et appelle la méthode d'affichage.
        */
        public function show403() {
            // Configuration des données pour le template 403
            $this->_arrData["strPage"] = "403";
            // Appel de la méthode d'affichage du template
            $this->afficheTpl("show403");
        }
    }
