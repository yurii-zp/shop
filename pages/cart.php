<div class="cart_block">
	<h2 class="text-center">
		My Cart
		<span>Look at statistics for all products in the cart</span>
	</h2>

	<?php 
		// if user has already purchased products before
		if(isset($orderid)) {
			$cart_count = Cart::counter($orderid);
			// if user have items in the cart
			if($cart_count != 0) {
			?>
				<form method="post" action="inc/cart_buy_delete.php" class="cart_form">
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

								<?php
									$db = new managerDb();
									$pdo = $db->connect();

									$sel = 'SELECT id, itemid, orderid FROM carts WHERE orderid = ?';
									$ps = $pdo->prepare($sel);
									$ps->execute(array($orderid));

									foreach ($ps as $row) {
										// get info for current item
										$itemdata = Item::fromDb($row['itemid']);
										$excerpt = substr($itemdata->info, 0, strpos($itemdata->info,'</p>'));
										// get first image for current item
										$itemimg = Image::fromDb($row['itemid']);
										$imagepath = substr($itemimg->imagepath, 3);
										echo '<tr>';
										echo '<td><h4 class="text-center">'.$itemdata->item.'</h4></td>';
										echo '<td><img src="'.$imagepath.'"></td>';
										echo '<td>'.$excerpt.'</p></td>';
										echo '<td>$'.$itemdata->pricesale.'</td>';
										echo '<td>';
										echo '<button type="button" id="delcart'.$row['id'].'" data-itemid="'.$row['itemid'].'" class="btn btn-md btn-warning del_cart">Delete Item</button>';
										echo '<button type="button" id="buycart'.$row['itemid'].'" class="btn btn-md btn-success buy_cart">Buy Now</button>';
										echo '</td>';
										echo '</tr>';
									}
									// get total price for all products
									$username = isset($login) ? strval($login) : 0;
									$total = Cart::totalPrice($username, $orderid);
								?>

							</tbody>
						</table>
					</div>
					<div class="nth_padding clearfix">
						<div class="col-xs-6">
							<?php
								if(isset($login)) {
									echo '<h3 class="text-success">Current discount: '.$user->discount.'%</h3>';
								}
								else {
									echo '<h3 class="text-success">Your order: '.$row['orderid'].'</h3>';
								}
							?>
						</div>
						<div class="col-xs-6">
							<h2 class="text-right text-info">IN TOTAL: $<?php echo $total; ?></h2>
						</div>
					</div>
				</form>

			<?php
			}
			// if user does not have items in the cart
			else { 
				echo '<h3 class="text-center">You have no shopping cart. Look our products on <a href="index.php?menu=1">Catalog</a> page.</h3>';
			}
		}
		// if user doesen't purchased products before
		else {
		?>
			<h3 class="text-center">You have no shopping cart. Look our products on <a href="index.php?menu=1">Catalog</a> page.</h3>
			<div class="order_wrap text-center">	
				<span id="setorder" class="setorder text-info">I'm non registered user</span>
				<div>
					<span class="close">×</span>
					<form method="post" action="index.php?menu=2" class="order_form" role="form" data-toggle="validator">
						<div class="form-group has-feedback">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-cog"></i></span>
								<input type="text" name="ordernum" placeholder="Enter the order number" id="ordernum" class="form-control" maxlength="32" 
								data-error="Please, enter your order." autocomplete="off" required>
							</div>
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							<div class="help-block with-errors text-left"></div>
						</div>
						<button type="submit" name="getorder" class="btn btn-primary">
							Send
							<span class="glyphicon glyphicon-send"></span>
						</button>
					</form>
				</div>
			</div>
		<?php 
			if(isset($_POST['getorder'])) {
				$ordernum = trim($_POST['ordernum']);
				$order = User::getOrder($ordernum);
				if($order) {
					echo '<script>window.location=document.URL</script>';
				}
				else {
					echo '<p class="text-center text-danger">Not correct order number</p>';
				}
			}
		}
		?>
</div>