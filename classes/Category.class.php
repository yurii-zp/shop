<?php
	/**
	* Category
	*
	* @method intoDb - adds category data into database
	* @method fromDb - select category data from DB to obj
	* @method delCat - removes category data from DB, items and images for this category
	* @method __set is run when writing data to inaccessible or nonexistent properties
	* @method __get is run when reading data from inaccessible or nonexistent properties
	* @method __call is triggered when invoking inaccessible or nonexistent methods in an object context
	*/
	class Category
	{
		protected $id;
		protected $category;

		function __construct($category, $id = 0)
		{
			$this->category = $category;
			$this->id = $id;
		}

		/**
		* Add category data into the database
		*/
		function intoDb() {
			$db = new managerDb();
			$pdo = $db->connect();

			$ins = 'INSERT INTO categories(category) VALUES (:cat)';
			$ps = $pdo->prepare($ins);
			$ps->bindParam(':cat', $this->category);
			$ps->execute();
			//$ps->execute(array($this->category));
		}

		/**
		* Select category data from DB to obj
		*
		* @parameter int id - category ID
		*/
		static function fromDb($id) {
			$db = new managerDb();
			$pdo = $db->connect();

			$sel = 'SELECT * FROM categories WHERE id = ?';
			$ps = $pdo->prepare($sel);
			$ps->execute(array($id));
			$row = $ps->fetch(PDO::FETCH_LAZY);

			$cat = new Category(
				$row['category'],
				$row['id']
			);
			return $cat;
		}

		/**
		* Remove category from DB
		*
		* @parameter int ID - category identifier
		*/
		function delCat($id) {
			$db = new managerDb();
			$pdo = $db->connect();

			$del = 'DELETE FROM categories WHERE id = ?';
			$ps = $pdo->prepare($del);
			$ps->execute(array($id));

			$del1 = 'DELETE FROM items WHERE catid = ?';
			$ps1 = $pdo->prepare($del1);
			$ps1->execute(array($id));

			$del2 = 'DELETE FROM images WHERE catid = ?';
			$ps2 = $pdo->prepare($del2);
			$ps2->execute(array($id));

			$dir_path = '../images/content/'.$id;
			$del_imgs = Image::deleteDir($dir_path);
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