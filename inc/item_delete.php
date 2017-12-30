<?php
	session_start();
	function __autoload($class) {
		include '../classes/'.$class.'.class.php';
	}
	$output = '';
	$message = '';
	if(isset($_POST['item_id'])) {
		$item_id = $_POST['item_id'];

		$db = new managerDb();
		$pdo = $db->connect();
		$curr_item = Item::fromDb($item_id);
		$curr_item->delItem($curr_item->catid, $item_id);
		$message = 'Item "'.$curr_item->item.'" Deleted';

		$output .= '<label class="text-success">' .$message. '</label>
					<div class="error">
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
		$sel = 'SELECT it.id, it.item, it.catid, ca.category
				FROM items it, categories ca
				WHERE it.catid = ca.id
				ORDER BY it.id ASC';
		$res = $pdo->query($sel);
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
	}
	echo $output;