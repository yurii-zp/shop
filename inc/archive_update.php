<?php
	session_start();
	function __autoload($class) {
		include '../classes/'.$class.'.class.php';
	}
	ob_start();
	if(isset($_POST['upd_id']) && isset($_POST['upd_itemid']) && isset($_POST['upd_count'])) {
		$upd_id = $_POST['upd_id'];
		$upd_itemid = $_POST['upd_itemid'];
		$upd_count = $_POST['upd_count'];

		$db = new ManagerDb();
		$pdo = $db->connect();
		$del = 'DELETE FROM archives WHERE id = ?';
		$ps = $pdo->prepare($del);
		$ps->execute(array($upd_id));

		$upd = 'UPDATE items SET count = ? WHERE id = ?';
		$ps = $pdo->prepare($upd);
		$ps->execute(array($upd_count, $upd_itemid));

		$sel = 'SELECT * FROM archives';
		$res = $pdo->query($sel);
		$rowcount = $res->rowCount();
		if($rowcount) {
?>
			<div class="error">
				<div class="alert alert-danger fade in"></div>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered table_scrolling">
					<thead>
						<tr>
							<th>Item name</th>
							<th>Category</th>
							<th>Pricein</th>
							<th>Pricesale</th>
							<th>Datesale</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
			<?php
				while($row = $res->fetch()) {
					$arch_item = Item::fromDb($row['itemid']);
					$arch_cat = Category::fromDb($arch_item->catid);

					$datetime = new DateTime($row['datesale']);
					$date_format = $datetime->format("m-d-y H:i");
					echo '<tr>';
					echo '<td>'.$row['item'].'</td>';
					echo '<td>'.$arch_cat->category.'</td>';
					echo '<td>'.$row['pricein'].'</td>';
					echo '<td>'.$row['pricesale'].'</td>';
					echo '<td>'.$date_format.'</td>';
					echo '<td>';
					echo '<input type="hidden" class="upd_itemid" value="'.$row['itemid'].'">';
					echo '<input type="number" min="1" name="upd_count" value="1" class="form-control">';
					echo '<button type="button" id="upd'.$row['id'].'" class="btn btn-success upd_id">Update Item</button>';
					echo '</td>';
					echo '</tr>';
				}
			?>
					</tbody>
				</table>
			</div>
<?php	
		}
		else {
			echo '<h3 class="text-center">There are no products in the archive</h3>';
		}
	}
	else {
		echo '<h3 class="text-center">There are no products in the archive</h3>';
	}
	$content = ob_get_contents();
	ob_end_clean();
	echo json_encode($content);
?>