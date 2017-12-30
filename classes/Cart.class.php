<?php
	/**
	* Cart
	*
	* @method intoDb - adds data into 'carts' database
	* @method counter - show item count in cart
	* @method totalPrice - show total price from cart
	* @method delCart - removes item from DB
	* @method __set is run when writing data to inaccessible or nonexistent properties
	* @method __get is run when reading data from inaccessible or nonexistent properties
	* @method __call is triggered when invoking inaccessible or nonexistent methods in an object context
	*/
	class Cart
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
		* Add data into 'carts' database & update the 'count' field in the 'items' DB
		*/
		function intoDb() {
			$db = new managerDb();
			$pdo = $db->connect();

			$ins = 'INSERT INTO carts (itemid, price, username, orderid, datein) VALUES (?, ?, ?, ?, ?)';
			$ps = $pdo->prepare($ins);
			$ps->execute(array(
				$this->itemid,
				$this->price,
				$this->username,
				$this->orderid,
				$this->datein
			));

			$item = Item::FromDb($this->itemid);
			$count = $item->count - 1;

			$upd = 'UPDATE items SET count = ? WHERE id = ?';
			$ps2 = $pdo->prepare($upd) ;
			$ps2->execute(array($count, $this->itemid));
		}

		/**
		* Show item count on the cart icon
		*
		* @parameter string orderid - oreder ID for current User
		*/
		static function counter($orderid) {
			$db = new managerDb();
			$pdo = $db->connect();

			$sel = 'SELECT COUNT(*) FROM carts WHERE orderid = ?';
			$ps = $pdo->prepare($sel);
			$ps->execute(array($orderid));
			$countnum = $ps->fetchColumn();
			return $countnum;
		}

		/**
		* Show total price from cart
		*
		* @parameter string orderid - oreder ID for current User
		*/
		static function totalPrice($username, $orderid) {
			$db = new managerDb();
			$pdo = $db->connect();

			$sel = 'SELECT SUM(price) FROM carts WHERE orderid = ?';
			$ps = $pdo->prepare($sel);
			$ps->execute(array($orderid));
			// set discount from registered user (gets data from Purchase.discountPrice)
			$total = $ps->fetchColumn();
			if($username) {
				$total_discount = Purchase::getDiscount($username, $total);
				return $total_discount;
			}
			else {
				return $total;
			}
		}

		/**
		* Delete item from DB & update the 'count' field in the 'items' DB
		*
		* @parameter int id - Item ID
		*/
		static function delCart($id) {
			$db = new managerDb();
			$pdo = $db->connect();

			$del = 'DELETE FROM carts WHERE id = ?';
			$ps = $pdo->prepare($del);
			$ps->execute(array($id));
		}

		function __set($property, $value) {
			try {
				if (property_exists($this, $property)) {
			      $this->$property = $value;
			    }
			    else {
			    	throw new PDOException('Attempt to write data to a non-existent property '.$property);
			    }
			} catch(PDOException $e) {
				echo $e->getMessage();
				unset($this->property);
		    	echo ". <br> property '$property' deleted";
			}
		}
		function __get($property) {
			try {
				if(property_exists($this, $property)) {
		    		return $this->$property;
				}
				else {
					throw new PDOException('Attempt to read a nonexistent property '.$property);
					
				}
			}
			catch(PDOException $e) {
				echo $e->getMessage();
				unset($this->property);
				echo ". <br> property '$property' deleted";
			}
	    }

		function __call($method, $args) {
			try {
				throw new PDOException('Undefined method '.$method. implode(', ', $args). "\n");
			}
			catch(PDOException $e) {
				echo $e->getMessage();
				unset($this->method);
				echo ". <br> method '$method' deleted";
			}
		}
	}