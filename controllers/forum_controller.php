<?php
	/** 
	* Controller du forum
	* @author Gauthier
	*/
    include_once("models/forum_model.php");
    include_once("entities/forum_entity.php");
    include_once("entities/comment_topic_entity.php");

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
                if (!isset($_SESSION['user']['user_id']) || $_SESSION['user']['user_id'] == ''){
					$arrErrors['log'] = "Vous devez être inscrit pour publier un article";
				}
                if ($objForum->getTitle() == ""){
                    $arrErrors['title'] = "Le titre est obligatoire";
                }
                if ($objForum->getContent() == ""){
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
            $arrErrors = array();
            $intForumId	= $_GET['id']??0;
            
            /* Récupère le topic */
			$objForumModel	= new ForumModel();// instancie le modèle Article
			$arrForum 		= $objForumModel->get($intForumId);
            
            // supprimer un commentaire
			if (isset($_POST['comtopicId']) && $_POST['comtopicId'] !== '') {

				// Récupère et nettoie l'ID du commentaire
				$comId = filter_var($_POST['comtopicId'] ?? 0, FILTER_SANITIZE_NUMBER_INT);
                $objForumModel->deleteCom($comId);
			}

            // supprimer un commentaire
			if (isset($_POST['comtopicId']) && $_POST['comtopicId'] !== '') {

				// Récupère et nettoie l'ID du commentaire
				$comId = filter_var($_POST['comtopicId'] ?? 0, FILTER_SANITIZE_NUMBER_INT);
                $objForumModel->deleteCom($comId);
			}

			$objForum 		= new Forum();	// instancie un objet Article
			$objForum->hydrate($arrForum);
			$objForum->setValid(0);
			$objForum->setComment('');
            // instance du commentaire 
			$objForumModelCom	= new ForumModel();
			$objCommentTopic = new CommentTopic();
            if (isset($_POST['answer']) && $_POST['answer'] !== '') {
                if (isset($_SESSION['user']) || $_SESSION['user'] != ''){
                    $objCommentTopic->setContent($_POST['answer']);
                    if ($objCommentTopic->getContent() == ""){
                        $arrErrors['answer'] = "Le commentaire ne peut être vide.";
                    } else {
                        $objForumModelCom->insertComt($objCommentTopic);
                    }
                }else{
                    $arrErrors['answer'] = "Vous devez être connecté pour pouvoir publier un commentaire";
                }
			}
            

			
			if ((isset($_POST['moderation']) && $_POST['moderation'] !== '') || (isset($_POST['comment']) && $_POST['comment'] !== '')) {
                    $objForum->setValid($_POST['moderation']);
                    $objForum->setComment($_POST['comment']);
                    
                    if(!$objForum->getValid() && $objForum->getComment() == ''){
                        $arrErrors['comment'] = "Le commentaire est obligatoire quand la validation du topic est refusée";
                    }else{
                        $objForumModel->moderate($objForum);
                    }
			}
            $arrCommentsTopic = $objForumModel->getCom($intForumId);
			$this->_arrData["arrCommentsTopic"] = $arrCommentsTopic;
			
			$this->_arrData["arrErrors"] 	= $arrErrors;
            $this->_arrData["objForum"]	= $objForum;
            $this->_arrData["objCommentTopic"]	= $objCommentTopic;

            $this->_arrData["strPage"]     = "topic";
            $this->_arrData["strTitle"] = "topic";
            $this->_arrData["strDesc"]     = "Page d'un topic'";


            $this->afficheTpl("topic");
        }
                		
		/**
		* Méthode permettant d'afficher les topics du forum pour les gérer
		*/
		public function manage(){
			// si l'utilisateur est connecté
			if (!isset($_SESSION['user']['user_id']) || $_SESSION['user']['user_id'] == ''){
				header("Location:".parent::BASE_URL."error/show403");
			}
			
			$objForumModel	= new ForumModel;
			$arrForums		= $objForumModel->findList();

			$arrForumsToDisplay	= array();
			foreach($arrForums as $arrDetailForum){	
				$objForum = new Forum();
				$objForum->hydrate($arrDetailForum);
				$arrForumsToDisplay[] = $objForum;
			}			
			
			$this->_arrData["arrForumsToDisplay"] = $arrForumsToDisplay;

			$this->_arrData["strPage"] 	= "manage";
			$this->_arrData["strTitle"] = "Gérer les topics";
			$this->_arrData["strDesc"] 	= "Page permettant d'afficher les topics pour les gérer";

			$this->afficheTpl("forum_manage");
		}
        	
		/**
		* Méthode permettant de supprimer un topic
		*/
		public function delete(){
			// Numéro de l'article à supprimer



            // cganger $get par l'id du topic


			$intForumId		= $_GET['id']??0;
			$objForumModel	= new ForumModel();
			$objForumModel->delete($intForumId);
			header("Location:".parent::BASE_URL."forum/manage");
		}
    }
