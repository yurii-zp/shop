<?php
	session_start();
	function __autoload($class) {
		include '../classes/'.$class.'.class.php';
	}
	if(isset($_POST['cartid'])) {
		$cartid = $_POST['cartid'];
		$cartitem = Item::fromDb($cartid);
		$price = $cartitem->pricesale;

		if(isset($_SESSION['reguser'])) {
			$login = $_SESSION['reguser'];
		}
		elseif(isset($_SESSION['regadmin'])) {
			$login = $_SESSION['regadmin'];
		}
		else {
			$login = null;
		}
		if(!isset($_SESSION['orderid'])) {
			$_SESSION['orderid'] = uniqid();
		}
		$orderid = $_SESSION['orderid'];
		$tz = date_default_timezone_set('Europe/Kiev');
		$datein = @date('Y-m-d H:i:s');

		$addcart = new Cart($cartid, $price, $login, $orderid, $datein);
		$addcart->intoDb();
	}
	if($addcart) {
		?>
			<div class="range_wrap clearfix">
				<div class="col-sm-8">
					<div id="slider-range"></div>
				</div>
				<div class="col-sm-4">
					<input type="text" name="range" id="range" class="form-control" readonly>
					<button type="button" id="price_filter" class="btn btn-info price_filter">Show</button>
				</div>
			</div>
			<div class="catalog clearfix">
		<?php
		$db = new managerDb();
		$pdo = $db->connect();
		if(empty($_POST['cat_catid'])) {
			$sel = "SELECT it.id, it.item, it.pricesale, it.info, it.count, MIN(img.imagepath) AS imagepath
					FROM items it
					LEFT JOIN images img ON it.id = img.itemid
					GROUP BY it.id
					ORDER BY it.id DESC";
		}
		else {
			$cat_catid = $_POST['cat_catid'];
			$sel = "SELECT it.id, it.item, it.pricesale, it.info, it.count, MIN(img.imagepath) AS imagepath
					FROM items it
					LEFT JOIN images img ON it.id = img.itemid
					WHERE it.catid = '$cat_catid'
					GROUP BY it.id
					ORDER BY it.id DESC";
		}
		$res = $pdo->query($sel);
		while($row = $res->fetch()) {
			echo '<div class="col-sm-4">';
			echo '<h4 class="text-center">'.$row['item'].'</h4>';
			if(!empty($row['imagepath'])) {
				$imagepath = substr($row['imagepath'], 3);
				echo '<img src="'.$imagepath.'">';
			}
			else {
				echo '<img src="images/layout/item_placeholder.png">';
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
	}