<?php
    /**
     * Classe de base pour toutes les entités.
     * Fournit des fonctionnalités communes à toutes les entités, telles que l'hydratation.
     * L'hydratation est le processus de remplissage d'un objet avec des données à partir d'un tableau.
     * 
     * @author Gauthier
     * @version 2024
     */
    class Entity {

        protected string $_strPrefixe;

        /**
         * Hydrate l'objet avec les données fournies dans le tableau.
         * Parcoure chaque clé du tableau et, si un setter correspondant existe dans l'objet,
         * appelle ce setter avec la valeur associée.
         * Les clés du tableau doivent correspondre aux noms des attributs de l'objet,
         * préfixés et formatés pour correspondre à la convention des setters.
         * 
         * @param array $arrData Tableau associatif des données à utiliser pour hydrater l'objet.
         * Les clés doivent correspondre aux attributs de l'objet, préfixées par $_strPrefixe.
         */
        public function hydrate($arrData) {
            
            if(is_iterable($arrData)){
                foreach ($arrData as $key => $value) {
                    $strSetterName    = "set".ucfirst(str_replace($this->_strPrefixe, "", $key));
                    // Si le setter existe dans la classe 
                    if (method_exists($this, $strSetterName)) {
                        $this->$strSetterName($value);
                    }
                }
            }else{
                header("Location:../error/show404");
            }
        }
    }
