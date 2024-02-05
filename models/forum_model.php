<?php
/* Récupérer les articles dans la BDD */
include_once("connect.php");

class ForumModel extends Model
{


	public function __construct()
	{
		parent::__construct();
	}

	public function findAll(int $intLimit = 0, $arrSearch = array())
	{
		$strQuery     = "	SELECT topic_title, topic_content, topic_date, topic_code, 
								user_pseudo AS 'topic_creator'
							FROM topic
								INNER JOIN users ON topic_user_id = user_id";

		if ($intLimit > 0) {
			$strQuery 	.= " LIMIT :limit";
		}



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
