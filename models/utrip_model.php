<?php
/* Récupérer les articles dans la BDD */
include_once("connect.php");

class UtripModel extends Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function findAll(int $intLimit = 0, $arrSearch = array())
	{
		$strQuery     = "	SELECT utrip_name, utrip_description, utrip_budget, utrip_date, 
								utrip_user_id AS 'utrip_creator' , img_utrip_id AS 'utrip_img' ,
								cat_id AS 'utrip_cat' , city_id AS 'utrip_city' , country_id AS 'utrip_country' ,
								cont_id AS 'utrip_cont' , like_utrip_id AS 'utrip_like' , com_utrip_id AS 'utrip_com'
							FROM utrip
								INNER JOIN users ON utrip_user_id = user_id
								INNER JOIN image ON img_utrip_id = utrip_id
								INNER JOIN categorie_utrip ON cat_utrip_utrip_id = utrip_id
								INNER JOIN categorie ON cat_id = cat_utrip_cat_id
								INNER JOIN is_located ON utrip_id = loc_utrip_id
								INNER JOIN city ON city_id = loc_city_id
								INNER JOIN country ON country_id = city_country_id
								INNER JOIN continent ON cont_id = country_cont_id 
								INNER JOIN likes ON like_utrip_id = utrip_id 
								INNER JOIN comments ON utrip_id = com_utrip_id ";


		$strWhere	= " WHERE ";
		// Recherche par mot clé
		$strKeywords = $arrSearch['keywords'] ?? "";
		if ($strKeywords != '') {
			$strQuery 	.= $strWhere . " (utrip_name LIKE :keywords
						OR utrip_description LIKE :keywords) ";
			$strWhere	= " AND ";
		}
		// Recherche par date exacte
		$intPeriod		= $arrSearch['period'] ?? 0;
		$strDate		= $arrSearch['date'] ?? "";
		if ($intPeriod == 0 && $strDate != '') {
			$strQuery 	.= $strWhere . " utrip_date = :date ";
			$strWhere	= " AND ";
		}
		/* // Recherche par période
		$strStartDate	= $arrSearch['startdate'] ?? "";
		$strEndDate		= $arrSearch['enddate'] ?? "";
		if ($intPeriod == 1 && $strStartDate != '' && $strEndDate != '') {
			$strQuery 	.= $strWhere . " article_createdate BETWEEN :begin AND :end ";
			$strWhere	= " AND ";
		} */

		// Tri par ordre décroissant
		$strQuery 	.= " ORDER BY utrip_date DESC";

		if ($intLimit > 0) {
			$strQuery 	.= " LIMIT :limit";
		}

		// On prépare la requête
		$rqPrep	= $this->_db->prepare($strQuery);
		// On complète les variables de la requête, selon le contexte
		if ($strKeywords != '') {
			$rqPrep->bindValue(":keywords", "%" . $strKeywords . "%", PDO::PARAM_STR);
		}
		if ($intPeriod == 0 && $strDate != '') {
			$rqPrep->bindValue(":date", $strDate, PDO::PARAM_STR);
		}
		/* if ($intPeriod == 1 && $strStartDate != '' && $strEndDate != '') {
			$rqPrep->bindValue(":begin", $strStartDate, PDO::PARAM_STR);
			$rqPrep->bindValue(":end", $strEndDate, PDO::PARAM_STR); 
		}*/
		if ($intLimit > 0) {
			$rqPrep->bindValue(":limit", $intLimit, PDO::PARAM_INT);
		}
		$rqPrep->execute();
		return $rqPrep->fetchAll();
	}
}
