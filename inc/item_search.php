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
		$sel = 'SELECT it.id, it.item, it.catid, ca.category
				FROM items it
				LEFT JOIN categories ca ON it.catid = ca.id
				WHERE it.item LIKE "%'.$search.'%"
				OR ca.category LIKE "%'.$search.'%"
				ORDER BY it.id ASC';
	}
	else {
		$sel = 'SELECT it.id, it.item, it.catid, ca.category
				FROM items it, categories ca
				WHERE it.catid = ca.id
				ORDER BY it.id ASC';
	}
	$res = $pdo->query($sel);
	if($res->rowCount() > 0) {
		$output .= '<div class="error">
						<div class="alert alert-danger fade in"></div>
					</div>
					<div class="response_table">
						<table class="table table-bordered table-striped table_scrolling">
							<thead>
								<tr>
									<th>Item name</th>
									<th>Category</th>
									<th>#</th>
								</tr>
							</thead>
							<tbody>
		';
		while($row = $res->fetch()) {
			$output .= '<tr data-catid="'.$row['catid'].'">
							<td>'.$row['item'].'</td>
							<td>'.$row['category'].'</td>
							<td>
								<button type="button" id="upd'.$row['id'].'" class="btn btn-xs btn-info edit_item">Update Item</button>
								<button type="button" id="del'.$row['id'].'" class="btn btn-xs btn-warning del_item">Delete Item</button>
							</td>
						</tr>';
		}
		$output .= '</tbody></table></div>';
		echo $output;
	}
	else {
		echo 'Nothing Found';
	}