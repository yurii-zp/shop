<?php
	/**
	* User 
	*
	* @method intoDb - adds user data into database
	* @method fromDb - selects User data from DB using User login
	* @method fromDbID - selects User data from DB using User ID
	* @method openUserSess - opens the session for current user
	* @method getOrder - gets order number for unregistered user from 'carts' table
	* @method signIn - user authorization on site
	* @method changePass - updates user password and open session for
	* @method editProfile - edits user profile (email & avatar)
	* @method changeRole - updates user role
	* @method delUser - removes user data from DB
	* @method __set is run when writing data to inaccessible or nonexistent properties
	* @method __get is run when reading data from inaccessible or nonexistent properties
	* @method __call is triggered when invoking inaccessible or nonexistent methods in an object context
	*/
	class User
	{
		private $id;
		private $login;
		private $pass;
		private $email;
		private $roleid;
		private $avatar;
		private $discount;
		private $rating;

		function __construct($login, $pass, $email, $avatar, $roleid, $id = 0, $discount = 1, $rating = 0) {
			$this->login = $login;
			$this->pass = $pass;
			$this->email = $email;
			$this->avatar = $avatar;
			$this->roleid = $roleid;
			$this->id = $id;
			$this->discount = $discount;
			$this->rating = $rating;
		}

		/**
		* Add user data into database
		*/
		function intoDb() {
			$db = new ManagerDb();
			$pdo = $db->connect();

			$ins = 'INSERT INTO users(login, pass, email, avatar) VALUES (?, ?, ?, ?)';
			$ps = $pdo->prepare($ins);

			if($_FILES['avatar']['error'] != 0) {
				$fn = null;
			}
			else {
				$fn = fopen($_FILES['avatar']['tmp_name'], 'rb');
			}

		//	$ps->execute(array(
		//	$this->login,
		//	$this->pass,
		//	$this->email,
		//	$this->avatar
		//	));
			$ps->bindParam(1, $this->login);
			$ps->bindParam(2, $this->pass);
			$ps->bindParam(3, $this->email);
			$ps->bindParam(4, $fn, PDO::PARAM_LOB);
			return $ps->execute();
		}

		/**
		* Select User data from DB using User login
		*
		* @parameter string login - User login
		*/
		static function fromDb($login) {
			$db = new ManagerDb();
			$pdo = $db->connect();

			$sel = 'SELECT * FROM users WHERE login = ?';
			$ps = $pdo->prepare($sel);
			$ps->execute(array($login));
			$row = $ps->fetch(PDO::FETCH_LAZY);
			if($row) {
				$user = new User(
					$row['login'],
					$row['pass'],
					$row['email'],
					$row['avatar'],
					$row['roleid'],
					$row['id'],
					$row['discount'],
					$row['rating']
				);
				return $user;
			}
			else {
				return false;
			}
		}

		/**
		* Select User data from DB using User ID
		*
		* @parameter int login - User ID
		*/
		static function fromDbID($id) {
			$db = new ManagerDb();
			$pdo = $db->connect();

			$sel = 'SELECT * FROM users WHERE id = ?';
			$ps = $pdo->prepare($sel);
			$ps->execute(array($id));
			$row = $ps->fetch(PDO::FETCH_LAZY);
			$user = new User(
				$row['login'],
				$row['pass'],
				$row['email'],
				$row['avatar'],
				$row['roleid'],
				$row['id'],
				$row['discount'],
				$row['rating']
			);
			return $user;
		}

		/**
		* Open the session for current user
		*
		* @parameter integer roleid - User role
		* @parameter string login - User login
		*/
		private function openUserSess() {
			try {
				switch ($this->roleid) {
					case 1:
						$_SESSION['reguser'] = $this->login;
						break;
					case 2:
						$_SESSION['regadmin'] = $this->login;
						break;
					default:
						throw new PDOException("An error in the role of the user. This role does not exist");
						break;
				}
				$db = new managerDb();
				$pdo = $db->connect();

				$sel = 'SELECT orderid FROM purchases WHERE username = ?';
				$ps = $pdo->prepare($sel);
				$ps->execute(array($this->login));
				$orderid = $ps->fetchColumn();
				if(!$orderid) {
					$sel1 = 'SELECT orderid FROM carts WHERE username = ?';
					$ps = $pdo->prepare($sel1);
					$ps->execute(array($this->login));
					$orderid = $ps->fetchColumn();
				}
				if($orderid) {
					$_SESSION['orderid'] = $orderid;
					return $orderid;
				}
				//return $orderid;
			}
			catch(PDOException $e) {
				die('ERROR: '.$e->getMessage());
			}
		}

		static function getOrder($orderid) {
			$db = new managerDb();
			$pdo = $db->connect();

			$sel = 'SELECT orderid FROM carts WHERE orderid = ?';
			$ps = $pdo->prepare($sel);
			$ps->execute(array($orderid));
			$orderid = $ps->fetchColumn();
			if($orderid) {
				$_SESSION['orderid'] = $orderid;
				return $orderid;
			}
		}

		/**
		* User authorization on site
		*
		* @parameter string login - User login
		* @parameter string pass  - User password
		*/
		static function signIn($login, $pass) {
			$db = new ManagerDb();
			$pdo = $db->connect();

			$sel = 'SELECT * FROM users WHERE login = ? AND pass = ?';
			$ps = $pdo->prepare($sel);
			$ps->execute(array($login, $pass));
			$row = $ps->fetch(PDO::FETCH_LAZY);

			if($row) {
				$user = new User(
					$row['login'],
					$row['pass'],
					$row['email'],
					$row['avatar'],
					$row['roleid'],
					$row['id'],
					$row['discount'],
					$row['rating']
				);

				if(isset($_POST['signin'])) {
					$user->openUserSess();
				}
				return $user;
			}
			else {
				return false;
			}
		}
	
		/**
		* Update user password and open session for
		*
		* @parameter string newpass - new User password
		* @parameter string login - User login
		*/
		static function changePass($newpass, $login) {
			$db = new ManagerDb();
			$pdo = $db->connect();

			$upd = 'UPDATE users SET pass = ? WHERE login = ?';
			$ps = $pdo->prepare($upd);
			$ps->execute(array($newpass, $login));

			$user = User::fromDb($login);
			$user->openUserSess();
		}

		/**
		* Edit user profile (email & avatar)
		*
		* @parameter string email - new User email
		* @parameter binary avatar - new User avatar
		* @parameter string login - current User login
		*/
		function editProfile($email, $avatar, $login) {
			$db = new ManagerDb();
			$pdo = $db->connect();
		
			$upd = 'UPDATE users SET email = ?, avatar = ? WHERE login = ?';
			$ps = $pdo->prepare($upd);

			if($_FILES['avatar_prof']['error'] != 0) {
				$fn = $this->avatar;
			}
			else {
				$fn = fopen($_FILES['avatar_prof']['tmp_name'], 'rb');
			}

			if(empty($_POST['email_prof'])) {
				//$_POST['email_prof'] = $this->email;
				$em = $this->email;
			}
			else {
				$em = $_POST['email_prof'];
			}

			$ps->bindParam(1, $em);
			$ps->bindParam(2, $fn, PDO::PARAM_LOB);
			$ps->bindParam(3, $this->login);
			return $ps->execute();
		}

		/**
		* Update User role
		*
		* @parameter int role - featured user role
		* @parameter int ID - User identifier
		*/
		function changeRole($role, $id) {
			$db = new managerDb();
			$pdo = $db->connect();

			$upd = 'UPDATE users SET roleid = ? WHERE id = ?';
			$ps = $pdo->prepare($upd);
			$ps->execute(array($role, $id));
		}

		/**
		* Remove user from DB
		*
		* @parameter int ID - user identifier
		*/
		function delUser($id) {
			$db = new managerDb();
			$pdo = $db->connect();

			$del = 'DELETE FROM users WHERE id = ?';
			$ps = $pdo->prepare($del);
			$ps->execute(array($id));
		}

		function __set($property, $value) {
			try {
				if(property_exists($this, $property)) {
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
?>