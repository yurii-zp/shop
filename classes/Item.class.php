<?php
	/**
	* Item
	*
	* @method intoDb - adds item data into database
	* @method fromDb - select item data from DB to obj
	* @method delItem - removes item data from DB, images for this items
	* @method __set is run when writing data to inaccessible or nonexistent properties
	* @method __get is run when reading data from inaccessible or nonexistent properties
	* @method __call is triggered when invoking inaccessible or nonexistent methods in an object context
	*/
	class Item
	{
		protected $id;
		protected $item;
		protected $catid;
		protected $pricein;
		protected $pricesale;
		protected $info;
		protected $count;

		function __construct($item, $catid, $pricein, $pricesale, $info, $count, $id = 0) {
			$this->item = $item;
			$this->catid = $catid;
			$this->pricein = $pricein;
			$this->pricesale = $pricesale;
			$this->info = $info;
			$this->count = $count;
			$this->id = $id;
		}

		/**
		* Add item data into the database
		*/
		function intoDb() {
			$db = new managerDb();
			$pdo = $db->connect();

			$ins = 'INSERT INTO items (item, catid, pricein, pricesale, info, count) VALUES (?, ?, ?, ?, ?, ?)';
			$ps = $pdo->prepare($ins);
			$ps->execute(array(
				$this->item,
				$this->catid,
				$this->pricein,
				$this->pricesale,
				$this->info,
				$this->count
			));
		}

		/**
		* Select item data from DB to obj
		*
		* @parameter int id - item ID
		*/
		static function fromDb($id) {
			$db = new managerDb();
			$pdo = $db->connect();

			$sel = 'SELECT * FROM items WHERE id = ?';
			$ps = $pdo->prepare($sel);
			$ps->execute(array($id));
			$row = $ps->fetch(PDO::FETCH_LAZY);

			$item = new Item(
				$row['item'],
				$row['catid'],
				$row['pricein'],
				$row['pricesale'],
				$row['info'],
				$row['count'],
				$row['id']
			);
			return $item;
		}

		/**
		* Remove item from DB
		*
		* @parameter int ID - item identifier
		*/
		static function delItem($catid, $id) {
			$db = new managerDb();
			$pdo = $db->connect();

			$del = 'DELETE FROM items WHERE id = ?';
			$ps = $pdo->prepare($del);
			$ps->execute(array($id));

			$dir_path = '../images/content/'.$catid.'/'.$id;
			$del_imgs = Image::deleteDir($dir_path);

			$del1 = 'DELETE FROM images WHERE itemid = ?';
			$ps1 = $pdo->prepare($del1);
			$ps1->execute(array($id));

			$del2 = 'DELETE FROM carts WHERE itemid = ?';
			$ps2 = $pdo->prepare($del2);
			$ps2->execute(array($id));
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