<?php
	/** 
	* Controller des articles
	* @author Gauthier
	*/
    include_once("models/utrip_model.php");
    include_once("models/forum_model.php");
    include_once("entities/utrip_entity.php");
    include_once("entities/forum_entity.php");

    class UtripCtrl extends Ctrl {

        const MAX_CONTENT = 220;

		/**
		* Méthode qui permet d'afficher la page d'accueil contenant les 4 derniers articles et les 2 derniers topics du forum
		*/
        public function home() {
            $arrSearch = array();
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
            $objUtrip = new Utrip();
            if (count($_POST) > 0 && count($_FILES) > 0) {

                /* Créer un objet article */
                $objUtrip->hydrate($_POST);
                if ($objUtrip->getName() == "") {
                    $arrErrors['title'] = "Le titre est obligatoire";
                }
                if (strlen($objUtrip->getName()) < 10) {
                    $arrErrors['title'] = "Le titre doit faire au minimum 10 caractères";
                }
                if ($objUtrip->getDescription() == "") {
                    $arrErrors['content'] = "Le contenu est obligatoire";
                }

                /* Enregistrer l'image */
                $strImgName    = $_FILES['img']['name'];
                if ($strImgName != "") {
                    // Si le type d'image est autorisé
                    if (in_array($_FILES['img']['type'], $this->_arrMimesType)) {
                        $strSource     = $_FILES['img']['tmp_name'];
                        $strImgName    = bin2hex(random_bytes(5)) . ".webp";
                        $strDest    = "uploads/" . $strImgName;
                        /* Avec redimensionnement */
                        $percent     = 0.5;
                        // Calcul des nouvelles dimensions
                        list($width, $height) = getimagesize($strSource);
                        $newwidth    = $width * $percent;
                        $newheight    = $height * $percent;
                        // Création des GdImage
                        $dest    = imagecreatetruecolor($newwidth, $newheight); // Image vide
                        $source = imagecreatefrompng($strSource); // Image importée
                        // Redimensionnement
                        imagecopyresized($dest, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                        // Enregistrement du fichier
                        if (imagewebp($dest, $strDest, IMG_WEBP_LOSSLESS)) {
                            $objUtrip->setImg($strImgName);
                        } else {
                            $arrErrors['img'] = "Erreur lors de l'enregistrement de l'image";
                        }
                    } else {
                        $arrErrors['img'] = "Le type d'image n'est pas autorisé";
                    }
                } else {
                    $arrErrors['img'] = "L'image est obligatoire";
                }
                /* Enregistrer l'objet en BDD */
                if (count($arrErrors) == 0) {
                    $objUtripModel    = new UtripModel;
                    if ($objUtripModel->insert($objUtrip)) {
                        header("Location:index.php?ctrl=utrip&action=explore");
                    } else {
                        $arrErrors[] = "L'insertion s'est mal passée";
                    }
                }
            } else {
                $objUtrip->setName("");
                $objUtrip->setDescription("");
            }
            
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
    }
