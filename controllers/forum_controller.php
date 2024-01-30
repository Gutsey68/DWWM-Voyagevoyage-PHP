<?php
include_once("models/forum_model.php");
include_once("entities/forum_entity.php");

class ForumCtrl extends Ctrl
{


    public function home()
    {

        /* Utilisation de la classe model */
        $objForumModel    = new ForumModel;
        $arrForums        = $objForumModel->findAll();

        // Parcourir les articles pour créer des objets
        $arrForumsToDisplay    = array();
        foreach ($arrForums as $arrDetailForum) {
            $objForum = new Forum();
            $objForum->hydrate($arrDetailForum);
            $arrForumsToDisplay[] = $objForum;
        }

        $this->_arrData["strPage"]     = "forum";
        $this->_arrData["strTitle"] = "Forum";
        $this->_arrData["strDesc"]     = "Forum de discussion";
        $this->_arrData["arrForumsToDisplay"] = $arrForumsToDisplay;

        $this->afficheTpl("forum");
    }
    
}
