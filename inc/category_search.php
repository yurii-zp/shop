<?php
	session_start();
	function __autoload($class) {
		include '../classes/'.$class.'.class.php';
	}
	$db = new ManagerDb();
	$pdo = $db->connect();

	$output = '';
	if(isset($_POST['search'])) {
		$search = trim($_POST['search']);
		$sel = 'SELECT * FROM categories WHERE category LIKE "%'.$search.'%"';
	}
	else {
		$sel = 'SELECT * FROM categories';
	}
	$res = $pdo->query($sel);
	if($res->rowCount() > 0) {
		$output .='<div class="error">
						<div class="alert alert-danger fade in"></div>
					</div>
    				<table class="table table-bordered table-striped table_scrolling">
						<thead>
							<tr>
								<th>Category name</th>
								<th>#</th>
							</tr>
						</thead>
						<tbody>
		';
		while($row = $res->fetch()) {
			$output .= '
				<tr>
				<td>'.$row['category'].'</td>
				<td><button type="button" id="delcat'.$row['id'].'" class="btn btn-xs btn-warning del_cat">Delete</button></td>
				</tr>
			';
		}
		$output .= '</tbody></table>';
		echo $output;
	}
	else {
		echo 'Category Not Found';
	}