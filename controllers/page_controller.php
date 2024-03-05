<?php
    /**
     * Contrôleur des pages statiques et de la fonctionnalité de contact.
     * Utilise PHPMailer pour l'envoi d'emails.
     * @author Gauthier
     */

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    // Inclusion des fichiers PHPMailer
    require 'libs/PHPMailer/src/Exception.php';
    require 'libs/PHPMailer/src/PHPMailer.php';
    require 'libs/PHPMailer/src/SMTP.php';

    // Inclusion des modèles et des entités
    include_once("models/contact_model.php");
    include_once("entities/contact_entity.php");

    class PageCtrl extends Ctrl {

        /**
         * Affiche la page d'aide.
         */
        public function aide_site() {

            $this->_arrData = [
                "strPage" => "aide_site"
            ];
            $this->afficheTpl("aide_site");
        }

        /**
         * Affiche la page À propos.
         */
        public function about() {

            $this->_arrData = ["strPage" => "about"];

            $this->afficheTpl("about");
        }

        /**
         * Affiche les mentions légales.
         */
        public function mentions() {
            $this->_arrData = ["strPage" => "mentions"];

            $this->afficheTpl("mentions");
        }

        /**
         * Gère la soumission du formulaire de contact et envoie un email.
         */
        public function contact() {

            $arrErrors = [];
            $objContact = new Contact();

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $objContact->hydrate($_POST);
                $arrErrors = $this->_verifInfos($objContact);

                if (empty($arrErrors) && isset($_POST['envoyer'])) {
                    $this->_sendEmail($objContact);
                }
            } else {
                // Initialisation pour un affichage propre du formulaire
                $objContact->setMail("");
                $objContact->setName("");
                $objContact->setTitle("");
                $objContact->setContent("");
            }

            $this->_arrData = [
                "strPage" => "contact",
                "arrErrors" => $arrErrors,
                "objContact" => $objContact
            ];
            $this->afficheTpl("contact");
        }

        /**
         * Valide les informations du formulaire de contact.
         * @param Contact $objContact L'objet Contact contenant les données du formulaire.
         * @return array Tableau des erreurs de validation.
         */
        private function _verifInfos(Contact $objContact) {
            $arrErrors = [];

            if (empty($objContact->getName())) {
                $arrErrors['name'] = "Le nom est obligatoire";
            }
            if (empty($objContact->getMail())) {
                $arrErrors['mail'] = "L'email est obligatoire";
            }
            if (empty($objContact->getTitle())) {
                $arrErrors['title'] = "L'objet est obligatoire";
            }
            if (empty($objContact->getContent())) {
                $arrErrors['content'] = "Le message ne peut pas être vide";
            }

            return $arrErrors;
        }

        /**
         * Envoie un email en utilisant PHPMailer.
         * @param Contact $objContact Les données de contact à envoyer.
         */
        private function _sendEmail(Contact $objContact) {

            // Configuration et envoi de l'email avec PHPMailer, passage `true` permet de capturer les exceptions
            $mail = new PHPMailer(true);

            try {
                // Configuration de PHPMailer pour l'envoi
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'votreemail@gmail.com';
                $mail->Password = 'votrepassword';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Contenu de l'email
                $mail->setFrom('votreemail@gmail.com', 'Nom de l\'expéditeur');
                $mail->addAddress('destinationemail@gmail.com', 'Nom du destinataire');
                $mail->Subject = $objContact->getTitle();
                $mail->Body    = $objContact->getContent();

                $mail->send();

            } catch (Exception $e) {
            }
        }

        /**
         * Affiche le plan du site.
         */
        public function plan() {
            $this->_arrData = [ "strPage" => "plan"];
            $this->afficheTpl("plan");
        }

        /**
         * Affiche la page de gestion/modération.
         */
        public function manage() {
            $this->_arrData = ["strPage" => "manage"];
            $this->afficheTpl("manage");
        }
    }
