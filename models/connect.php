<?php
	/***
	* Connexion avec la BDD
	* @author Gauthier
	*/
	class Model {
		protected $_db;

		public function __construct() {
			try {
				$this->_db = new PDO(
					"mysql:host=localhost;dbname=dwwmaprogjhb_voyvoy",
					"root",
					"",

					/*  "mysql:host=localhost;dbname=dwwmaprogjhb_voyvoy",
					"dwwmaprogjhb_lilicub",
					"q,zuCI_{m.y)", */

					array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC)
				);

				// Encodage
				$this->_db->exec("SET CHARACTER SET utf8");

				// Exceptions
				$this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $erreurs) {
				echo ("Erreurs de connexion : " . $erreurs->getMessage());
			}
		}
	}
