<?php
	session_start();
	function __autoload($class) {
		include '../classes/'.$class.'.class.php';
	}

	$db = new managerDb();
	$pdo = $db->connect();
	$output = '';
	$cart_id = $_POST['cart_id'];
	$item_id = $_POST['item_id'];
	// get user login and order
	if(isset($_SESSION['reguser'])) {
		$login = $_SESSION['reguser'];
	}
	elseif(isset($_SESSION['regadmin'])) {
		$login = $_SESSION['regadmin'];
	}
	else {
		$login = null;
	}
	if(isset($_SESSION['orderid'])) {
		$orderid = $_SESSION['orderid'];
	}
	// if user buys product
	if(isset($_POST['buy_id'])) {
		$buy_id = $_POST['buy_id'];
		// set discount
		$sel = 'SELECT price FROM carts WHERE id = ?';
		$ps = $pdo->prepare($sel);
		$ps->execute(array($cart_id));
		foreach ($ps as $row) {
			// without discount for unregistered user
			if(!isset($login)) {
				$curr_price = $row['price'];
			}
			// with discount for registered user
			else {
				$curr_price = Purchase::getDiscount($login, $row['price']);
			}
			$tz = date_default_timezone_set('Europe/Kiev');
			$datein = @date('Y-m-d H:i:s');
			$buy = new Purchase($item_id, $curr_price, $login, $orderid, $datein);
			$buy->intoDb();
			if(isset($login)) {
				$buy->setDiscount($login);
				$buy->setRating($login);
			}
			$delcart = Cart::delCart($cart_id);
		}
	}
	// if user delete product from cart
	else {
		$delcart = Cart::delCart($cart_id);
		$item = Item::fromDb($item_id);
		$setcount = $item->count + 1;
		$upd = 'UPDATE items SET count = ? WHERE id = ?';
		$ps = $pdo->prepare($upd);
		$ps->execute(array($setcount, $item->id));
	}
	// prepare content
	$cart_count = Cart::counter($orderid);
	if($cart_count != 0) {
		$sel1 = 'SELECT id, itemid, orderid FROM carts WHERE orderid = ?';
		$ps1 = $pdo->prepare($sel1);
		$ps1->execute(array($orderid));
		$output .= '
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Item name</th>
							<th>&nbsp;</th>
							<th>Info</th>
							<th>Price</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
		';
		foreach ($ps1 as $row) {
			// get info for current item
			$itemdata = Item::fromDb($row['itemid']);
			$excerpt = substr($itemdata->info, 0, strpos($itemdata->info,'</p>'));
			// get first image for current item
			$itemimg = Image::fromDb($row['itemid']);
			$imagepath = substr($itemimg->imagepath, 3);
			$total = Cart::totalPrice($login, $orderid);
			$output .= '
				<tr>
					<td><h4 class="text-center">'.$itemdata->item.'</h4></td>
					<td><img src="'.$imagepath.'"></td>
					<td>'.$excerpt.'</p></td>
					<td>$'.$itemdata->pricesale.'</td>
					<td>
						<button type="button" id="delcart'.$row['id'].'" data-itemid="'.$row['itemid'].'" class="btn btn-md btn-warning del_cart">Delete Item</button>
						<button type="button" id="buycart'.$row['itemid'].'" class="btn btn-md btn-success buy_cart">Buy Now</button>
					</td>						
				</tr>
			';
		}
		$output .= '
					</tbody>
				</table>
			</div>
			<div class="nth_padding clearfix">
				<div class="col-xs-6">
		';
					if(isset($login)) {
						$user = User::fromDb($login);
						$output .= '<h3 class="text-success">Current discount: '.$user->discount.'%</h3>';
					}
					else {
						$output .= '<h3 class="text-success">Your order: '.$row['orderid'].'</h3>';
					}
		$output .= '
				</div>
				<div class="col-xs-6">
					<h2 class="text-right text-info">IN TOTAL: $'.$total.'</h2>
				</div>
			</div>
		';
	}
	else {
		if($buy_id) {
			$output = '<h3 class="text-center">All goods were purchased!<br>Want more shopping? Look our products on <a href="index.php?menu=1">Catalog</a> page.</h3>';
		}
		else {
			$output = '<h3 class="text-center">You have no shopping cart. Look our products on <a href="index.php?menu=1">Catalog</a> page.</h3>';
		}
	}
	// display content after request
	echo $output;