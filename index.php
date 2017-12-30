<?php
	session_start();
	function __autoload($class) {
		include_once 'classes/'.$class.'.class.php';
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" type="image/png" href="images/layout/favicon.png">
		<link rel="stylesheet" type="text/css" href="css/slick-theme.css" />
		<link rel="stylesheet" type="text/css" href="css/slick.css" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css" />
		<link rel="stylesheet" type="text/css" href="css/mCustomScrollbar.min.css" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/responsive.css" />
		<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
		<title>Shop</title>
	</head>
	<body>
		<div id="preloader"></div>

	<!-- Start registration & authentification modal -->
		<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
			<div class="modal-dialog">
				<div class="error">
					<div class="alert alert-danger fade in"></div>
				</div>
				<div id="ajax-content" class="modal-content">
					<!-- form will be add here -->
				</div>
			</div>

		</div>
	<!-- Start item insert & update modal -->
		<div class="modal fade" id="upd_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
			<div class="modal-dialog">
				<div class="error">
					<div class="alert alert-danger fade in"></div>
				</div>
				<div class="modal-content">
					<form method="post" action="index.php?menu=5" enctype="multipart/form-data" class="item_form" role="form" data-toggle="validator">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Update Item</h4>
						</div>
						<div class="modal-body clearfix">
							<div class="form-group has-feedback">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-plus"></i></span>
									<input type="text" name="item" id="upd_name" class="form-control" placeholder="Item name" autocomplete="off" maxlength="64" 
									data-error="Please, enter the item." required>
								</div>
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-cog"></i></span>
											<input type="number" name="count" id="upd_count" class="form-control" min="1" value="1" placeholder="Amount">
										</div>
									</div>
									<div class="col-md-4">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
											<input type="number" name="pricein" id="upd_pricein" class="form-control" min="0.01" step="0.01" placeholder="Price" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
											<input type="number" name="pricesale" id="upd_pricesale" class="form-control" min="0.01" step="0.01" placeholder="Selling price" required>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group has-feedback">
								<textarea rows="7" name="item_info" placeholder="Description" id="upd_itemeditor" class="form-control" data-error="Please, enter item description."></textarea>
								<div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="reset" class="btn btn-default">
								Reset
								<span class="glyphicon glyphicon-refresh"></span>
							</button>
							<div class="uploader_wrap">
								<input type="file" name="img[]" id="file" multiple accept="image/*">
								<a href="#" class="btn btn-info pseudo_uploader">Add Images</a>
							</div>
							<input type="hidden" name="item_id" id="item_id">
							<button type="submit" name="upd_item" id="upd_item" class="btn btn-success">
								<span>Update Item</span>
								<span class="glyphicon glyphicon-send"></span>
							</button>
						</div>
					</form>
				</div>
			</div>

		</div>
	<!-- End modals -->

		<div class="main_wrap">
			<header class="header clearfix">
				<div class="header_wrap">
					<a href="index.php" class="logo">Shop</a>
					<div class="navigation_wrap">
						<nav class="main_navigation">
							<a href="#" class="mob_close_btn"></a>
							<?php include_once("inc/menu.php"); ?>
						</nav>
					</div>
					<a href="index.php?menu=2" class="cart">
						<span>
							<?php
								if(isset($_SESSION['orderid'])) {
									$orderid = $_SESSION['orderid'];
									$count = Cart::counter($orderid);
									echo $count;
								}
								else {
									echo 0;
								}
							?>
						</span>
					</a>

					<?php
						// open session for current user
						if(isset($_SESSION['reguser']) || isset($_SESSION['regadmin'])) :
							if( isset($_SESSION['reguser']) ) {
								$login = $_SESSION['reguser'];
							}
							else {
								$login = $_SESSION['regadmin'];
							}
					?>
						<div class="profile">
							<div class="avatar">

								<?php
									// show user avatar
									$user = User::fromDb($login);
									if($user->avatar) {
										$avatar = base64_encode($user->avatar);
										echo '<img src="data:image/jpg; base64,'.$avatar.'" alt="avatar" />';
									}
									else {
										echo '<img src="images/layout/avatar_placeholder.png">';
									}
								?>
								<div class="overlay"></div>
							</div>
							<div class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
									<?php echo $login; ?>
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu">
									<li>
										<a href="index.php?menu=3">Profile</a>
									</li>
									<li>
										<?php
											if(!isset($_POST['logout'])) {
										?>
												<form method="post" action="index.php">
													<input type="submit" name="logout" value="Logout">
												</form>
										<?php
											}
											else {
												// unset session for current user
												if(isset($_SESSION['reguser'])) {
													unset($_SESSION['reguser']);
												}
												if(isset($_SESSION['regadmin'])) {
													unset($_SESSION['regadmin']);
												}
												if(isset($_SESSION['orderid'])) {
													unset($_SESSION['orderid']);
												}
												echo '<script>window.location=document.URL</script>';
											}
										?>
									</li>
								</ul>
							</div>
						</div>

					<?php else : ?>

						<div class="reg_box">
							<a href="inc/signin.php" class="signin modal-ajax" data-toggle="modal" data-target="#modal">Sign In</a>
							<span>OR</span>
							<a href="inc/signup.php" class="signup modal-ajax" data-toggle="modal" data-target="#modal">Sing Up</a>
						</div>

					<?php endif; ?>
					<a href="#" class="mob_btn"></a>
				</div>
			</header>
			<main>
				<?php
					// display main content only on 'Homepage'
					if($_SERVER['PHP_SELF'] == $_SERVER['REQUEST_URI']) :
				?>
					<section class="home_banner">
						<ul class="main_slider">
							<li style="background-image: url(images/layout/slide.jpg);">
								<div class="banner_wrap">
									<div class="banner_text">
										<h2>Shop the best phones</h2>
										<p>Our extensive and affordable range features the very latest electronics and gadgets including smart phones, cases, headphones.</p>
									</div>
								</div>
							</li>
							<li style="background-image: url(images/layout/slide2.jpg);">
								<div class="banner_wrap">
									<div class="banner_text">
										<h2>
											Samsung Galaxy Note8
											<span>One of the best choise today!</span>
										</h2>
										<ul>
											<li>Infinity Screen</li>
											<li>Dual Camera</li>
											<li>64GB Internal Memory</li>
											<li>Android 7.1 Nougat</li>
										</ul>
										<div>
											<a href="index.php?menu=1" class="btn btn-lg btn-success">Buy Now</a>
										</div>
									</div>
								</div>
							</li>
							<li style="background-image: url(images/layout/slide3.jpg);">
								<div class="banner_wrap">
									<div class="banner_text">
										<h2>Get a new iPhone X <br> and save $300</h2>
										<ul>
											<li>5.8" Super Retina HD Display</li>
											<li>12MP Wide-Angle and Telephoto Cameras</li>
											<li>7MP FaceTime HD Camera</li>
											<li>iOS 11</li>
											<li>Bluetooth 5.0</li>
										</ul>
										<div>
											<a href="index.php?menu=1" class="btn btn-lg btn-success">Buy Now</a>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</section>
					<section class="main_content">
						<div class="container">
							<h1 class="text-center"><span>Internet Shop</span>: widest selection of quality products at the wholesale prices online.</h1>
							<div class="catalog">
								<?php
									$db = new ManagerDb();
									$pdo = $db->connect();
									// select last three items from each category
									$sel = 'SELECT i1.id, i1.item, i1.catid, i1.pricesale
											FROM items i1
											LEFT OUTER JOIN items i2
											ON (i1.catid = i2.catid AND i1.id < i2.id)
											GROUP BY i1.id
											HAVING COUNT(*) < 3
											ORDER BY catid';
									$ps = $pdo->query($sel);
									foreach($ps as $row) {
										echo '<div class="col-sm-4 col-xs-6">';
										echo '<a href="pages/iteminfo.php?item='.$row['id'].'" target="_blank">';
										echo '<h4>'.$row['item'].'</h4>';
										// select first imagepath for each items
										$sel1 = 'SELECT imagepath 
												 FROM images 
												 WHERE itemid = ? 
												 LIMIT 1';
										$ps1 = $pdo->prepare($sel1);
										$ps1->execute(array($row['id']));
										foreach($ps1 as $row1) {
											if(!empty($row1['imagepath'])) {
												$imagepath = substr($row1['imagepath'], 3);
												echo '<div class="item_img" style="background-image: url('.$imagepath.'); "></div>';
											}
											else {
												echo '<div class="item_img" style="background-image: url(images/layout/item_placeholder.png); "></div>';
											}
										}
										echo '<h3>$'.$row['pricesale'].'</h3>';
										echo '</a>';
										echo '</div>';
									}
								?>
							</div>
						</div>
					</section>
					<section class="catalog_sec">
						<div class="container">
							<h2 class="text-center">Online Shopping for Mobiles is Safe and Fun</h2>
							<p>With the advent of online shopping portals, purchasing mobiles have become an effortless task. The emergence of these portals have made it convenient for shoppers to have plethora of products on one platform, which makes their job of researching and comparing between various products, then, finally choosing the one that suits them the best easy and quick. In fact, it saves a lot of time! Hence, if you are planning to buy mobile online, 'Online Shop' showcases a huge array of high end smartphone as well as budget mobiles that suits every pocket.</p>
							<p>Many people, now-a-days prefer online shopping site to buy mobile phones. The sole reason to buy mobile online being, just on one platform, you get an easy access of various types of mobile phones. Also, one can check out different mobile phone prices and buy according to one's needs and budget. Every now and then, we have offers, deals, discounts that will make your shopping experience more delightful.</p>
							<p>'Online Shop' logistics ensures that mobiles are delivered safe at your place. Customers can track details of shipping online. What more you expect? Tell us and we will leave no stone unturned to fulfil your demands. Cause, the new mobiles on our site, are waiting to add quotient to your style!</p>
							<div class="text-center">
								<a href="index.php?menu=1" class="btn btn-lg btn-success">View Catalog</a>
							</div>
						</div>
					</section>
				<?php
					// show inner pages
					else :
				?>
					<section class="inner_content">
						<div class="container">
							<?php
								if (isset($_GET['menu'])) {
									if ($_GET['menu'] == 1) include_once("pages/catalog.php");
									if ($_GET['menu'] == 2) include_once("pages/cart.php");
									if(isset($_SESSION['reguser']) || isset($_SESSION['regadmin'])) {
										if ($_GET['menu'] == 3) include_once("pages/profile.php");
									}
									if(isset($_SESSION['regadmin'])) {
										if ($_GET['menu'] == 4) include_once("pages/archive.php");
										if ($_GET['menu'] == 5) include_once("pages/admin.php");
									}
								}
							?>
						</div>
					</section>
				<?php endif; ?>
			</main>
		</div>
		<footer class="footer">
			<div class="container text-center">
				<span>Internet Shop Project. Kirichenko &copy; 2017. <span>All Rights Reserved.</span></span>
			</div>
		</footer>
		<script type="text/javascript" src="js/ckeditor.js"></script>
		<script type="text/javascript" src="js/slick.js"></script>
		<script type="text/javascript" src="js/jquery.raty.min.js"></script>
		<script type="text/javascript" src="js/validator.js"></script>
		<script type="text/javascript" src="js/jquery.md5.js"></script>
		<script type="text/javascript" src="js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="js/mCustomScrollbar.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
	</body>
</html>