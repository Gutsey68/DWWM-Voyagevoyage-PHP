<?php

/** 
 * Controller des utilisateurs
 * @author Gauthier
 */
include_once("models/user_model.php");
include_once("entities/user_entity.php"); // inclure la classe

class UserCtrl extends Ctrl
{

    public function create_account(){
        $arrErrors = array();
        //var_dump($_POST);
        $objUser = new User();
        if (count($_POST) > 0){
            $objUser->hydrate($_POST);
            // Vérification des données de l'utilisateur

            if ($objUser->getName() == ""){
                $arrErrors['name'] = "Le nom est obligatoire";
            }elseif (strlen($objUser->getName()) < 2){
                $arrErrors['name'] = "Le nom est trop court";
            }
            
            if ($objUser->getFirstname() == ""){
                $arrErrors['firstname'] = "Le prénom est obligatoire";
            }
            
            if ($objUser->getPseudo() == ""){
                $arrErrors['pseudo'] = "Le pseudo est obligatoire";
            }elseif (strlen($objUser->getPseudo()) < 4){
                $arrErrors['pseudo'] = "Le pseudo est trop court";
            }
            
            
            if ($objUser->getEmail() == ""){
                $arrErrors['mail'] = "Le mail est obligatoire";
            }elseif (!filter_var($objUser->getEmail(), FILTER_VALIDATE_EMAIL)) {
                $arrErrors['mail'] = "Le mail n'est pas correct";
            }else{
                $objUserModel	= new UserModel;
                // Test si le mail existe déjà
                $boolMailExists	= $objUserModel->verifMail($objUser->getEmail());
                if ($boolMailExists === true){
                    $arrErrors['mail'] = "Le mail est déjà utilisé";
                }
            }
            // Vérifications du mot de passe
            $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{16,}$/"; 
            
            if ($objUser->getPassword() == ""){
                $arrErrors['pwd'] = "Le mot de passe est obligatoire";
            }elseif(!preg_match($password_regex, $objUser->getPassword())){
                $arrErrors['pwd'] = "Le mot de passe doit faire minimum 16 caractères 
                                    et contenir une minuscule, une majuscule, un chiffre et un caractère";
            }elseif ($objUser->getPassword() != $_POST['passwd_confirm']){
                $arrErrors['pwd'] = "Le mot de passe et sa confirmation doivent être identiques";
            }
            
            if(count($arrErrors) == 0){
                //$objUser->setPwd(password_hash($objUser->getPwd(), PASSWORD_DEFAULT));
                if ($objUserModel->insert($objUser)){
                    header("Location:index.php");
                }else{
                    $arrErrors[] = "L'insertion s'est mal passée";
                }
            }
            
        }else{ // Formulaire non envoyé
            $objUser->setName("");
            $objUser->setFirstname("");
            $objUser->setPseudo("");
            $objUser->setEmail("");
        }
        
        // Afficher
        $this->_arrData["strPage"] 		= "create_account";
        $this->_arrData["strTitle"] 	= "Créer un compte";
        $this->_arrData["strDesc"] 		= "Page permettant de créer un compte";
        $this->_arrData["arrErrors"] 	= $arrErrors;
        $this->_arrData["objUser"]		= $objUser;
        $this->afficheTpl("create_account");
    }

    public function login()
    {
        $arrErrors = array();

        /* 2. Rechercher l'utilisateur dans la BDD */
        $strEmail     = $_POST['email'] ?? "";
        $strPwd     = $_POST['password'] ?? "";

        $objUserModel    = new UserModel;
        $arrUser = $objUserModel->searchUser($strEmail, $strPwd);

        if ($arrUser === false) {
            /* 3. Si pas ok => Afficher un message d'erreur */
            $arrErrors[] = "Erreur de connexion";
        } else {
            /* 3. Si ok => Session */
            $_SESSION['user'] = $arrUser;
        }
        /* 1. Afficher le formulaire */
        $this->_arrData["strPage"]     = "login";
        $this->_arrData["strTitle"] = "Se connecter";
        $this->_arrData["strDesc"]     = "Page permettant de se connecter";
        $this->_arrData["arrErrors"] = $arrErrors;
        $this->afficheTpl("login");
    }

        /**
    * Méthode permettant de se déconnecter
    */
    public function logout(){
        session_destroy();
        header("Location:http://localhost/blog/index.php");
    }
}
