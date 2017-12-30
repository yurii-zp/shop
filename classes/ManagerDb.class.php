<?php
	/**
	* ManagerDb
	*
	* @method connect open the database connection
	* @method show displays connect params with DB
	*/
	class ManagerDb
	{
		const HOST = 'localhost';
		const DBNAME = '10632shop';
		const USER = 'root';
		const PASS = '';

		/**
		* set connect with DB
		*/
		function connect() {
			$dsn = 'mysql:host='.self::HOST.';dbname='.self::DBNAME.';charset=utf8';
			$options = array(
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				[PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8;SET time_zone = 'Europe/Kiev'"]
			);

			try {
				return $pdo = new PDO($dsn, self::USER, self::PASS, $options);
			}
			catch(PDOException $e) {
				echo $e->getMessage();
				exit();
			}
		}

		/**
		* Get next ID from DB table
		*
		* @parameter string tablename - the name of the database table in which the search is performed
		*/
		function getNextID($tablename) {
			$db = new managerDb();
			$pdo = $db->connect();

			$sel = 'SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "'.self::DBNAME.'" AND TABLE_NAME = ?';
			$ps = $pdo->prepare($sel);
			$ps->execute(array($tablename));
			$id = $ps->fetchColumn();
			return $id;
		}

		/**
		* displaying connect params with DB
		*/
		function show() {
			echo "Host: ".self::HOST."; User: ".self::USER. "; Pass: " .self::PASS. "; DB: ".self::DBNAME;
		}
	}