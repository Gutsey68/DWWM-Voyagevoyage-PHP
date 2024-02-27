<?php
	/** 
	* Controller des articles
	* @author Gauthier
	*/
    include_once("models/utrip_model.php");
    include_once("models/forum_model.php");
    include_once("entities/utrip_entity.php");
    include_once("entities/forum_entity.php");
    include_once("entities/img_entity.php");

    class UtripCtrl extends Ctrl {

        const MAX_CONTENT = 220;

		/**
		* Méthode qui permet d'afficher la page d'accueil contenant les 4 derniers articles et les 2 derniers topics du forum
		*/
        public function home() {

            /* Utilisation de la classe model pour les articles*/
            $objUtripModel    = new UtripModel;
            $arrUtrips        = $objUtripModel->findAll(4);


            // Parcourir les articles pour créer des objets
			// -----  TODO Optimisation => déplacer dans modèle ------- //
            $arrUtripsToDisplay    = array();
            foreach ($arrUtrips as $arrDetailUtrip) {
                $objUtrip = new Utrip();
                $objUtrip->hydrate($arrDetailUtrip);
                $arrUtripsToDisplay[] = $objUtrip;
            }

            /* Utilisation de la classe model pour les topics */
            $objForumModel    = new ForumModel;
            $arrForums        = $objForumModel->findAll(2);

            // Parcourir les topics pour créer des objets
            $arrForumsToDisplay    = array();
            foreach ($arrForums as $arrDetailForum) {
                $objForum = new Forum();
                $objForum->hydrate($arrDetailForum);
                $arrForumsToDisplay[] = $objForum;
            }

            $this->_arrData["strPage"]     = "index";
            $this->_arrData["strTitle"] = "Accueil";
            $this->_arrData["strDesc"]     = "Page d'acceuil";
            $this->_arrData["arrUtripsToDisplay"] = $arrUtripsToDisplay;
            $this->_arrData["arrForumsToDisplay"] = $arrForumsToDisplay;

            $this->afficheTpl("home");
        }

        /**
		* Méthode qui permet d'ajouter un article
		*/
        public function raconte() {
            

        // Récupère l'information dans $_POST
        $intUtripId	        = $_GET['id']??0;
        $strCat                 = $_POST['cat']??"";
        $strCity                = $_POST['city']??"";
        $intCityId                = $_POST['city']??0;
        $intCatId              = $_POST['cat']??0;

        $arrRaconte         = array('cat'         => $strCat,
                                    'city'        => $strCity);


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

        /* Utilisation de la classe model pour les villes */
        $objUtripModel    = new UtripModel;
        $arrCity          = $objUtripModel->findCity();

        // Parcourir les articles pour créer des objets
        $arrCityToDisplay    = array();
        foreach ($arrCity as $arrDetailCity) {
            $objUtrip = new Utrip();
            $objUtrip->hydrate($arrDetailCity);
            $arrCityToDisplay[] = $objUtrip;
        }



 
			/* 2. Récupérer les informations du formulaire */
			$arrErrors 			= array();
			$objUtrip 		= new Utrip();	// instancie un objet Article
			$objUtripModel	= new UtripModel();// instancie le modèle Article
			
			/* Récupère l'article */
			$arrUtrip 	= $objUtripModel->get($intUtripId);
			if ($arrUtrip === false){
				$objUtrip->setId(0);
				$objUtrip->setName("");
				$objUtrip->setDescription("");
				$objUtrip->setImg("");
				$objUtrip->setCat("");
				$objUtrip->setCity("");
				$objUtrip->setCityId(0);
				$objUtrip->setCatId(0);
				$objUtrip->setBudget("0");
			}else{
				/* j'hydrate en fonction de l'article */
				$objUtrip->hydrate($arrUtrip);
				if ($_SESSION['user']['user_role'] != "admin" && 
					$_SESSION['user']['user_id'] != $objUtrip->getCreator()){
					header("Location:".parent::BASE_URL."error/show403");
				}
			}		
			
			// Tableau des fichiers si multiples
			/* Pour le projet => traitement images multiples
			$arrImagesDet = array();
			foreach($_FILES['image'] as $key=>$arrImages){
				foreach($arrImages as $num => $val){
					$arrImagesDet[$num][$key] = $val;
				}
			}*/
			
			if (count($_POST) > 0 && count($_FILES) > 0){
				/* 3. Créer un objet article */
				$objUtrip->hydrate($_POST);	// hydrate (setters) avec les données du formulaire
				if ($objUtrip->getName() == ""){
					$arrErrors['name'] = "Le titre est obligatoire";
				}
				if ($objUtrip->getDescription() == ""){
					$arrErrors['description'] = "Le contenu est obligatoire";
				}
				if ($objUtrip->getCity() == ""){
					$arrErrors['city'] = "La ville est obligatoire";
				}
				if ($objUtrip->getCat() == ""){
					$arrErrors['cat'] = "La catégorie est obligatoire";
				}
				
				/* 4. Enregistrer l'image */
				//$strImgName	= $_FILES['image']['name'];
				
				$strImgName	= $_FILES['image']['name'];
				if ($strImgName != ""){
					// Si le type d'image est autorisé
					if (in_array($_FILES['image']['type'], $this->_arrMimesType)){ 
						$strSource 	= $_FILES['image']['tmp_name'];
						$strImgName	= bin2hex(random_bytes(5)).".webp";
						$strDest	= "uploads/".$strImgName;
						/* Avec redimensionnement */
						$percent 	= 0.5;
						// Calcul des nouvelles dimensions
						list($width, $height) = getimagesize($strSource);
						$newwidth	= intval($width* $percent);
						$newheight	= intval($height* $percent);
						// Création des GdImage
						$dest	= imagecreatetruecolor($newwidth, $newheight); // Image vide
						switch ($_FILES['image']['type']){
							case "image/jpeg":
								$source = imagecreatefromjpeg($strSource); // Image importée
								break;
							case "image/png" :
								$source = imagecreatefrompng($strSource); // Image importée
								break;
							case "image/webp" :
								$source = imagecreatefromwebp($strSource); // Image importée
								break;
							default :
								$source = imagecreatefromwebp($strSource); // Image importée
								break;
						}
						
						// Redimensionnement
						imagecopyresized($dest, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
						// Enregistrement du fichier
						if (imagewebp($dest, $strDest, IMG_WEBP_LOSSLESS)){
							$objUtrip->setImg($strImgName);
						}else{
							$arrErrors['img'] = "Erreur lors de l'enregistrement de l'image";
						}
						
					}else{
						$arrErrors['img'] = "Le type d'image n'est pas autorisé";
					}
				}elseif ($objUtrip->getImg() =='') {
					$arrErrors['img'] = "L'image est obligatoire";
				}
				/* 5. Enregistrer l'objet en BDD */
				if (count($arrErrors) == 0){
					if ($objUtrip->getId() === 0){
						if ($objUtripModel->insertImg($objUtrip)){
                            var_dump($objUtrip);
							header("Location:".parent::BASE_URL."utrip/raconte");
						}else{
							$arrErrors[] = "L'insertion s'est mal passée";
						}
					}else{
						if ($objUtripModel->update($objUtrip)){
							header("Location:".parent::BASE_URL."utrip/raconte");
						}else{
							$arrErrors[] = "La modification s'est mal passée";
						}
					}
				}
			}else{
				
			}
            var_dump($_POST);
            var_dump($_FILES);
        $this->_arrData["strCat"]           = $strCat;
        $this->_arrData["strCity"]          = $strCity;
        $this->_arrData["intCatId"]         = $intCatId;
        $this->_arrData["intCityId"]        = $intCityId;
        $this->_arrData["objUtrip"]         = $objUtrip;
        $this->_arrData["arrCatsToDisplay"] = $arrCatsToDisplay;
        $this->_arrData["arrCityToDisplay"] = $arrCityToDisplay;

        if ($objUtrip->getId() === 0){
            $this->_arrData["strPage"]      = "raconte";
            $this->_arrData["strTitle"]     = "Ajouter un article";
            $this->_arrData["strDesc"]      = "Page où on écrit un article";
        }else{
            $this->_arrData["strPage"] 		= "edit_article";
            $this->_arrData["strTitle"] 	= "Modifier un article";
            $this->_arrData["strDesc"] 		= "Page permettant de modifier un article";
        }
        $this->_arrData["arrErrors"] 	= $arrErrors;

        $this->afficheTpl("raconte");
        }

		/**
		* Méthode qui permet d'afficher la page contenant tous les articles avec une recherche
		*/
        public function explore() {

            // Récupère l'information dans $_POST
            $strKeywords     = $_POST['keywords']??"";
            $strDate         = $_POST['date']??"";
            $strCat          = $_POST['cat']??"";
            $strCont         = $_POST['cont']??"";

            $arrSearch         = array('keywords'     => $strKeywords,
                                        'date'        => $strDate,
                                        'cat'         => $strCat,
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

            $this->_arrData["strPage"]     = "explore";
            $this->_arrData["strTitle"] = "Explore";
            $this->_arrData["strDesc"]     = "Découvrez des aventures uniques racontées par des voyageurs passionnés. Laissez-vous inspirer par leurs expériences et partagez les vôtres.";
            $this->_arrData["arrUtripsToDisplay"] = $arrUtripsToDisplay;
            $this->_arrData["arrCatsToDisplay"] = $arrCatsToDisplay;

            $this->afficheTpl("explore");
        }

		/**
		* Méthode qui permet d'afficher une page d'article
		*/
        public function utrip() {
            $intUtripId	= $_GET['id']??0;
			
			$objUtrip 		= new Utrip();	// instancie un objet Article
			$objUtripModel	= new UtripModel();// instancie le modèle Article
			
			$arrUtrip 	= $objUtripModel->get($intUtripId);
			$objUtrip->hydrate($arrUtrip);
			

            $this->_arrData["strPage"]     = "utrip";
            $this->_arrData["strTitle"] = "Article";
            $this->_arrData["strDesc"]     = "Contenu de l'article";
			$this->_arrData["objUtrip"]	= $objUtrip;

            $this->afficheTpl("utrip");
        }
    }
