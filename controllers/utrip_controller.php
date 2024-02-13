<?php
include_once("models/utrip_model.php");
include_once("models/forum_model.php");
include_once("entities/utrip_entity.php");
include_once("entities/forum_entity.php");
class UtripCtrl extends Ctrl
{

    const MAX_CONTENT = 50;

    public function home()
    {

        /* Utilisation de la classe model */
        $objUtripModel    = new UtripModel;
        $arrUtrips        = $objUtripModel->findAll(4);

        // Parcourir les articles pour créer des objets
        $arrUtripsToDisplay    = array();
        foreach ($arrUtrips as $arrDetailUtrip) {
            $objUtrip = new Utrip();
            $objUtrip->hydrate($arrDetailUtrip);
            $arrUtripsToDisplay[] = $objUtrip;
        }

        /* Utilisation de la classe model */
        $objForumModel    = new ForumModel;
        $arrForums        = $objForumModel->findAll(2);

        // Parcourir les articles pour créer des objets
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

    public function raconte()
    {

        /* 2. Récupérer les informations du formulaire */
        var_dump($_POST);
        var_dump($_FILES);

        /* 3. Créer un objet article */
        $objUtrip = new Utrip();    // instancie un objet Article
        $objUtrip->hydrate($_POST);    // hydrate (setters) avec les données du formulaire

        /* 4. Enregistrer l'image */
        $strSource     = $_FILES['image']['tmp_name'];
        $strImgName    = $_FILES['image']['name'];
        $strDest    = "uploads/" . $strImgName;
        move_uploaded_file($strSource, $strDest);
        $objUtrip->setImg($strImgName);

        /* 5. Enregistrer l'objet en BDD */
        $objUtripModel    = new UtripModel;
        $objUtripModel->insert($objUtrip);

        $this->_arrData["strPage"]     = "raconte";
        $this->_arrData["strTitle"] = "Racontez";
        $this->_arrData["strDesc"]     = "Page où on écrit un article";
        /* 1. Afficher le formulaire */
        $this->afficheTpl("raconte");
    }

    public function explore()
    {

        // Récupère l'information dans $_POST => car form est en methode post
        $strKeywords     = $_POST['keywords'] ?? "";
        //$strKeywords 	= trim($strKeywords);
        $intPeriod        = $_POST['period'] ?? 0;
        $strDate        = $_POST['date'] ?? "";
        $strStartDate    = $_POST['startdate'] ?? "";
        $strEndDate        = $_POST['enddate'] ?? "";

        $arrSearch         = array(
            'keywords'     => $strKeywords,
            'period'     => $intPeriod,
            'date'         => $strDate,
            'startdate' => $strStartDate,
            'enddate'     => $strEndDate,
        );

        /* Utilisation de la classe model */
        $objUtripModel    = new UtripModel;
        $arrUtrips        = $objUtripModel->findAll(0, $arrSearch);

        // Parcourir les articles pour créer des objets
        $arrUtripsToDisplay    = array();
        foreach ($arrUtrips as $arrDetailUtrip) {
            $objUtrip = new Utrip();        // instancie un objet Article
            $objUtrip->hydrate($arrDetailUtrip);
            $arrUtripsToDisplay[] = $objUtrip;
        }

        $this->_arrData["strKeywords"]     = $strKeywords;
        $this->_arrData["intPeriod"]     = $intPeriod;
        $this->_arrData["strDate"]         = $strDate;
        $this->_arrData["strStartDate"] = $strStartDate;
        $this->_arrData["strEndDate"]     = $strEndDate;

        $this->_arrData["strPage"]     = "explore";
        $this->_arrData["strTitle"] = "Explore";
        $this->_arrData["strDesc"]     = "Découvrez des aventures uniques racontées par des voyageurs passionnés. Laissez-vous inspirer par leurs expériences et partagez les vôtres.";
        $this->_arrData["arrUtripsToDisplay"] = $arrUtripsToDisplay;

        $this->afficheTpl("explore");
    }
}
