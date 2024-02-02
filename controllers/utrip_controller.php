<?php
include_once("models/utrip_model.php");
include_once("entities/utrip_entity.php");
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

        $this->_arrData["strPage"]     = "index";
        $this->_arrData["strTitle"] = "Accueil";
        $this->_arrData["strDesc"]     = "Page d'acceuil";
        $this->_arrData["arrUtripsToDisplay"] = $arrUtripsToDisplay;

        $this->afficheTpl("home");
    }

    public function raconte()
    {

        /* Utilisation de la classe model */
        $objUtripModel    = new UtripModel;
        $arrUtrips        = $objUtripModel->findAll();

        // Parcourir les articles pour créer des objets
        $arrUtripsToDisplay    = array();
        foreach ($arrUtrips as $arrDetailUtrip) {
            $objUtrip = new Utrip();
            $objUtrip->hydrate($arrDetailUtrip);
            $arrUtripsToDisplay[] = $objUtrip;
        }

        $this->_arrData["strPage"]     = "raconte";
        $this->_arrData["strTitle"] = "Racontez";
        $this->_arrData["strDesc"]     = "Page où on écrit un article";
        $this->_arrData["arrUtripsToDisplay"] = $arrUtripsToDisplay;

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
