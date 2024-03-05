<?php
    /** 
     * Contrôleur pour les fonctionnalités du forum, inclut la gestion des topics et des commentaires.
     * @author Gauthier
     */
    include_once("models/forum_model.php");
    include_once("entities/forum_entity.php");
    include_once("entities/comment_topic_entity.php");

    class ForumCtrl extends Ctrl {

        // Limite de contenu.
        const MAX_CONTENT = 300; 

        /**
         * Affiche la page principale du forum avec la liste des topics. Permet une recherche par mots-clés.
         */
        public function home() {

            // Récupération du mot-clé de recherche depuis $_POST.
            $strKeywords = $_POST['keywords'] ?? "";
            $arrSearch = ['keywords' => $strKeywords];

            // Instanciation du modèle du forum
            $objForumModel = new ForumModel; 
            $arrForums = $objForumModel->findAll(0, $arrSearch);

            // Préparation du tableau des forums à afficher et transformation des données en objets Forum.
            $arrForumsToDisplay = []; 
            foreach ($arrForums as $arrDetailForum) { 
                $objForum = new Forum();
                $objForum->hydrate($arrDetailForum);
                $arrForumsToDisplay[] = $objForum;
            }

            // Assignation des données pour le template
            $this->_arrData["strKeywords"] = $strKeywords;
            $this->_arrData["strPage"] = "forum";
            $this->_arrData["arrForumsToDisplay"] = $arrForumsToDisplay;

            $this->afficheTpl("forum");
        }

        /**
         * Traite la création d'un nouveau topic. Valide les entrées et enregistre le topic si valide.
         */
        public function create_topic() {

            // Initialisation du tableau des erreurs et instanciation d'un nouveau forum pour le formulaire
            $arrErrors = []; 
            $objForum = new Forum();

            // Traitement du formulaire si des données sont soumises et hydratation de l'objet Forum avec les données du formulaire
            if (count($_POST) > 0) { 
                $objForum->hydrate($_POST);

                // Validation des données
                if (!isset($_SESSION['user']['user_id']) || $_SESSION['user']['user_id'] == '') {
                    $arrErrors['log'] = "Vous devez être inscrit pour publier un topic";
                }
                if (empty($objForum->getTitle())) {
                    $arrErrors['title'] = "Le titre est obligatoire";
                }
                if (empty($objForum->getContent())) {
                    $arrErrors['content'] = "Le contenu est trop court";
                }
                // Insertion du topic si aucune erreur
                if (empty($arrErrors)) { 
                    $objForumModel = new ForumModel;
                    if (!$objForumModel->insert($objForum)) {
                        $arrErrors[] = "L'insertion s'est mal passée";
                    } else {
                        // Redirection si succès
                        header("Location:" . parent::BASE_URL . "forum/home"); 
                        return;
                    }
                }
            } else {
                // Réinitialisation du forum pour le formulaire
                $objForum->setTitle("");
                $objForum->setContent("");
            }

            // Assignation des données pour le template en cas d'erreurs ou de réaffichage du formulaire
            $this->_arrData["arrErrors"] = $arrErrors;
            $this->_arrData["objForum"] = $objForum;
            $this->_arrData["strPage"] = "create_topic";

            $this->afficheTpl("create_topic");
        }

        /**
         * Affiche un topic spécifique avec ses détails et commentaires. Permet également la suppression de commentaires
         * et la publication de nouveaux commentaires si l'utilisateur est connecté.
         */
        public function topic() {

            // Validation de l'ID du topic
            if (!is_numeric($_GET['id'])) { 
                header("Location:" . parent::BASE_URL . "error/show404");
                return;
            }
            // Récupération de l'ID du topic
            $intForumId = $_GET['id'] ?? 0; 

            // Instanciation du modèle Forum et récupération des détails du topic
            $objForumModel = new ForumModel(); 
            $arrForum = $objForumModel->get($intForumId);

            if (isset($_POST['comtopicId']) && $_POST['comtopicId'] !== '') {
                // Nettoyage de l'ID du commentaire et suppression du commentaire
                $comId = filter_var($_POST['comtopicId'], FILTER_SANITIZE_NUMBER_INT); 
                $objForumModel->deleteCom($comId);
            }

            // Instanciation d'un nouvel objet Forum pour le topic et hydratation de l'objet avec les données du topic
            $objForum = new Forum(); 
            $objForum->hydrate($arrForum);

            // Gestion de la publication de nouveaux commentaires et initialisation du tableau d'erreurs pour les commentaires
            $arrErrors = [];
            // Instanciation d'un nouvel objet pour le commentaire
            $objCommentTopic = new CommentTopic(); 
            if (isset($_POST['answer']) && $_POST['answer'] !== '') {
                if (isset($_SESSION['user'])) {
                    $objCommentTopic->setContent($_POST['answer']);
                    if (empty($objCommentTopic->getContent())) {
                        $arrErrors['answer'] = "Le commentaire ne peut être vide.";
                    } else {
                        // Insertion du commentaire
                        $objForumModel->insertComt($objCommentTopic); 
                    }
                } else {
                    $arrErrors['answer'] = "Vous devez être connecté pour pouvoir publier un commentaire";
                }
            }

            // Préparation des données pour le template et récupération des commentaires du topic
            $arrCommentsTopic = $objForumModel->getCom($intForumId);

            $this->_arrData["arrCommentsTopic"] = $arrCommentsTopic;
            $this->_arrData["arrErrors"] = $arrErrors;
            $this->_arrData["objForum"] = $objForum;
            $this->_arrData["objCommentTopic"] = $objCommentTopic;
            $this->_arrData["strPage"] = "topic";

            $this->afficheTpl("topic");
        }
        
        /**
         * Affiche une page de gestion pour les topics, accessible uniquement par les modérateurs et administrateurs.
         * Permet la visualisation des topics pour éventuelle édition ou suppression.
         */
        public function manage() {

            // Vérification de la connexion de l'utilisateur
            if (!isset($_SESSION['user']['user_id']) || $_SESSION['user']['user_id'] == '') { 
                header("Location:" . parent::BASE_URL . "error/show403");
                return;
            }

            // Instanciation du modèle Forum et récupération de la liste des topics pour gestion
            $objForumModel = new ForumModel(); 
            $arrForums = $objForumModel->findList();

            // Préparation de la liste des topics pour l'affichage
            $arrForumsToDisplay = []; 
            foreach ($arrForums as $arrDetailForum) {
                $objForum = new Forum();
                $objForum->hydrate($arrDetailForum);
                $arrForumsToDisplay[] = $objForum;
            }

            // Assignation des données pour le template
            $this->_arrData["arrForumsToDisplay"] = $arrForumsToDisplay;
            $this->_arrData["strPage"] = "manage";

            $this->afficheTpl("forum_manage");
        }
        
        /**
         * Permet la suppression d'un topic spécifié par son ID. Redirection vers la page principale du forum après suppression.
         */
        public function delete() {

            // Récupération de l'ID du topic à supprimer et instanciation du modèle Forum
            $intForumId = $_GET['id'] ?? 0; 
            $objForumModel = new ForumModel();

            // Suppression du topic et redirection vers la page d'accueil du forum
            $objForumModel->delete($intForumId); 
            header("Location:" . parent::BASE_URL . "forum/home"); 
        }
    }
