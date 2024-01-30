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
								utrip_user_id AS 'utrip_creator'
							FROM utrip
								INNER JOIN users ON utrip_user_id = user_id";

		$strWhere    = " WHERE ";
		// Recherche par mot clé
		$strKeywords = $arrSearch['keywords'] ?? "";
		if ($strKeywords != '') {
			$strQuery     .= $strWhere . " (utrip_name LIKE '%" . $strKeywords . "%'
									OR utrip_description LIKE '%" . $strKeywords . "%') ";
			$strWhere    = " AND ";
		}
		// Recherche par date exacte
		$intPeriod        = $arrSearch['period'] ?? 0;
		$strDate        = $arrSearch['date'] ?? "";
		if ($intPeriod == 0 && $strDate != '') {
			$strQuery     .= $strWhere . " utrip_date = '" . $strDate . "' ";
			$strWhere    = " AND ";
		}

		return $this->_db->query($strQuery)->fetchAll();
	}
}
