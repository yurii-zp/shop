<?php
	function __autoload($class) {
		include '../classes/'.$class.'.class.php';
	}

	$db = new ManagerDb();
	$pdo = $db->connect();

	$role = 'CREATE TABLE roles (
			id int NOT null AUTO_INCREMENT PRIMARY KEY,
			role varchar(32) NOT null UNIQUE)
			DEFAULT charset="utf8"';

	$user = 'CREATE TABLE users (
			id int NOT null AUTO_INCREMENT PRIMARY KEY,
			login varchar(64) NOT null UNIQUE,
			pass varchar(64) NOT null,
			email varchar(64) NOT null,
			roleid int DEFAULT "1", FOREIGN KEY(roleid) REFERENCES roles(id) ON DELETE CASCADE ON UPDATE CASCADE,
			avatar mediumblob,
			discount int DEFAULT "1",
			rating int DEFAULT "0")
			DEFAULT charset="utf8"';

	$cat =  'CREATE TABLE categories(
			id int NOT null AUTO_INCREMENT PRIMARY KEY,
			category varchar(64) NOT null UNIQUE)
			DEFAULT charset="utf8"';

	$item = 'CREATE TABLE items(
			id int NOT null AUTO_INCREMENT PRIMARY KEY,
			item varchar(64) NOT null UNIQUE,
			catid int, FOREIGN KEY(catid) REFERENCES categories(id) ON DELETE CASCADE,
			pricein decimal(7,2) NOT null,
			pricesale  decimal(7,2) NOT null,
			info text,
			count int NOT null)
			DEFAULT charset="utf8"';

	$img =  'CREATE TABLE images(
			id int NOT null AUTO_INCREMENT PRIMARY KEY,
			imagepath varchar(256),
			itemid int, FOREIGN KEY(itemid) REFERENCES items(id) ON DELETE CASCADE,
			catid int, FOREIGN KEY(catid) REFERENCES categories(id) ON DELETE CASCADE)
			DEFAULT charset="utf8"';

	$comm = 'CREATE TABLE comments(
			id int NOT null AUTO_INCREMENT PRIMARY KEY,
			username varchar(64), FOREIGN KEY(username) REFERENCES users(login) ON DELETE CASCADE ON UPDATE CASCADE,
			itemid int, FOREIGN KEY(itemid) REFERENCES items(id) ON DELETE CASCADE ON UPDATE CASCADE,
			title varchar(128),
			comment text,
			rating int,
			curdate datetime)
			DEFAULT charset="utf8"';

	$cart = 'CREATE TABLE carts(
			id int NOT null AUTO_INCREMENT PRIMARY KEY,
			itemid int, FOREIGN KEY(itemid) REFERENCES items(id) ON DELETE CASCADE ON UPDATE CASCADE,
			price decimal(7,2),
			username varchar(64),
			orderid varchar(32),
			datein datetime)
			DEFAULT charset="utf8"';

	$purc = 'CREATE TABLE purchases(
			id int NOT null AUTO_INCREMENT PRIMARY KEY,
			itemid int, FOREIGN KEY(itemid) REFERENCES items(id) ON UPDATE CASCADE,
			price decimal(7,2),
			username varchar(64),
			orderid varchar(32),
			datein datetime)
			DEFAULT charset="utf8"';

	$arch = 'CREATE TABLE archives(
			id int NOT null AUTO_INCREMENT PRIMARY KEY,
			item varchar(64) NOT null,
			itemid int, FOREIGN KEY(itemid) REFERENCES items(id) ON UPDATE CASCADE,
			pricein decimal(7,2),
			pricesale decimal(7,2),
			datesale datetime)
			DEFAULT charset="utf8"';

	$pdo->query($role);
	$pdo->query($user);
	$pdo->query($cat);
	$pdo->query($item);
	$pdo->query($img);
	$pdo->query($comm);
	$pdo->query($cart);
	$pdo->query($purc);
	$pdo->query($arch);