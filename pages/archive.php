<div class="archive_block">
	<h2 class="text-center">Products in archive</h2>
	<?php
		$db = new ManagerDb();
		$pdo = $db->connect();

		$sel = 'SELECT * FROM archives';
		$res = $pdo->query($sel);
		$rowcount = $res->rowCount();
		if($rowcount) {
	?>
			<form method="post" action="inc/archive_update.php" class="form-inline">
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
			</form>
	<?php
		} 
		else {
			echo '<h3>There are no products in the archive</h3>';
		}
	?>
</div>