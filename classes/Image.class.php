<?php
	/**
	* Image
	*
	* @method intoDb - adds images data into database
	* @method fromDb - select images data from DB to obj
	* @method __set is run when writing data to inaccessible or nonexistent properties
	* @method __get is run when reading data from inaccessible or nonexistent properties
	* @method __call is triggered when invoking inaccessible or nonexistent methods in an object context
	*/
	class Image
	{
		private $id;
		private $imagepath;
		private $itemid;
		private $catid;

		function __construct($imagepath, $itemid, $catid, $id = 0) {
			$this->imagepath = $imagepath;
			$this->itemid = $itemid;
			$this->catid = $catid;
			$this->id = $id;
		}

		/**
		* Add images data into the database
		*/
		function intoDb() {
			$db = new managerDb();
			$pdo = $db->connect();

			$ins = 'INSERT INTO images (imagepath, itemid, catid) VALUES (?, ?, ?)';
			$ps = $pdo->prepare($ins);
			$ps->execute(array(
				$this->imagepath,
				$this->itemid,
				$this->catid
			));
		}

		/**
		* select images data from DB to obj
		*
		* @parameter int itemid - item ID
		*/
		static function fromDb($itemid) {
			$db = new managerDb();
			$pdo = $db->connect();

			$sel = 'SELECT * FROM images WHERE itemid = ?';
			$ps = $pdo->prepare($sel);
			$ps->execute(array($itemid));
			$row = $ps->fetch(PDO::FETCH_LAZY);

			$img = new Image(
				$row['imagepath'],
				$row['itemid'],
				$row['catid'],
				$row['id']
			);
			return $img;
		}

		/**
		* remove directory with images
		*
		* @parameter string dirPath - path to img dir
		*/
		public static function deleteDir($dirPath) {
		    //if (! is_dir($dirPath)) {
		    //    throw new PDOException("$dirPath must be a directory");
		    //}
		    if($dirPath) {
			    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
			        $dirPath .= '/';
			    }
			    $files = glob($dirPath . '*', GLOB_MARK);
			    foreach ($files as $file) {
			        if (is_dir($file)) {
			            self::deleteDir($file);
			        } else {
			            unlink($file);
			        }
			    }
			    @rmdir($dirPath);
			}
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