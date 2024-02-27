<?php
	/***
	* Récupérer les articles dans la BDD 
	* @author Gauthier
	*/
	include_once("connect.php");

	class UtripModel extends Model {

		/**
		* Constructeur de la classe 
		*/
		public function __construct() {
			parent::__construct();
		}

		/**
		* Méthode de récupération de tous les articles avec recherche 
		* @return Tableau des articles
		*/
		public function findAll(int $intLimit = 0, $arrSearch = array()) {

			$strQuery     = "SELECT utrip_id , utrip_name , utrip_description , utrip_budget , 
							utrip_date , user_pseudo AS 'utrip_creator' , img_link AS 'utrip_img' , cities_name
							AS 'utrip_city' , cat_lib AS 'utrip_cat' , regions_name AS 'utrip_cont' , cat_id AS 'utrip_catId' , cities_id AS 'utrip_cityId'
									FROM utrip 
									LEFT OUTER JOIN image ON img_utrip_id = utrip_id
									LEFT OUTER JOIN users ON user_id = utrip_user_id
									LEFT OUTER JOIN cities ON cities_id = utrip_city
									LEFT OUTER JOIN countries ON cities_country_id = countries_id
									LEFT OUTER JOIN regions ON countries_region_id = regions_id
									LEFT OUTER JOIN categorie ON utrip_cat = cat_id
									LEFT OUTER JOIN comments ON com_utrip_id = utrip_id
									LEFT OUTER JOIN likes ON utrip_id = like_utrip_id";
			$strWhere	= " WHERE ";

			// Recherche par mot clé
			$strKeywords = $arrSearch['keywords'] ?? "";
			if ($strKeywords != '') {
				$strQuery.=$strWhere."(utrip_name LIKE :keywords
							OR utrip_description LIKE :keywords) ";
				$strWhere	= " AND ";
			}

			// Recherche par date exacte
			$strDate		= $arrSearch['date'] ?? "";
			if ($strDate != '') {
				$strQuery.=$strWhere. " utrip_date = :date ";
				$strWhere	= " AND ";
			}
			// Recherche par continent
			$strCont		= $arrSearch['cont'] ?? "";
			if ($strCont != '') {
				$strQuery 	.= $strWhere." regions_name = :cont";
				$strWhere	= " AND ";
			}

			// Recherche par catégorie
			$strCat		= $arrSearch['cat'] ?? "";
			if ($strCat != '') {
				$strQuery 	.= $strWhere."cat_lib = :cat ";
				$strWhere	= " AND ";
			}

			// Tri par ordre décroissant
			$strQuery 	.= " ORDER BY utrip_date DESC ";
			if ($intLimit > 0) {
				$strQuery 	.= "LIMIT :limit";
			}

			$rqPrep	= $this->_db->prepare($strQuery);
			if ($strKeywords != '') {$rqPrep->bindValue(":keywords", "%" .$strKeywords. "%", PDO::PARAM_STR);}
			if ($strDate != '') {$rqPrep->bindValue(":date", $strDate, PDO::PARAM_STR);}
			if ($strCat != '') {$rqPrep->bindValue(":cat", $strCat, PDO::PARAM_STR);}
			if ($strCont != '') {$rqPrep->bindValue(":cont", $strCont, PDO::PARAM_STR);}
			if ($intLimit > 0) {$rqPrep->bindValue(":limit", $intLimit, PDO::PARAM_INT);}

			$rqPrep->execute();
			return $rqPrep->fetchAll();
		}

		/**
		* Méthode de récupération de toutes les catégories
		* @return Tableau des catégories
		*/
		public function findCat() {


				// faire une autre fonction pour les villes





			$strQuery 	= "SELECT cat_lib AS 'utrip_cat' , cat_id AS 'utrip_catId' , cities_id AS 'utrip_cityId'
							FROM categorie
							LEFT OUTER JOIN utrip ON utrip_cat = cat_id
							INNER JOIN cities ON utrip_city = cities_id";

			return $this->_db->query($strQuery)->fetchAll();
		}

		/**
		 * Méthode permettant d'ajouter un article en BDD 
		 * @param $objUtrip object Utrip à insérer
		 */
		public function insert(object $objUtrip) {

			$strQuery	= "	INSERT INTO utrip (utrip_name, utrip_description,  utrip_budget, utrip_date , utrip_user_id , utrip_city , utrip_cat )
								VALUES (:titre, :description, :budget , NOW(), 1, 1 , 1);
								";
			// On prépare la requête
			$rqPrep	= $this->_db->prepare($strQuery);
			$rqPrep->bindValue(":titre", $objUtrip->getName(), PDO::PARAM_STR);
			$rqPrep->bindValue(":budget", $objUtrip->getBudget(), PDO::PARAM_STR);
			$rqPrep->bindValue(":description", $objUtrip->getDescription(), PDO::PARAM_STR);
			// $rqPrep->bindValue(":city", $objUtrip->getCity(), PDO::PARAM_STR);
			// $rqPrep->bindValue(":cat", $objUtrip->getCat(), PDO::PARAM_STR);

			$rqPrep->execute();

			// Récupérer l'ID de l'article inséré
			$lastId = $this->_db->lastInsertId();
			return $lastId; // Retourner l'ID pour une utilisation ultérieure
		}
		
		/**
		 * Méthode permettant d'ajouter les images d'un article en BDD 
		 * @param $objUtrip object Utrip et LastId à insérer
		 */
		public function insertImg(object $objUtrip, $lastId) {
			
			$strQuery	= "	INSERT INTO image ( img_link , img_utrip_id , img_description, img_name )
								VALUES ( :image, :imgUtripId, '' , '');
								";
			// On prépare la requête
			$rqPrep	= $this->_db->prepare($strQuery);
			$rqPrep->bindValue(":image", $objUtrip->getImg(), PDO::PARAM_STR);
			$rqPrep->bindValue(":imgUtripId", $lastId, PDO::PARAM_INT);

			return $rqPrep->execute();
		}
		
		/**
		* Méthode permettant de récupérer un article en fonction de son id
		* @param int $id Identifiant de l'article à récupérer
		* @return array Le détail de l'Article
		*/		
		public function get(int $id) : array|false{
			$strQuery 	= "SELECT utrip_id , utrip_name , utrip_description , utrip_budget , 
							utrip_date , user_pseudo AS 'utrip_creator' , img_link AS 'utrip_img' , cities_name
							AS 'utrip_city' , cat_lib AS 'utrip_cat' , regions_name AS 'utrip_cont' , countries_name AS 'utrip_country'
									FROM utrip 
									LEFT OUTER JOIN image ON img_utrip_id = utrip_id
									LEFT OUTER JOIN users ON user_id = utrip_user_id
									LEFT OUTER JOIN cities ON cities_id = utrip_city
									LEFT OUTER JOIN countries ON cities_country_id = countries_id
									LEFT OUTER JOIN regions ON countries_region_id = regions_id
									LEFT OUTER JOIN categorie ON utrip_cat = cat_id
									LEFT OUTER JOIN comments ON com_utrip_id = utrip_id
									LEFT OUTER JOIN likes ON utrip_id = like_utrip_id
							WHERE utrip_id = ".$id;
			return $this->_db->query($strQuery)->fetch();			
		}
	}
