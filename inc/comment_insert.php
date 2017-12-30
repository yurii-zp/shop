<?php
	session_start();
	function __autoload($class) {
		include '../classes/'.$class.'.class.php';
	}

	if(isset($_SESSION['reguser'])) {
		$login = $_SESSION['reguser'];
	}
	else {
		$login = $_SESSION['regadmin'];
	}
	$itemid = $_POST['itemid'];
	$comm_title = trim($_POST['comm_title']);
	$comm = trim($_POST['comm']);
	$ratingin = $_POST['ratingin'];
	$tz = date_default_timezone_set('Europe/Kiev');
	$curdate = @date('Y-m-d H:i:s');

	$comment = new Comment($login, $itemid, $comm_title, $comm, $ratingin, $curdate);
	$comment->intoDb();

	echo '<h3>Reviews</h3>';
	$show_comment = Comment::showComm($itemid);