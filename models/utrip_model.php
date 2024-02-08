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
		$strQuery     = "SELECT DISTINCT utrip_id , utrip_name , utrip_description , utrip_budget , utrip_date , user_pseudo AS 'utrip_creator' , img_link AS 'utrip_img' , city_name AS 'utrip_city'
								FROM utrip 
								LEFT OUTER JOIN image ON img_utrip_id = utrip_id
								LEFT OUTER JOIN users ON user_id = utrip_user_id
								LEFT OUTER JOIN is_located ON utrip_id = loc_utrip_id
								LEFT OUTER JOIN city ON city_id = loc_city_id
								LEFT OUTER JOIN country ON city_country_id = country_id
								LEFT OUTER JOIN continent ON country_cont_id = cont_id
								LEFT OUTER JOIN categorie_utrip ON utrip_id = cat_utrip_utrip_id
								LEFT OUTER JOIN categorie ON cat_utrip_cat_id = cat_id
								LEFT OUTER JOIN comments ON com_utrip_id = utrip_id
								LEFT OUTER JOIN likes ON utrip_id = like_utrip_id";


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
