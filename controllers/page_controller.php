<?php
/** 
 * Controller des pages
 * @author Gauthier
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require'libs/PHPMailer/src/Exception.php';
require'libs/PHPMailer/src/PHPMailer.php';
require'libs/PHPMailer/src/SMTP.php';


include_once("models/contact_model.php");
include_once("entities/contact_entity.php");

    class PageCtrl extends Ctrl {

		/**
		* Méthode qui permet d'afficher la page about
		*/
        public function about() {

            $this->_arrData["strPage"]     = "about";
            $this->_arrData["strTitle"] = "A propos";
            $this->_arrData["strDesc"]     = "Page de contenu";
            $this->afficheTpl("about");
        }

		/**
		* Méthode qui permet d'afficher la page de mentions légales
		*/

        public function mentions() {

            $this->_arrData["strPage"]     = "mentions";
            $this->_arrData["strTitle"] = "Mentions légales";
            $this->_arrData["strDesc"]     = "Page de contenu";
            $this->afficheTpl("mentions");
        }

		/**
		* Méthode qui permet d'envoyer un mail de contact
		*/
        public function contact() {

            $arrErrors = array();
            $objContact = new Contact();

            if (count($_POST) > 0){
                $objContact->hydrate($_POST);
                $arrErrors = $this->_verifInfos($objContact);

                if(count($arrErrors) == 0){
					$objContactModel	= new ContactModel;

					if ($objContactModel->insert($objContact)){
						header("Location:index.php?ctrl=utrip&action=home");
					}else{
						$arrErrors[] = "Le mail n'a pas pu être envoyé";
					}
				}
            }else{ // Formulaire non envoyé
                $objContact->setMail("");
                $objContact->setName("");
                $objContact->setTitle("");
                $objContact->setContent("");
            }

            if(isset($_POST['envoyer'])){
                var_dump($objContact);
                $name = $_POST['name'];
                $mail = $_POST['mail'];
                $subject = $_POST['title'];
                $body = $_POST['content'];
                $email = $mail;
                $retour = "https://www.voyagevoyage.dwwm.site/";

                $mail = new PHPMailer();
                $mail->CharSet = "UTF-8";
                $mail->IsSMTP();
                $mail->Mailer = "smtp";
    
                $mail->SMTPDebug= 0;
                $mail->SMTPAuth= TRUE;
                $mail->SMTPSecure= "tls";
                $mail->Port = 587;
                $mail->Host = "smtp.gmail.com";
                $mail->Username= 'voyagevoyageprojetcontact@gmail.com';
                $mail->Password= 'ylaf ecqc gjbc seja';
    
                $mail->IsHTML(true);
                $mail->setFrom('voyagevoyageprojetcontact@gmail.com', "Contact VoyageVoyage");
                $mail->addAddress('voyagevoyageprojet@gmail.com', "L'équipe Voyage Voyage");
                $mail->Subject= $subject;
                $mail->Body = '
                    <h1>Nouveau formulaire de contact du site <a href="'.$retour.'">Voyage Voyage</a></h1>
                    <h2>Expediteur : '.$name.'</h2>
                    <h2>Mail de l\'expéditeur : '.$email.'</h2>
                    <h2>Objet du message : '.$subject.'</h2>
                    <h2>Message de l\'expéditeur :</h2>
                    <p style="font-size:18px;">'.$body.'</p>
                ';
                //$mail->addAttachment('test.txt');
                if (!$mail->send()) {
                echo'Erreur de Mailer : ' . $mail->ErrorInfo;
                } else{
                //echo'Le message a été envoyé.';
                }
            }

            $this->_arrData["strPage"]     = "contact";
            $this->_arrData["strTitle"]    = "Contact";
            $this->_arrData["strDesc"]     = "Page de contact";

            $this->_arrData["arrErrors"] 	= $arrErrors;
            $this->_arrData["objContact"]   = $objContact;

            $this->afficheTpl("contact");
        }

		/**
		* Méthode qui permet d'afficher la page du plan du site
		*/
        public function plan() {
            
            $this->_arrData["strPage"]     = "plan";
            $this->_arrData["strTitle"] = "Plan du site";
            $this->_arrData["strDesc"]     = "Page du plan du site";
            $this->afficheTpl("plan");
        }
        
		/**
		* Méthode privée de vérification des informations de l'utilisateur
		* @param object $objContact Objet à vérifier
		* @return array les erreurs générées
		*/
		private function _verifInfos(object $objContact) {
			$arrErrors = array();

			if ($objContact->getName() == ""){
				$arrErrors['name'] = "Le nom est obligatoire";
			}
			if ($objContact->getMail() == ""){
				$arrErrors['mail'] = "Le mail est obligatoire";
			}
			if ($objContact->getTitle() == ""){
				$arrErrors['title'] = "L'object est obligatoire";
			}
			if ($objContact->getContent() == ""){
				$arrErrors['content'] = "Le message est vide";
			}
				$objContactModel	= new ContactModel;
			
			return $arrErrors;
		}

        /**
		* Méthode qui permet d'afficher la page du plan du site
		*/
        public function manage() {
            
            $this->_arrData["strPage"]     = "manage";
            $this->_arrData["strTitle"] = "Modération";
            $this->_arrData["strDesc"]     = "Page de modération";
            $this->afficheTpl("manage");
        }
        
    }
