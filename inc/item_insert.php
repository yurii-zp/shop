<?php
	session_start();
	function __autoload($class) {
		include '../classes/'.$class.'.class.php';
	}
	$output = '';
	$message = '';
	$itemname = trim($_POST['item']);
	$pricein = $_POST['pricein'];
	$pricesale = $_POST['pricesale'];
	$info = $_POST['item_info'];
	$count = $_POST['count'];
	// Get item data from DB and update it
	if(!empty($_POST['item_id'])) {
		$item_id = $_POST['item_id'];
		$curr_item = Item::fromDb($item_id);

		$db = new managerDb();
		$pdo = $db->connect();

		$upd = 'UPDATE items 
				SET item = ?, pricein = ?, pricesale = ?, info = ?, count = ? 
				WHERE id = ?';
		$ps = $pdo->prepare($upd);
		$ps->execute(array(
			$itemname,
			$pricein,
			$pricesale,
			$info,
			$count,
			$item_id
		));

		if(is_array($_FILES)) {
	    	foreach ($_FILES as $key => $val) {
				if(substr($key, 0, 3) == 'img') {
		           foreach ($_FILES['img']['name'] as $key => $value) {
						if($_FILES['img']['error'][$key] != 0) {
							continue;
						}
						else {
			                $value = $curr_item->id.'-'.$value;
							$dir_path = '../images/content/'.$curr_item->catid.'/'.$curr_item->id.'/';
							if(file_exists($dir_path)) {
								if(move_uploaded_file($_FILES['img']['tmp_name'][$key], $dir_path.$value)) {
									$img = new Image($dir_path.$value, $curr_item->id, $curr_item->catid);
									$img->intoDb();
								}
							}
							else {
								mkdir($dir_path, 0777, true);

								if(move_uploaded_file($_FILES['img']['tmp_name'][$key], $dir_path.$value)) {
									$img = new Image($dir_path.$value, $curr_item->id, $curr_item->catid);
									$img->intoDb();
								}
							}
						}                 
		        	}
				}
			}            
		}
		$message = 'Item "'.$curr_item->item.'" Updated';
	}
	// Add item data into DB
	else {
		$catid = $_POST['catid'];

    	$db = new managerDb();
		$pdo = $db->connect();

		if(is_array($_FILES)) {
			foreach ($_FILES['img']['name'] as $key => $value) {
				if($_FILES['img']['error'][$key] != 0) {
					continue;
				}
				else {
					$itemid = $db->getNextID('items');
				    $value = $itemid.'-'.$value;
					$dir_path = '../images/content/'.$catid.'/'.$itemid.'/';
					if(file_exists($dir_path)) {
						if(move_uploaded_file($_FILES['img']['tmp_name'][$key], $dir_path.$value)) {
							$img = new Image($dir_path.$value, $itemid, $catid);
							$img->intoDb();
						}
					}
					else {
						mkdir($dir_path, 0777, true);

						if(move_uploaded_file($_FILES['img']['tmp_name'][$key], $dir_path.$value)) {
							$img = new Image($dir_path.$value, $itemid, $catid);
							$img->intoDb();
						}
					}
				}
			}
		}

    	$item = new Item($itemname, $catid, $pricein, $pricesale, $info, $count);
		$item->intoDb();
		$message = 'Item "'.$itemname.'" Added';
	}

    if(isset($ps) || isset($item)) {
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