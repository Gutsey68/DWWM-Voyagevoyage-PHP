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
		 * Méthode de récupération de tous les articles avec options de recherche.
		 *
		 * @param int $intLimit Limite de résultats à récupérer.
		 * @param array $arrSearch Tableau contenant les options de recherche.
		 * @return array Tableau des articles correspondant aux critères de recherche.
		 */
		public function findAll(int $intLimit = 0, $arrSearch = array()) {

			$strQuery     = "SELECT utrip.utrip_id, utrip_name, utrip_description, utrip_budget, cities_id, cities_id AS 'utrip_cityId',
							utrip_date, user_pseudo AS 'utrip_creator', user_id AS 'utrip_creatorId',
							cities_name AS 'utrip_city', cat_lib AS 'utrip_cat', regions_name AS 'utrip_cont', cat_id AS 'utrip_catId' ,
									( SELECT img_link FROM image WHERE img_utrip_id = utrip.utrip_id ORDER BY 1 LIMIT 1
									) AS 'utrip_img' , 
										(SELECT COUNT(*) FROM likes WHERE like_utrip_id = utrip.utrip_id) AS utrip_like
											FROM utrip 
											RIGHT OUTER JOIN image ON img_utrip_id = utrip_id
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
							OR utrip_description LIKE :keywords
							OR cities_name LIKE :keywords) ";
				$strWhere	= " AND ";
			}
			// Recherche par budget
			$strStartBudget	= $arrSearch['startbudget']??"";
			$strEndBudget		= $arrSearch['endbudget']??"";
			if ($strStartBudget != '' && $strEndBudget != '' ){
				$strQuery 	.= $strWhere." utrip_budget BETWEEN :begin AND :end ";
				$strWhere	= " AND ";
			}

			// Recherche par période
			$strStartDate	= $arrSearch['startdate']??"";
			$strEndDate		= $arrSearch['enddate']??"";
			if ($strStartDate != '' && $strEndDate != '' ){
				$strQuery 	.= $strWhere." utrip_date BETWEEN :startdate AND :enddate ";
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

			// afficher seulement les articles validés 
			$strQuery	.= $strWhere . "utrip_valid = 1";

			// Tri par ordre décroissant ou par nombre de "j'aime"
			$intSorting      = $arrSearch['sorting']??0;
			if ($intSorting == 0) {
				$strQuery 	.= " GROUP BY utrip.utrip_id ORDER BY utrip_date DESC " ;
			}
			if ($intSorting == 1) {
				$strQuery 	.= " GROUP BY utrip.utrip_id ORDER BY utrip_like DESC" ;
			}
			if ($intLimit > 0) {
				$strQuery 	.= " LIMIT :limit";
			}

			$rqPrep	= $this->_db->prepare($strQuery);
			if ($strKeywords != '') {$rqPrep->bindValue(":keywords", "%" .$strKeywords. "%", PDO::PARAM_STR);}
			if ($strStartBudget != '' && $strEndBudget != '' ){
				$rqPrep->bindValue(":begin", $strStartBudget, PDO::PARAM_STR);
				$rqPrep->bindValue(":end", $strEndBudget, PDO::PARAM_STR);
			}		
			if ($strStartDate != '' && $strEndDate != '' ){
				$rqPrep->bindValue(":startdate", $strStartDate, PDO::PARAM_STR);
				$rqPrep->bindValue(":enddate", $strEndDate, PDO::PARAM_STR);
			}		
			if ($strCat != '') {$rqPrep->bindValue(":cat", $strCat, PDO::PARAM_STR);}
			if ($strCont != '') {$rqPrep->bindValue(":cont", $strCont, PDO::PARAM_STR);}
			if ($intLimit > 0) {$rqPrep->bindValue(":limit", $intLimit, PDO::PARAM_INT);}

			$rqPrep->execute();

			return $rqPrep->fetchAll();
		}

		/**
		 * Méthode permettant de récupérer toutes les catégories disponibles.
		 *
		 * @return array Tableau contenant les informations sur les catégories disponibles.
		 */
		public function findCat() {

			$strQuery 	= "SELECT cat_lib AS 'utrip_cat' , cat_id AS 'utrip_catId'
							FROM categorie";

			return $this->_db->query($strQuery)->fetchAll();
		}

		/**
		 * Méthode permettant de récupérer toutes les villes disponibles.
		 *
		 * @return array Tableau contenant les informations sur les villes disponibles.
		 */
		public function findCity() {

			$strQuery 	= "SELECT cities_id AS 'utrip_cityId' , cities_name AS 'utrip_city'
							FROM cities";

			return $this->_db->query($strQuery)->fetchAll();
		}

		/**
		 * Méthode permettant de récupérer les images associées à un article.
		 *
		 * @param int $id L'identifiant de l'article.
		 * @return array Tableau contenant les liens des images associées à l'article.
		 */
		public function findImgs($id) {

			$strQuery 	= "SELECT img_link AS 'utrip_img'
							FROM image
							INNER JOIN utrip ON utrip_id = img_utrip_id
							WHERE utrip_id = ".$id;

			return $this->_db->query($strQuery)->fetchAll();
		}

		/**
		 * Méthode d'insertion d'un nouvel utrip en BDD.
		 *
		 * @param object $objUtrip Objet Utrip à insérer
		 * @return int|null ID de l'utrip inséré, null en cas d'échec
		 */
		public function insert(object $objUtrip) {

			$strQuery	= "	INSERT INTO utrip (utrip_name, utrip_description,  utrip_budget, utrip_date , utrip_user_id, utrip_city , utrip_cat )
								VALUES (:titre, :description, :budget , NOW(), :id, :city , :cat);
								";

			$rqPrep	= $this->_db->prepare($strQuery);
			$rqPrep->bindValue(":titre", $objUtrip->getName(), PDO::PARAM_STR);
			$rqPrep->bindValue(":budget", $objUtrip->getBudget(), PDO::PARAM_STR);
			$rqPrep->bindValue(":description", $objUtrip->getDescription(), PDO::PARAM_STR);
			$rqPrep->bindValue(":city", $objUtrip->getCityId(), PDO::PARAM_INT);
			$rqPrep->bindValue(":cat", $objUtrip->getCat(), PDO::PARAM_INT);
			$rqPrep->bindValue(":id", $_SESSION['user']['user_id'], PDO::PARAM_INT);

			$rqPrep->execute();

			$lastId = $this->_db->lastInsertId();
			return $lastId; 
		}
		
		/**
		 * Méthode permettant d'ajouter les images d'un utrip en BDD.
		 *
		 * @param string $imageName Nom de l'image à insérer.
		 * @param int $utripId Identifiant de l'utrip auquel l'image est associée.
		 * @return bool Renvoie true si l'insertion a réussi, false sinon.
		 */
		public function insertImg(string $imageName, int $utripId): bool {

			$strQuery = "INSERT INTO image (img_link, img_utrip_id) VALUES (:image, :imgUtripId);";
			
			$rqPrep = $this->_db->prepare($strQuery);

			$rqPrep->bindValue(":image", $imageName, PDO::PARAM_STR);
			$rqPrep->bindValue(":imgUtripId", $utripId, PDO::PARAM_INT);

			return $rqPrep->execute();
		}
		
		/**
		* Méthode permettant de récupérer un utrip en fonction de son id
		*
		* @param int $id Identifiant de l'utrip à récupérer
		* @return array|false Le détail de l'Utrip
		*/    
		public function get(int $id) : array|false{

			$strQuery 	= "SELECT utrip_id , utrip_name , utrip_description , utrip_budget , user_id AS 'utrip_creatorId' , 
							utrip_date , user_pseudo AS 'utrip_creator' , img_link AS 'utrip_img' , cities_name
							AS 'utrip_city' , cat_lib AS 'utrip_cat' , regions_name AS 'utrip_cont' , countries_name AS 'utrip_country' , 
							(SELECT COUNT(*) FROM likes WHERE like_utrip_id = utrip.utrip_id) AS utrip_like
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

		
		/**
		* Méthode permettant de modifier un utrip en BDD 
		*
		* @param object $objUtrip Objet Utrip à modifier
		* @return bool Renvoie true si la modification a réussi, false sinon.
		*/
		public function update(object $objUtrip){

			$strQuery	= "	UPDATE utrip
							SET utrip_name = :name, 
								utrip_description = :description, 
								utrip_budget = :budget,
								utrip_cat = :cat
							WHERE utrip_id = :id ";
							
			$rqPrep	= $this->_db->prepare($strQuery);

			$rqPrep->bindValue(":name", $objUtrip->getName(), PDO::PARAM_STR);
			$rqPrep->bindValue(":description", $objUtrip->getDescription(), PDO::PARAM_STR);
			$rqPrep->bindValue(":budget", $objUtrip->getBudget(), PDO::PARAM_STR);
			$rqPrep->bindValue(":cat", $objUtrip->getCatId(), PDO::PARAM_INT);
			$rqPrep->bindValue(":id", $objUtrip->getId(), PDO::PARAM_STR);
			
			return $rqPrep->execute();
		}

		/**
		* Méthode d'administration de la gestion des utrips
		*
		* @return array Liste des utrips trouvés
		*/
		public function findList(){

			$strQuery 	= "SELECT utrip.utrip_id, utrip_name, utrip_description, utrip_budget, utrip_valid,
								(
									SELECT img_link FROM image WHERE img_utrip_id = utrip.utrip_id ORDER BY img_id LIMIT 1
								) AS 'utrip_img'
								FROM utrip ";
							
			if (!in_array($_SESSION['user']['user_role'], array('admin', 'modo'))){
				$strQuery 	.= " WHERE utrip_user_id = ".$_SESSION['user']['user_id'];
			}

			$strQuery 	.= " ORDER BY utrip_date DESC;";

			return $this->_db->query($strQuery)->fetchAll();			
		}
		
		/**
		* Methode permettant de mettre à jour l'utrip avec les informations de modération
		*
		* @param object $objUtrip Objet utrip
		* @return bool Renvoie true si la mise à jour a réussi, false sinon.
		*/
		public function moderate($objUtrip){
			$strQuery	= "	UPDATE utrip

							SET utrip_valid = :valid, 
								utrip_comment = :comment, 
								utrip_modo = :modo
							WHERE utrip_id = :id";
							
			$rqPrep	= $this->_db->prepare($strQuery);

			$rqPrep->bindValue(":valid", $objUtrip->getValid(), PDO::PARAM_INT);
			$rqPrep->bindValue(":comment", $objUtrip->getComment(), PDO::PARAM_STR);
			$rqPrep->bindValue(":modo", $_SESSION['user']['user_id'], PDO::PARAM_INT);
			$rqPrep->bindValue(":id", $objUtrip->getId(), PDO::PARAM_INT);
			
			return $rqPrep->execute();			
		}
		
		/**
		 * Supprime l'utrip en BDD en s'assurant que toutes les dépendances sont également supprimées.
		 *
		 * @param int $id Identifiant de l'utrip à supprimer.
		 * @return bool Renvoie true si la suppression a réussi, false sinon.
		 */
		public function delete(int $id) {

			try {
				
				$this->_db->beginTransaction();

				$rqPrep = $this->_db->prepare("DELETE FROM comments WHERE com_utrip_id = :utripId");
				$rqPrep->bindValue(":utripId", $id, PDO::PARAM_INT);
				$rqPrep->execute();

				$rqPrep = $this->_db->prepare("DELETE FROM image WHERE img_utrip_id = :utripId");
				$rqPrep->bindValue(":utripId", $id, PDO::PARAM_INT);
				$rqPrep->execute();

				$rqPrep = $this->_db->prepare("DELETE FROM likes WHERE like_utrip_id = :utripId");
				$rqPrep->bindValue(":utripId", $id, PDO::PARAM_INT);
				$rqPrep->execute();

				$rqPrep = $this->_db->prepare("DELETE FROM utrip WHERE utrip_id = :utripId");
				$rqPrep->bindValue(":utripId", $id, PDO::PARAM_INT);
				$rqPrep->execute();

				$this->_db->commit();

				return true;
			} catch (PDOException $e) {
				return false;
			}
		}

		/**
		 * Méthode de récupération de l'Id d'une ville
		 *
		 * @param string $strCity Nom de la ville
		 * @return array Tableau contenant l'ID de la ville
		 */
		public function getCityId($strCity) {

			$strQuery = "SELECT cities_id FROM cities WHERE cities_name = :city";

			$rqPrep = $this->_db->prepare($strQuery);

			$rqPrep->bindValue(":city", $strCity, PDO::PARAM_STR);

			return $rqPrep->execute();
		}

		/** 
		 * Méthode de récupération du nom de la ville
		 *
		 * @param string $cityName Nom de la ville
		 * @return int|null ID de la ville si trouvé, sinon null.
		 */
		public function getCityIdByName($cityName) {
			
			$strQuery = "SELECT cities_id FROM cities WHERE cities_name LIKE :cityName LIMIT 1";

			$rqPrep = $this->_db->prepare($strQuery);

			$rqPrep->bindValue(":cityName", '%' . $cityName . '%', PDO::PARAM_STR);

			$rqPrep->execute();

			$result = $rqPrep->fetch(PDO::FETCH_ASSOC);

			return $result ? (int)$result['cities_id'] : null;
		}
		
		/**
		* Méthode permettant de récupérer les images d'un utrip.
		*
		* @param int $id Identifiant de l'utrip
		* @return array Tableau d'images de l'utrip.
		*/
		public function getImgs(int $id) {

			$strQuery = "SELECT DISTINCT img_link, img_id
					FROM utrip
					INNER JOIN image ON utrip_id = img_utrip_id
					WHERE utrip_id = ".$id;

			$rqPrep = $this->_db->prepare($strQuery);

			$rqPrep->execute();

			$arrUtripImgs = $rqPrep->fetchAll();
		
			return $arrUtripImgs;
		}
		
		/**
		* Méthode permettant de récupérer les commentaires d'un utrip.
		*
		* @param int $id Identifiant de l'utrip
		* @return array|false Tableau de commentaires de l'utrip ou false en cas d'échec.
		*/    	
		public function getCom(int $id) : array|false{

			$strQuery 	= " SELECT com_id, com_content , com_date , com_image, user_pseudo AS 'com_creator', com_user_id AS 'com_creatorId' , com_utrip_id AS 'com_utripId' FROM comments
							INNER JOIN users ON com_user_id = user_id
							WHERE com_utrip_id = '".$id."' ORDER BY com_date";

			return $this->_db->query($strQuery)->fetchAll();			
		}

		
		/**
		* Méthode d'insertion d'un commentaire en BDD
		*
		* @param object $objComment Objet Commentaire à insérer
		* @return bool Renvoie true si l'insertion a réussi, false sinon.
		*/
		public function insertCom(object $objComment) {

			$strQuery	= "	INSERT INTO comments (com_content, com_date, com_user_id , com_utrip_id )
								VALUES (:content, NOW(), :user , :utrip);
								";

			$rqPrep	= $this->_db->prepare($strQuery);

			$rqPrep->bindValue(":content", $objComment->getContent(), PDO::PARAM_STR);
			$rqPrep->bindValue(":user", $_SESSION['user']['user_id'], PDO::PARAM_INT);
			$rqPrep->bindValue(":utrip", $_GET['id'], PDO::PARAM_INT);

			return $rqPrep->execute();
		}


		/**
		* Méthode permettant de récupérer les likes d'un utrip.
		*
		* @param int $id Identifiant de l'utrip
		* @return array|false Tableau de likes de l'utrip ou false en cas d'échec.
		*/    	
		public function getLikes(int $id) : array|false{

			$strQuery 	= " SELECT user_pseudo AS 'like_creator', like_user_id AS 'like_creatorId' , like_utrip_id AS 'like_utripId' FROM likes
							INNER JOIN users ON like_user_id = user_id
							WHERE like_utrip_id = '".$id."' ORDER BY like_date DESC";

			return $this->_db->query($strQuery)->fetchAll();			
		}

		/**
		 * Méthode permettant de liker ou de unliker un article.
		 *
		 * @param int $userId L'identifiant de l'utilisateur.
		 * @param int $utripId L'identifiant de l'article à liker ou unliker.
		 * @return void
		 */
		public function Like(int $userId, int $utripId) {

			$strQuery = "SELECT * FROM likes
			 			WHERE like_user_id = :user 
			 			AND like_utrip_id = :utrip";

			$rqPrep = $this->_db->prepare($strQuery);
			$rqPrep->bindValue(":user", $userId, PDO::PARAM_INT);
			$rqPrep->bindValue(":utrip", $utripId, PDO::PARAM_INT);

			$rqPrep->execute();
			
			if ($rqPrep->fetch()) {

				$strQuery = "DELETE FROM likes 
							WHERE like_user_id = :user 
							AND like_utrip_id = :utrip";

				$rqPrep = $this->_db->prepare($strQuery);
				$rqPrep->execute([':user' => $userId, ':utrip' => $utripId]);
			} else {

				$strQuery = "INSERT INTO likes (like_user_id, like_utrip_id, like_date) 
							VALUES (:user, :utrip, NOW())";

				$rqPrep = $this->_db->prepare($strQuery);

				$rqPrep->execute([':user' => $userId, ':utrip' => $utripId]);
			}
		}

		/**
		 * Supprime un commentaire basé sur son ID.
		 *
		 * @param int $comId L'ID du commentaire à supprimer.
		 * @return bool Renvoie true si la suppression a réussi, false sinon.
		 */
		public function deleteCom(int $comId): bool {
				
				$strQuery = "DELETE FROM comments
							 WHERE com_id = :com";

				$rqPrep = $this->_db->prepare($strQuery);
				$rqPrep->bindValue(":com", $comId, PDO::PARAM_INT);

				
				return $rqPrep->execute();
		}

		/**
		 * Méthode permettant de récupérer les utrips d'un utilisateur.
		 *
		 * @param int $id Identifiant de l'utilisateur
		 * @param int $intLimit Limite de résultats à récupérer.
		 * @return array|false Tableau des utrips de l'utilisateur ou false en cas d'échec.
		 */  
		public function findUtripByUser($id, int $intLimit = 0) {

			$strQuery 	= "SELECT utrip.utrip_id, utrip_name, utrip_description, utrip_budget, cities_id, cities_id AS 'utrip_cityId',
							utrip_date, user_pseudo AS 'utrip_creator', user_id AS 'utrip_creatorId',
							cities_name AS 'utrip_city', cat_lib AS 'utrip_cat', regions_name AS 'utrip_cont', cat_id AS 'utrip_catId' ,
									( SELECT img_link FROM image WHERE img_utrip_id = utrip.utrip_id ORDER BY 1 LIMIT 1
									) AS 'utrip_img' , 
										(SELECT COUNT(*) FROM likes WHERE like_utrip_id = utrip.utrip_id) AS utrip_like
											FROM utrip 
											RIGHT OUTER JOIN image ON img_utrip_id = utrip_id
														LEFT OUTER JOIN users ON user_id = utrip_user_id
														LEFT OUTER JOIN cities ON cities_id = utrip_city
														LEFT OUTER JOIN countries ON cities_country_id = countries_id
														LEFT OUTER JOIN regions ON countries_region_id = regions_id
														LEFT OUTER JOIN categorie ON utrip_cat = cat_id
														LEFT OUTER JOIN comments ON com_utrip_id = utrip_id
														LEFT OUTER JOIN likes ON utrip_id = like_utrip_id
											WHERE user_id = :id
											GROUP BY utrip.utrip_id ORDER BY utrip_date DESC LIMIT :limit  ";

			$rqPrep = $this->_db->prepare($strQuery);

			$rqPrep->bindValue(":limit", $intLimit, PDO::PARAM_INT);
			$rqPrep->bindValue(":id", $id, PDO::PARAM_INT);

			$rqPrep->execute();

			return $rqPrep->fetchAll();;
		}

		/**
		 * Méthode de récupération de tous les articles d'une catégorie spécifique.
		 *
		 * @param int $id L'ID de la catégorie.
		 * @param string $strCat Le nom de la catégorie.
		 * @param int $intLimit Limite de résultats à récupérer.
		 * @return array Tableau des articles de la catégorie spécifiée.
		 */
		public function findUtripByCat($id, $strCat, int $intLimit = 0) {

			$strQuery 	= "SELECT utrip.utrip_id, utrip_name, utrip_description, utrip_budget, cities_id, cities_id AS 'utrip_cityId',
			utrip_date, user_pseudo AS 'utrip_creator', user_id AS 'utrip_creatorId', countries_name AS 'utrip_country' ,
			cities_name AS 'utrip_city', cat_lib AS 'utrip_cat', regions_name AS 'utrip_cont', cat_id AS 'utrip_catId' ,
					( SELECT img_link FROM image WHERE img_utrip_id = utrip.utrip_id ORDER BY 1 LIMIT 1
					) AS 'utrip_img' , 
						(SELECT COUNT(*) FROM likes WHERE like_utrip_id = utrip.utrip_id) AS utrip_like
							FROM utrip 
							RIGHT OUTER JOIN image ON img_utrip_id = utrip_id
							LEFT OUTER JOIN users ON user_id = utrip_user_id
							LEFT OUTER JOIN cities ON cities_id = utrip_city
							LEFT OUTER JOIN countries ON cities_country_id = countries_id
							LEFT OUTER JOIN regions ON countries_region_id = regions_id
							LEFT OUTER JOIN categorie ON utrip_cat = cat_id
							LEFT OUTER JOIN comments ON com_utrip_id = utrip_id
							LEFT OUTER JOIN likes ON utrip_id = like_utrip_id
							WHERE cat_lib = :cat 
							AND utrip_id != :id
							GROUP BY utrip.utrip_id
							ORDER BY utrip_date DESC LIMIT :limit  ";

			$rqPrep = $this->_db->prepare($strQuery);

			$rqPrep->bindValue(":cat", $strCat, PDO::PARAM_STR);
			$rqPrep->bindValue(":limit", $intLimit, PDO::PARAM_INT);
			$rqPrep->bindValue(":id", $id, PDO::PARAM_INT);

			$rqPrep->execute();

			return $rqPrep->fetchAll();;
		}
	}

