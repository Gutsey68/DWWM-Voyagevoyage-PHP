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
            $strName                = $_POST['name']??"";
            $strDescription         = $_POST['description']??"";
            $strCat                 = $_POST['cat']??"";
            $strCity                = $_POST['city']??"";
            $strBudget              = $_POST['budget']??"";

            $arrRaconte         = array('name'        => $strName,
                                        'description' => $strDescription,
                                        'cat'         => $strCat,
                                        'city'        => $strCity ,
                                        'budget'      => $strBudget );
    
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

            /* Récupérer les informations du formulaire */
            $arrErrors = array();
            $objUtripModel    = new UtripModel;
            $objUtrip = new Utrip();
            if (count($_POST) > 0 && count($_FILES) > 0) {

                /* Créer un objet article */
                $objUtrip->hydrate($arrRaconte);
                if ($objUtrip->getName() == "") {
                    $arrErrors['title'] = "Le titre est obligatoire";
                }
                if ($objUtrip->getDescription() == "") {
                    $arrErrors['content'] = "Le contenu est obligatoire";
                }
                $newUtripId = $objUtripModel->insert($objUtrip);

                $arrImagesDet = array();
                $strPic = $_FILES['img']['name'] ?? "";

                foreach($_FILES['img'] as $key=>$arrImages){
                    foreach($arrImages as $num => $val){
                        $arrImagesDet[$num][$key] = $val;
                    }
                }

                foreach ($arrImagesDet as $arrImage) {
                    $objImg = new Img(); // Instancie un objet Img
    
                    // Stockage des données img dans un tableau
                    $arrImageData = array(
                        'img_id' => $newUtripId,
                        'img_name' => $arrImage['name']
                    );
    
                    // Hydrate l'objet avec les données de l'image
                    $objImg->hydrate($arrImageData);
    
                    // Vérification du type MIME de l'image
                    
                        if (in_array($arrImage['type'], $this->_arrMimesType)) {

                            // Nom de l'image de sortie 
                            $strName = bin2hex(random_bytes(5)) . ".webp";
                            $strLink = "article" . $strName;
                            $strSource = $arrImage['tmp_name'];

                            // Redimensionnement de l'image
                            list($width, $height) = getimagesize($strSource);
                            $newwidth = 500; // Nouvelle largeur souhaitée
                            $newheight = intval(($height / $width) * $newwidth); // Calcul de la nouvelle hauteur en conservant le ratio
    
                            // Création de l'image de destination
                            $dest = imagecreatetruecolor($newwidth, $newheight);
    
    
    
                            // Chargement de l'image source en fonction de son type MIME
                            switch ($arrImage['type']) {
                                case 'image/jpeg':
                                    $source = imagecreatefromjpeg($strSource);
                                    break;
                                case 'image/png':
                                    $source = imagecreatefrompng($strSource);
                                    break;
                                case 'image/webp':
                                    $source = imagecreatefromwebp($strSource);
                                    break;
                                default:
                                    // Type MIME non pris en charge
                                    $arrErrors['img'] = "Type MIME d'image non pris en charge";
                                    break;
                            }
    
                            if ($source && $dest) {
                                // Redimensionnement de l'image
                                imagecopyresampled($dest, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    
                                // Enregistrement de l'image redimensionnée au format webp
                                imagewebp($dest, $strLink, 100); // 80 est la qualité de l'image (entre 0 et 100)
    
                                // Libération de la mémoire
                                imagedestroy($source);
                                imagedestroy($dest);
        
                            } else {
                                // Erreur lors du chargement de l'image
                                $arrErrors['img'] = "Erreur lors du chargement de l'image";
                            }
                        } else {
                            // Type MIME non autorisé
                            $arrErrors['img'] = "Type MIME d'image non autorisé";
                        }
                        // Assignation du nom de l'image à l'objet
                         // $objImg->setPic($strImgName);
                        // Enregistrement du fichier dans la base de données
                        $objUtrip->insertImg();
                }
            }
            $this->_arrData["strDescription"]     = $strDescription;
            $this->_arrData["strName"]         = $strName;
            $this->_arrData["strCat"]          = $strCat;
            $this->_arrData["strCity"]          = $strCity;
            $this->_arrData["strBudget"]          = $strBudget;

            $this->_arrData["objUtrip"]     = $objUtrip;
            $this->_arrData["strPage"]         = "raconte";
            $this->_arrData["strTitle"]     = "Ajouter un article";
            $this->_arrData["strDesc"]         = "Page où on écrit un article";
            $this->_arrData["arrErrors"]     = $arrErrors;
            $this->_arrData["arrCatsToDisplay"] = $arrCatsToDisplay;

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
