<?php
class Model
{
    protected $_db;

<<<<<<< Updated upstream
    public function __construct()
    {
        try {
            $this->_db = new PDO(
                "mysql:host=localhost;dbname=projet_2",
                "root",
                "",
                array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC)
            );
            $this->_db->exec("SET CHARACTER SET utf8");
            $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $erreurs) {
            echo ("Erreurs de connexion : " . $erreurs->getMessage());
        }
    }
=======
	public function __construct()
	{
		try {
			$this->_db = new PDO(
				"mysql:host=localhost;dbname=projet",
				"root",
				"",
				/*  "mysql:host=localhost;dbname=dwwmaprogjhb_voyvoy",
				"dwwmaprogjhb_lilicub",
				"q,zuCI_{m.y)", */
				array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC)
			);
			$this->_db->exec("SET CHARACTER SET utf8");
			$this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $erreurs) {
			echo ("Erreurs de connexion : " . $erreurs->getMessage());
		}
	}
>>>>>>> Stashed changes
}
