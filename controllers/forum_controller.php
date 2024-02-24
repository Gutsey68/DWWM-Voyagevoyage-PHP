<?php
	/** 
	* Controller du forum
	* @author Gauthier
	*/
    include_once("models/forum_model.php");
    include_once("entities/forum_entity.php");

    class ForumCtrl extends Ctrl {

        const MAX_CONTENT = 300;

		/**
		* Méthode qui permet d'afficher la page du forum
		*/
        public function home() {

            // Récupère l'information dans $_POST
            $strKeywords     = $_POST['keywords'] ?? "";

            $arrSearch         = array('keywords'     => $strKeywords );

            /* Utilisation de la classe model */
            $objForumModel    = new ForumModel;
            $arrForums        = $objForumModel->findAll(0, $arrSearch);

            // Parcourir les articles pour créer des objets
            $arrForumsToDisplay    = array();
            foreach ($arrForums as $arrDetailForum) {
                $objForum = new Forum();
                $objForum->hydrate($arrDetailForum);
                $arrForumsToDisplay[] = $objForum;
            }

            $this->_arrData["strKeywords"]        = $strKeywords;
            $this->_arrData["strPage"]            = "forum";
            $this->_arrData["strTitle"]           = "Forum";
            $this->_arrData["strDesc"]            = "Forum de discussion";
            $this->_arrData["arrForumsToDisplay"] = $arrForumsToDisplay;

            $this->afficheTpl("forum");

        }

        /**
		* Méthode qui permet d'ajouter un topic
		*/
        public function create_topic() {

            $arrErrors = array();
            $objForum = new Forum();

            if (count($_POST) > 0){
                $objForum->hydrate($_POST);

                // Vérification des données de l'utilisateur
                $arrErrors = array();
                if ($objForum->getTitle() == ""){
                    $arrErrors['title'] = "Le titre est obligatoire";
                }
                if ($objForum->getContent() == ""){
                    $arrErrors['content'] = "Le contenu est trop court";
                }
                elseif (strlen($objForum->getContent()) < 2){
                    $arrErrors['content'] = "Le contenu est trop court";
                }
                if(count($arrErrors) == 0){
                    $objForumModel	= new ForumModel;
                    if ($objForumModel->insert($objForum)){
                        header("Location:index.php?action=create_topic&ctrl=forum");
                    }else{
                        $arrErrors[] = "L'insertion s'est mal passée";
                    }
                }
            } else { // Formulaire non envoyé
                $objForum->setTitle("");
                $objForum->setContent("");
            }

            $this->_arrData["arrErrors"] 	= $arrErrors;
            $this->_arrData["objUser"]		= $objForum;
            $this->_arrData["strPage"]     = "create_topic";
            $this->_arrData["strTitle"] = "Créer un topic";
            $this->_arrData["strDesc"]     = "Page de création de topic";

            $this->afficheTpl("create_topic");
        }

        /**
		* Méthode qui permet de voir un topic
		*/
        public function topic() {

            $this->_arrData["strPage"]     = "ctopic";
            $this->_arrData["strTitle"] = "topic";
            $this->_arrData["strDesc"]     = "Page d'un topic'";

            $this->afficheTpl("topic");
        }
    }
