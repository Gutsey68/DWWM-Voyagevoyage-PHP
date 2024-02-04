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

		$strWhere    = " WHERE ";
		// Recherche par mot clé
		$strKeywords = $arrSearch['keywords'] ?? "";
		if ($strKeywords != '') {
			$strQuery     .= $strWhere . " (topic_title LIKE '%" . $strKeywords . "%'
									OR topic_content LIKE '%" . $strKeywords . "%') ";
			$strWhere    = " AND ";
		}
		// Recherche par date exacte
		$intPeriod        = $arrSearch['period'] ?? 0;
		$strDate        = $arrSearch['date'] ?? "";
		if ($intPeriod == 0 && $strDate != '') {
			$strQuery     .= $strWhere . " topic_date = '" . $strDate . "' ";
			$strWhere    = " AND ";
		}

		return $this->_db->query($strQuery)->fetchAll();
	}
}
