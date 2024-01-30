<?php
class PageCtrl extends Ctrl
{

    public function raconte()
    {
        $this->_arrData["strPage"]     = "about";
        $this->_arrData["strTitle"] = "A propos";
        $this->_arrData["strDesc"]     = "Page de contenu";
        $this->afficheTpl("about");
    }
    public function mentions()
    {
        $this->_arrData["strPage"]     = "mentions";
        $this->_arrData["strTitle"] = "Mentions légales";
        $this->_arrData["strDesc"]     = "Page de contenu";
        $this->afficheTpl("mentions");
    }
    public function contact()
    {
        $this->_arrData["strPage"]     = "contact";
        $this->_arrData["strTitle"] = "Contact";
        $this->_arrData["strDesc"]     = "Page de contact";
        $this->afficheTpl("contact");
    }
}
