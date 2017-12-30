<?php
	session_start();
	function __autoload($class) {
		include '../classes/'.$class.'.class.php';
	}
	if(isset($_POST['item_id'])) {
		$db = new ManagerDb();
		$pdo = $db->connect();

		$sel = 'SELECT * FROM items WHERE id ='.$_POST['item_id'];
		$res = $pdo->query($sel);
		$row = $res->fetch();
		echo json_encode($row);
	}