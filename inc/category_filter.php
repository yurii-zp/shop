<?php
	function __autoload($class) {
		include_once '../classes/'.$class.'.class.php';
	}

	$db = new managerDb();
	$pdo = $db->connect();

	$cat_catid = $_POST['cat_catid'];
	// if price range filter not used
	if(isset($_POST['cat_catid']) && !isset($_POST['range'])) {
		if(!empty($cat_catid)) {
			$sel = "SELECT it.id, it.item, it.pricesale, it.info, it.count, MIN(img.imagepath) AS imagepath
					FROM items it
					LEFT JOIN images img ON it.id = img.itemid
					WHERE it.catid = '$cat_catid'
					GROUP BY it.id
					ORDER BY it.id DESC";
		}
		else {
			$sel = "SELECT it.id, it.item, it.pricesale, it.info, it.count, MIN(img.imagepath) AS imagepath
					FROM items it
					LEFT JOIN images img ON it.id = img.itemid
					GROUP BY it.id
					ORDER BY it.id DESC";
		}
		$res = $pdo->query($sel);
	}
	// if used price range filter
	elseif(isset($_POST['cat_catid']) && isset($_POST['range'])) {
		$line = $_POST['range'];
		$range = explode('-', $line);
		$symbol = '$';
		if(stristr($range[0], $symbol) && stristr($range[1], $symbol)) {
			$range[0] = substr($range[0], 1);
			$range[1] = substr($range[1], 2);
		}
		// if category selected
		if(!empty($cat_catid)) {
			$sel = "SELECT it.id, it.item, it.pricesale, it.info, it.count, MIN(img.imagepath) AS imagepath
					FROM items it
					LEFT JOIN images img ON it.id = img.itemid
					WHERE it.pricesale > '$range[0]'
					AND it.pricesale < '$range[1]'
					AND it.catid = '$cat_catid'
					GROUP BY it.id
					ORDER BY it.pricesale DESC";
		}
		// if category not selected
		else {
			$sel = "SELECT it.id, it.item, it.pricesale, it.info, it.count, MIN(img.imagepath) AS imagepath
					FROM items it
					LEFT JOIN images img ON it.id = img.itemid
					WHERE it.pricesale > '$range[0]'
					AND it.pricesale < '$range[1]'
					GROUP BY it.id
					ORDER BY it.pricesale DESC";
		}
		$res = $pdo->query($sel);
		// if there are no products in the price range
		if($res->rowCount() == 0) {
		?>
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
				<h2 class="text-center">Nothing found</h2>
			</div>
		<?php
			exit();
		}
	}
	// if there are products in the price range
	?>
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
		while($row = $res->fetch()) {
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
		echo '</div>';