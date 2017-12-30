<?php
	/**
	* Purchase
	*
	* @method intoDb - Add bought product data into 'purchases' table & into 'archives' table (if it's last product in the shop)
	* @method counter - displays count for bought products on the profile page
	* @method totalAmount - displays total amount for bought products on the profile page
	* @method setRating - sets out rating if user bought any other products before
	* @method setDiscount - sets out discount percentage if user bought any other products before
	* @method getDiscount - gets current price for each product given the discount
	*/
	class Purchase
	{
		private $id;
		private $itemid;
		private $price;
		private $username;
		private $orderid;
		private $datein;

		function __construct($itemid, $price, $username, $orderid, $datein, $id = 0) {
			$this->itemid = $itemid;
			$this->price = $price;
			$this->username = $username;
			$this->orderid = $orderid;
			$this->datein = $datein;
			$this->id = $id;
		}

		/**
		* Add bought product data into 'purchases' table & into 'archives' table (if it's last product in the shop)
		*/
		function intoDb() {
			$db = new managerDb();
			$pdo = $db->connect();

			$ins = 'INSERT INTO purchases (itemid, price, username, orderid, datein) VALUES (?, ?, ?, ?, ?)';
			$ps = $pdo->prepare($ins);
			$ps->execute(array(
				$this->itemid,
				$this->price,
				$this->username,
				$this->orderid,
				$this->datein
			));

			$purchase = Item::FromDb($this->itemid);
			if($purchase->count == 0) {
				$tz = date_default_timezone_set('Europe/Kiev');
				$datesale = @date('Y-m-d H:i:s');

				$ins2 = 'INSERT INTO archives (item, itemid, pricein, pricesale, datesale) VALUES (?, ?, ?, ?, ?)';
				$ps3 = $pdo->prepare($ins2);
				$ps3->execute(array(
					$purchase->item,
					$this->itemid,
					$purchase->pricein,
					$purchase->pricesale,
					$datesale
				));
			}
		}

		/**
		* Show count bought products on the profile page
		*
		* @parameter string username - user login (SESSION variable)
		*/
		static function counter($username) {
			$db = new managerDb();
			$pdo = $db->connect();

			$sel = 'SELECT COUNT(*) FROM purchases WHERE username = ?';
			$ps = $pdo->prepare($sel);
			$ps->execute(array($username));
			$countnum = $ps->fetchColumn();
			return $countnum;
		}

		/**
		* Show total amount for bought products on the profile page
		*
		* @parameter string username - user login (SESSION variable)
		*/
		static function totalAmount($username) {
			$db = new managerDb();
			$pdo = $db->connect();

			$sel = 'SELECT SUM(price) FROM purchases WHERE username = ?';
			$ps = $pdo->prepare($sel);
			$ps->execute(array($username));
			$total = $ps->fetchColumn();
			return $total;
		}

		/**
		* Set rating if user bought any other products before
		*
		* @parameter string username - user login (SESSION variable)
		*/
		function setRating($username) {
			$db = new managerDb();
			$pdo = $db->connect();

			$sel = 'SELECT SUM(price) FROM purchases WHERE username = ?';
			$ps = $pdo->prepare($sel);
			$ps->execute(array($username));
			$total = $ps->fetchColumn();
			if($total >= 1000 && $total <= 1999) {
				$upd = 'UPDATE users SET rating = ? WHERE login = ?';
				$ps1 = $pdo->prepare($upd);
				$ps1->execute(array(20, $username));
			}
			elseif($total >= 2000 && $total <= 2999) {
				$upd = 'UPDATE users SET rating = ? WHERE login = ?';
				$ps1 = $pdo->prepare($upd);
				$ps1->execute(array(40, $username));
			}
			elseif($total >= 3000 && $total <= 3999) {
				$upd = 'UPDATE users SET rating = ? WHERE login = ?';
				$ps1 = $pdo->prepare($upd);
				$ps1->execute(array(60, $username));
			}
			elseif($total >= 4000 && $total <= 4999) {
				$upd = 'UPDATE users SET rating = ? WHERE login = ?';
				$ps1 = $pdo->prepare($upd);
				$ps1->execute(array(80, $username));
			}
			elseif($total >= 5000) {
				$upd = 'UPDATE users SET rating = ? WHERE login = ?';
				$ps1 = $pdo->prepare($upd);
				$ps1->execute(array(100, $username));
			}
		}

		/**
		* Set discount percentage if user bought any other products before
		*
		* @parameter string username - user login (SESSION variable)
		*/
		function setDiscount($username) {
			$db = new managerDb();
			$pdo = $db->connect();

			$sel = 'SELECT SUM(price) FROM purchases WHERE username = ?';
			$ps = $pdo->prepare($sel);
			$ps->execute(array($username));
			$total = $ps->fetchColumn();
			if($total >= 1000 && $total <= 2999) {
				$upd = 'UPDATE users SET discount = ? WHERE login = ?';
				$ps1 = $pdo->prepare($upd);
				$ps1->execute(array(3, $username));
			}
			elseif($total >= 3000 && $total <= 4999) {
				$upd = 'UPDATE users SET discount = ? WHERE login = ?';
				$ps1 = $pdo->prepare($upd);
				$ps1->execute(array(5, $username));
			}
			elseif($total >= 5000) {
				$upd = 'UPDATE users SET discount = ? WHERE login = ?';
				$ps1 = $pdo->prepare($upd);
				$ps1->execute(array(7, $username));
			}
		}

		/**
		* Get current price for each product given the discount
		*
		* @parameter string username - user login (SESSION variable)
		* @parameter double price - product price without discont
		*/
		static function getDiscount($username, $price) {
			$db = new managerDb();
			$pdo = $db->connect();

			$sel = 'SELECT SUM(price) FROM purchases WHERE username = ?';
			$ps = $pdo->prepare($sel);
			$ps->execute(array($username));
			$total_purchases = $ps->fetchColumn();
			if($total_purchases < 1000) {
				$discount = $price * 1 / 100;
				$price = $price - $discount;
				return round($price, 2);
			}
			elseif($total_purchases >= 1000 && $total_purchases <= 2999) {
				$discount = $price * 3 / 100;
				$price = $price - $discount;
				return round($price, 2);
			}
			elseif($total_purchases >= 3000 && $total_purchases <= 4999) {
				$discount = $price * 5 / 100;
				$price = $price - $discount;
				return round($price, 2);
			}
			else {
				$discount = $price * 7 / 100;
				$price = $price - $discount;
				return round($price, 2);
			}
		}
	}