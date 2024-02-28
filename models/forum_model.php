<?php
	/***
	* Récupérer les topics dans la BDD 
	* @author Groupe1
	*/
	include_once("connect.php");

	class ForumModel extends Model {

		/**
		* Constructeur de la classe 
		*/
		public function __construct() {
			parent::__construct();
		}

		/**
		* Méthode de récupération de tous les topics
		* @return Tableau des topics
		*/
		public function findAll(int $intLimit = 0, $arrSearch = array()) {
			
			$strQuery     = "	SELECT topic_id, topic_title, topic_content, topic_date, topic_code, 
									   user_pseudo AS 'topic_creator'
								FROM topic
								INNER JOIN users ON topic_user_id = user_id";
			$strWhere	= " WHERE ";

			$strKeywords = $arrSearch['keywords'] ?? "";
			if ($strKeywords != '') {
				$strQuery 	.= $strWhere . " (topic_title LIKE :keywords
							OR topic_content LIKE :keywords) ";
			}

			// Tri par ordre décroissant
			$strQuery 	.= " ORDER BY topic_date DESC";

			if ($intLimit > 0){
				$strQuery 	.= " LIMIT :limit";
			}

			// On prépare la requête
			$rqPrep	= $this->_db->prepare($strQuery);

			// On complète les variables de la requête, selon le contexte
			if ($strKeywords != '') {$rqPrep->bindValue(":keywords", "%" . $strKeywords . "%", PDO::PARAM_STR);}
			if ($intLimit > 0) {$rqPrep->bindValue(":limit", $intLimit, PDO::PARAM_INT);}
			$rqPrep->execute();
			return $rqPrep->fetchAll();
		}

		/**
		* Méthode d'insertion d'un topic en BDD
		* param object $objForum Objet forum
		*/
		public function insert(object $objForum) {
			$strQuery	= "	INSERT INTO topic (topic_title, topic_content, topic_date, topic_code , topic_user_id )
								VALUES (:title, :content, NOW(), 1, 1);
								";
			// On prépare la requête
			$rqPrep	= $this->_db->prepare($strQuery);
			$rqPrep->bindValue(":title", $objForum->getTitle(), PDO::PARAM_STR);
			$rqPrep->bindValue(":content", $objForum->getContent(), PDO::PARAM_STR);

			return $rqPrep->execute();
		}
		
		/**
		* Méthode permettant de récupérer un topic en fonction de son id
		* @param int $id Identifiant du topic à récupérer
		* @return array Le détail du topic
		*/		
		public function get(int $id) : array|false{
			$strQuery 	= "SELECT topic_id, topic_title, topic_content, topic_date, topic_code, 
			user_pseudo AS 'topic_creator'
			FROM topic
			INNER JOIN users ON topic_user_id = user_id
							WHERE topic_id = ".$id;
			return $this->_db->query($strQuery)->fetch();			
		}
	}
