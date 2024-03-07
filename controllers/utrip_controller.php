<?php
/** 
 * Gère la présentation des articles et des topics de forum sur la page d'accueil.
 * Ce contrôleur est responsable de récupérer les derniers articles Utrip et les derniers topics de forum
 * pour les afficher sur la page d'accueil du site.
 * @author Gauthier
 */
include_once("models/utrip_model.php");
include_once("models/forum_model.php");
include_once("entities/utrip_entity.php");
include_once("entities/forum_entity.php");
include_once("entities/like_entity.php");
include_once("entities/comment_entity.php");

class UtripCtrl extends Ctrl {

    const MAX_CONTENT = 220; // Définit la limite maximale de contenu pour les extraits d'articles.

    /**
     * Affiche la page d'accueil avec les 4 derniers articles Utrip et les 2 derniers topics de forum.
     * Cette méthode récupère les données nécessaires via les modèles correspondants et prépare
     * les objets pour l'affichage avant de passer le contrôle au template de la page d'accueil.
     */
    public function home() {
        // Récupération des 4 derniers articles Utrip.
        $objUtripModel = new UtripModel();
        $arrUtrips = $objUtripModel->findAll(4);

        // Transformation des données d'articles en objets Utrip pour l'affichage.
        $arrUtripsToDisplay = array();
        foreach ($arrUtrips as $arrDetailUtrip) {
            $objUtrip = new Utrip();
            $objUtrip->hydrate($arrDetailUtrip);
            $arrUtripsToDisplay[] = $objUtrip;
        }

        // Récupération des 2 derniers topics de forum.
        $objForumModel = new ForumModel();
        $arrForums = $objForumModel->findAll(2);

        // Transformation des données de forum en objets Forum pour l'affichage.
        $arrForumsToDisplay = array();
        foreach ($arrForums as $arrDetailForum) {
            $objForum = new Forum();
            $objForum->hydrate($arrDetailForum);
            $arrForumsToDisplay[] = $objForum;
        }

        // Préparation des données pour le template de la page d'accueil.
        $this->_arrData["strPage"] = "index";
        $this->_arrData["strTitle"] = "Accueil";
        $this->_arrData["strDesc"] = "Page d'accueil";
        $this->_arrData["arrUtripsToDisplay"] = $arrUtripsToDisplay;
        $this->_arrData["arrForumsToDisplay"] = $arrForumsToDisplay;

        // Affichage du template de la page d'accueil.
        $this->afficheTpl("home");
    }


		/**
		 * Méthode qui permet d'ajouter un article.
		 * Cette méthode récupère les données du formulaire soumis, valide ces données, 
		 * traite les images téléchargées et insère les informations de l'article dans la base de données.
		 * Redirige l'utilisateur vers la page d'exploration en cas de succès.
		 */
        public function raconte() {

        // Récupère l'information dans $_POST
        $strCat                 = $_POST['cat']??"";
        $strCity                = $_POST['city']??"";
        $intCityId                = $_POST['cityId']??"";
        $intCatId              = $_POST['cat']??0;


        /* Utilisation de la classe model pour les catégories */
        $objUtripModel    = new UtripModel;
        $arrCats          = $objUtripModel->findCat();

        // Parcourir les articles pour créer des objets
        $arrCatsToDisplay    = array();
        foreach ($arrCats as $arrDetailCat) {
            $objUtrip = new Utrip();
            $objUtrip->hydrate($arrDetailCat);
            $arrCatsToDisplay[] = $objUtrip;
        }

		/* 2. Récupérer les informations du formulaire */
		$arrErrors 			= array();
		$objUtrip 		= new Utrip();
		$objUtripModel	= new UtripModel();
			$objUtrip->setId(0);
			$objUtrip->setName("");
			$objUtrip->setDescription("");
			$objUtrip->setImg("");
			$objUtrip->setCat("");
			$objUtrip->setCity("");
			$objUtrip->setCityId(0);
			$objUtrip->setCatId(0);
			$objUtrip->setBudget("");

		
			if (count($_POST) > 0 && count($_FILES) > 0 ){

				// Créer un objet article 
				$objUtrip->hydrate($_POST);
				
				// Vérifications de base et validations
				if (!isset($_SESSION['user']['user_id']) || $_SESSION['user']['user_id'] == '') {
					$arrErrors['log'] = "Vous devez être inscrit pour publier un article";
				}
				if ($objUtrip->getName() == "") {
					$arrErrors['name'] = "Le titre est obligatoire";
				}
				if ($objUtrip->getDescription() == "") {
					$arrErrors['description'] = "Le contenu est obligatoire";
				}
				if ($objUtrip->getBudget() > 10000000000) {
					$arrErrors['budget'] = "Vous vous êtes fait arnaquer !";
				}
				if ($objUtrip->getCity() == "") {
					$arrErrors['city'] = "La ville est obligatoire";
				}
				if ($objUtrip->getCat() == "") {
					$arrErrors['cat'] = "La catégorie est obligatoire";
				}
				if (count($_FILES['image']['name']) > 20 ) {
					$arrErrors['image'] = "Le nombre d'image est limité à 20";
				}
				if (isset($_POST['city']) && !empty($_POST['city'])) {
					$cityName = $_POST['city'];

					// Utilisez le modèle pour obtenir l'ID de la ville à partir du nom
					$cityId = $objUtripModel->getCityIdByName($cityName);
					if ($cityId) {

						// Ici, vous pouvez soit définir l'ID de la ville dans votre objet,
						// soit le conserver pour une utilisation ultérieure, comme lors de l'insertion dans la base de données
						$_POST['cityId'] = $cityId;
					} else {
						$arrErrors['city'] = "La ville spécifiée n'a pas été trouvée dans la base de données.";
					}
				}
				
				if (count($arrErrors) == 0) {

					// Insérer l'article en BDD et récupérer son ID
					$objUtrip->setCityId($_POST['cityId']);
					$intLastUtripId = $objUtripModel->insert($objUtrip);
					
					if ($intLastUtripId !== false) {
						// Traitement des images
						$arrImagesDet = array();
						foreach ($_FILES['image']['name'] as $key => $name) {
							if ($name != "") {
								$arrImagesDet[] = [
									'name' => $_FILES['image']['name'][$key],
									'type' => $_FILES['image']['type'][$key],
									'tmp_name' => $_FILES['image']['tmp_name'][$key],
									'error' => $_FILES['image']['error'][$key],
									'size' => $_FILES['image']['size'][$key]
								];
							}
						}
						
						foreach ($arrImagesDet as $arrDetImage) {
							if (in_array($arrDetImage['type'], $this->_arrMimesType)) {
								$strSource = $arrDetImage['tmp_name'];
								$strImgName = bin2hex(random_bytes(5)) . ".webp";
								$strDest = "uploads/" . $strImgName;
								
								// Ici, vous pouvez ajouter le code de redimensionnement si nécessaire
								
								if (move_uploaded_file($strSource, $strDest)) {
									// Insertion de l'image en BDD avec son nom et l'ID de l'utrip
									$objUtripModel->insertImg($strImgName, $intLastUtripId);
								} else {
									$arrErrors['img'] = "Erreur lors de l'enregistrement de l'image";
								}
							} else {
								$arrErrors['img'] = "Le type d'image n'est pas autorisé";
							}
						}
						
						if (count($arrErrors) == 0) {
							 header("Location:".parent::BASE_URL."utrip/explore");
							exit();
						}
					} else {
						$arrErrors[] = "L'insertion s'est mal passée";
					}
					
				}

			}
        $this->_arrData["strCat"]           = $strCat;
        $this->_arrData["strCity"]          = $strCity;
        $this->_arrData["intCatId"]         = $intCatId;
        $this->_arrData["intCityId"]         = $intCityId;
        $this->_arrData["objUtrip"]         = $objUtrip;
        $this->_arrData["arrCatsToDisplay"] = $arrCatsToDisplay;

		$this->_arrData["strPage"]      = "raconte";
		$this->_arrData["strTitle"]     = "Ajouter un article";
		$this->_arrData["strDesc"]      = "Page où on écrit un article";

        $this->_arrData["arrErrors"] 	= $arrErrors;

        $this->afficheTpl("raconte");

        }


		/**
		 * Méthode qui permet d'afficher la page contenant tous les articles avec une fonction de recherche.
		 * Elle récupère les critères de recherche depuis $_POST, récupère les articles correspondants via le modèle,
		 * et prépare les données pour l'affichage.
		 */
        public function explore() {

            // Récupère l'information dans $_POST
            $strKeywords     = $_POST['keywords']??"";
            $strDate         = $_POST['date']??"";
            $strCat          = $_POST['cat']??"";
            $strCont         = $_POST['cont']??"";
			$strStartBudget	= $_POST['startbudget']??"";
			$strEndBudget		= $_POST['endbudget']??"";
			$intSorting		= $_POST['sorting']??0;
			$strStartDate	= $_POST['startdate']??"";
			$strEndDate		= $_POST['enddate']??"";

            $arrSearch         = array('keywords'     => $strKeywords,
                                        'date'        => $strDate,
                                        'cat'         => $strCat,
										'sorting'     => $intSorting,
										'startbudget' => $strStartBudget,
										'startdate'   => $strStartDate,
										'enddate' 	  => $strEndDate,
									    'endbudget'   => $strEndBudget,
                                        'cont'        => $strCont );
                                        
            /* Utilisation de la classe model */
            $objUtripCatModel    = new UtripModel;
            $arrCats          = $objUtripCatModel->findCat();

            // Parcourir les articles pour créer des objets (pour afficher les catégories)
            $arrCatsToDisplay    = array();
            foreach ($arrCats as $arrDetailCat) {
                $objUtripCat = new Utrip(); 
                $objUtripCat->hydrate($arrDetailCat);
                $arrCatsToDisplay[] = $objUtripCat;
            }

            $objUtripModel    = new UtripModel;
            $arrUtrips        = $objUtripModel->findAll(0, $arrSearch);

            // Parcourir les articles pour créer des objets (pour afficher les articles)
            $arrUtripsToDisplay    = array();
            foreach ($arrUtrips as $arrDetailUtrip) {
                $objUtrip = new Utrip(); 
                $objUtrip->hydrate($arrDetailUtrip);
                $arrUtripsToDisplay[] = $objUtrip;
            }
			
            $this->_arrData["strKeywords"]     = $strKeywords;
            $this->_arrData["strDate"]         = $strDate;
            $this->_arrData["strCat"]          = $strCat;
            $this->_arrData["strCont"]          = $strCont;
			$this->_arrData["strStartBudget"] = $strStartBudget;
			$this->_arrData["strEndBudget"] 	= $strEndBudget;
			$this->_arrData["strStartDate"] = $strStartDate;
			$this->_arrData["strEndDate"] 	= $strEndDate;
			$this->_arrData["intSorting"] 	= $intSorting;

            $this->_arrData["strPage"]     = "explore";
            $this->_arrData["strTitle"] = "Explore";
            $this->_arrData["strDesc"]     = "Découvrez des aventures uniques racontées par des voyageurs passionnés. Laissez-vous inspirer par leurs expériences et partagez les vôtres.";
            $this->_arrData["arrUtripsToDisplay"] = $arrUtripsToDisplay;
            $this->_arrData["arrCatsToDisplay"] = $arrCatsToDisplay;

            $this->afficheTpl("explore");
        }


		/**
		 * Méthode qui permet d'afficher une page d'article spécifique.
		 * Récupère l'ID de l'article depuis $_GET, récupère les détails de l'article et les commentaires associés,
		 * et gère la suppression de commentaires et la modération de l'article si nécessaire.
		 */
        public function utrip() {

            $arrErrors = array();
			if (is_numeric($_GET['id'])){
				$intUtripId	= $_GET['id']??0;
			}else{
				header("Location:".parent::BASE_URL."error/show404");
			}

			// Récupère l'article 
			$objUtripModel	= new UtripModel();
			$arrUtrip 		= $objUtripModel->get($intUtripId);

			$objUtrip 		= new Utrip();
			$objUtrip->hydrate($arrUtrip);
			$objUtrip->setValid(0);
			$objUtrip->setComment('');
			$arrUtripImgs = $objUtripModel->getImgs($intUtripId);

			// supprimer un commentaire
			if (isset($_POST['commentaireId']) && $_POST['commentaireId'] !== '') {

				// Récupère et nettoie l'ID du commentaire
				$comId = filter_var($_POST['commentaireId'] ?? 0, FILTER_SANITIZE_NUMBER_INT);
				$objUtripModel->deleteCom($comId);
			}

			// instance du commentaire 
			$objUtripModelCom	= new UtripModel();
			$objComment = new Comment();

			if (isset($_POST['com']) && $_POST['com'] !== '') {
				$objComment->setContent($_POST['com']);

				if ($objComment->getContent() == ""){
					$arrErrors['content'] = "Le commentaire ne peut être vide.";
				} else {
					
					$objUtripModelCom->insertCom($objComment);
				}
			}

			if ((isset($_POST['moderation']) && $_POST['moderation'] !== '') || (isset($_POST['comment']) && $_POST['comment'] !== '')) {
					$objUtrip->setValid($_POST['moderation']);
					$objUtrip->setComment($_POST['comment']);
					
					if(!$objUtrip->getValid() && $objUtrip->getComment() == ''){
						$arrErrors['comment'] = "Le commentaire est obligatoire quand la validation de l'article est refusée";
					}else{
						$objUtripModel->moderate($objUtrip);
					}
			 }

			// Récupérer la catégorie de l'article
			$strCat = $objUtrip->getCat();

			// Récupération des Utrips liés à l'utilisateur.
			$objUtripCatModel = new UtripModel();
			$arrUtripsCat = $objUtripCatModel->findUtripByCat($intUtripId,$strCat, 4);
			
			$arrUtripsCatToDisplay = array();
			foreach ($arrUtripsCat as $arrDetailUtripCat) {
				$objUtripCat = new Utrip();
				$objUtripCat->hydrate($arrDetailUtripCat);
				$arrUtripsCatToDisplay[] = $objUtripCat; }
			
			$arrComments = $objUtripModel->getCom($intUtripId);
			$this->_arrData["arrComments"] = $arrComments;

			// instance du like
			$objUtripModelLike	= new UtripModel();
			$arrLikes = $objUtripModelLike->getLikes($intUtripId);

			$this->_arrData["arrLikes"] = $arrLikes;
			$this->_arrData["objUtrip"]	= $objUtrip;
			$this->_arrData["arrErrors"] 	= $arrErrors;
			$this->_arrData["objComment"]	= $objComment;
            $this->_arrData["strPage"]     = "utrip";
			$this->_arrData["arrUtripImgs"] = $arrUtripImgs;
			$this->_arrData["arrUtripsCatToDisplay"] = $arrUtripsCatToDisplay;

            $this->afficheTpl("utrip");
        }

		/**
		 * Méthode permettant d'afficher les articles pour les gérer.
		 * Accessible uniquement aux utilisateurs connectés avec les rôles appropriés, elle récupère la liste de tous les articles
		 * pour permettre leur gestion (modification, suppression).
		 */
		public function manage(){

			// si l'utilisateur est connecté
			if (!isset($_SESSION['user']['user_id']) || $_SESSION['user']['user_id'] == ''){
				header("Location:".parent::BASE_URL."error/show403");
			}
			
			$objUtripModel	= new UtripModel;
			$arrUtrips		= $objUtripModel->findList();
			$arrUtripsToDisplay	= array();

			foreach($arrUtrips as $arrDetailUtrip){	
				$objUtrip = new Utrip();		// instancie un objet Article
				$objUtrip->hydrate($arrDetailUtrip);
				$arrUtripsToDisplay[] = $objUtrip;
			}			
			
			$this->_arrData["arrUtripsToDisplay"] = $arrUtripsToDisplay;
			$this->_arrData["strPage"] 	= "manage";

			$this->afficheTpl("utrip_manage");
		}
	
		/**
		 * Méthode permettant de supprimer un article.
		 * Récupère l'ID de l'article à supprimer depuis $_GET et procède à sa suppression via le modèle.
		 * Redirige ensuite vers la page de gestion des articles.
		 */
		public function delete(){

			// Numéro de l'article à supprimer
			$intUtripId		= $_GET['id']??0;
			$objUtripModel	= new UtripModel();
			$objUtripModel->delete($intUtripId);
			header("Location:".parent::BASE_URL."utrip/manage");
		}

		/**
		 * Méthode permettant de modifier un article.
		 * Accessible uniquement par les utilisateurs connectés et autorisés, elle charge les détails de l'article à modifier,
		 * permet à l'utilisateur de modifier les informations et sauvegarde les modifications.
		 */
		public function edit_utrip() {
			
		// si l'utilisateur est connecté
		if (!isset($_SESSION['user']['user_id']) || $_SESSION['user']['user_id'] == ''){
			header("Location:".parent::BASE_URL."error/show403");
		}

		$intUtripId	        = $_GET['id']??0;
		$arrErrors = array();

		/* Utilisation de la classe model pour les catégories */
		$objUtripModel    = new UtripModel;
		$arrCats          = $objUtripModel->findCat();

		// Parcourir les articles pour créer des objets
		$arrUtripImgs = $objUtripModel->getImgs($intUtripId);
		$arrCatsToDisplay    = array();
		foreach ($arrCats as $arrDetailCat) {
			$objUtrip = new Utrip();
			$objUtrip->hydrate($arrDetailCat);
			$arrCatsToDisplay[] = $objUtrip;
		}
	
		$objUtripModel	= new UtripModel();
		$arrUtrip 		= $objUtripModel->get($intUtripId);
		$objUtrip 		= new Utrip();
		$objUtrip->hydrate($arrUtrip);

		if ((($_SESSION['user']['user_role'] != "admin" )) && $_SESSION['user']['user_id'] != $objUtrip->getCreatorId()){
			if ((($_SESSION['user']['user_role'] != "modo" )) && $_SESSION['user']['user_id'] != $objUtrip->getCreatorId()){	
			header("Location:".parent::BASE_URL."error/show403");
			}
		}

		if (count($_POST) > 0){

				$objUtrip->setName($_POST['name']);
				$objUtrip->setDescription($_POST['description']);
				$objUtrip->setBudget($_POST['budget']);
				$objUtrip->setCatId($_POST['cat']);

				if ($objUtripModel->update($objUtrip)){
					header("Location:".parent::BASE_URL."index.php");
				}else{
					$arrErrors[] = "La modification s'est mal passée";
				}
			}else{
				
			}
			
		$this->_arrData["arrCatsToDisplay"] = $arrCatsToDisplay;
		$this->_arrData["objUtrip"]         = $objUtrip;
		$this->_arrData["strPage"] 		= "edit_utrip";
		$this->_arrData["arrErrors"] 	= $arrErrors;
		$this->_arrData["arrUtripImgs"] = $arrUtripImgs;

        $this->afficheTpl("edit_utrip");
        
		}
	

		/**
		 * Méthode permettant de liker un article.
		 * Accessible uniquement par les utilisateurs connectés, elle récupère l'ID de l'utilisateur et de l'article depuis la session
		 * et $_GET respectivement, puis procède à l'ajout d'un like via le modèle.
		 */
		public function like(){

			$userId = $_SESSION['user']['user_id'];
			$utripId = $_GET['id'] ?? 0;
			
			
			$objUtripModel = new UtripModel();
			$objUtripModel->Like($userId, $utripId);
			header("Location:".parent::BASE_URL."utrip/utrip?id=$utripId");
		}

    }

