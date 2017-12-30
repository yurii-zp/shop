<?php
	$db = new managerDb();
	$pdo = $db->connect();

	$sel = 'SELECT * FROM items';
	$res = $pdo->query($sel);
	$countitem = $res->rowCount();
	if($countitem != 0) {
?>
	<div class="catalog_block row">
		<h2 class="text-center">
			Our Products
			<span>Select category and price range for all products below</span>
		</h2>
		<form method="post" action="inc/category_filter.php" class="form-horizontal">
			<div class="cat_wrap clearfix">
				<div class="error col-sm-12">
					<div class="alert alert-danger"></div>
				</div>
				<label class="col-sm-2 col-xs-3 col-xs-offset-1 control-label">Select category: </label>
				<div class="col-sm-8 col-xs-7">
					<select name="cat_catid" id="cat_catid" class="form-control">
						<option value="0">All</option>

						<?php
							$sel1 = 'SELECT * FROM categories';
							$res1 = $pdo->query($sel1);
							while($row = $res1->fetch()) {
								echo '<option value="'.$row['id'].'">'.$row['category'].'</option>';
							}
						?>

					</select>
				</div>
			</div>
			<!-- when category or price range selected, items will be add here from category_filter.php-->
			<div id="ajax-catalog">
				<div class="range_wrap clearfix">
					<div class="col-xs-8">
						<div id="slider-range"></div>
					</div>
					<div class="col-xs-4">
						
						<input type="text" name="range" id="range" class="form-control" readonly>
						<button type="button" id="price_filter" class="btn btn-info price_filter">Show</button>
					</div>
				</div>
				<div class="catalog clearfix">

					<?php
						// show all items
						$sel2 = "SELECT it.id, it.item, it.pricesale, it.info, it.count, MIN(img.imagepath) AS imagepath
								 FROM items it
								 LEFT JOIN images img ON it.id = img.itemid
								 GROUP BY it.id
								 ORDER BY it.id DESC";
						$res2 = $pdo->query($sel2);
						while($row = $res2->fetch()) {
							echo '<div class="col-sm-4 col-xs-6">';
							echo '<h4 class="text-center">'.$row['item'].'</h4>';
							if(!empty($row['imagepath'])) {
								$imagepath = substr($row['imagepath'], 3);
								echo '<div class="item_img" style="background-image: url('.$imagepath.'); "></div>';
							}
							else {
								echo '<div class="item_img" style="background-image: url(images/layout/item_placeholder.png); "></div>';
							}
							echo '<div class="excerpt">';
							$excerpt = substr($row['info'], 0, strpos($row['info'],'</p>'));
							echo $excerpt.'</p>';
							echo '</div>';
							echo '<h3 class="text-danger text-right">$'.$row['pricesale'].'</h3>';
							if($row['count'] != 0) {
								echo '<div class="text-right">';
								echo '<a href="pages/iteminfo.php?item='.$row['id'].'" target="_blank" class="btn btn-sm btn-info">View More</a>';
								echo '<button type="button" id="cart'.$row['id'].'" class="btn btn-sm btn-success to_cart">Add to Cart</button>';
								echo '</div></div>';
							}
							else {
								echo '<span class="text-warning">Not in stock</span>';
								echo '<input type="hidden" value="'.$row['id'].'">';
								echo '<a href="#" class="btn btn-sm btn-primary pull-right">To order</a></div>';
							}
						}
					?>
				</div>
			</div>
		</form>
	</div>
<?php
	}
	else {
		echo "<h2 class='text-center'>Unfortunately, now we don't have any products.</h2>";
	}
?>