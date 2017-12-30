<?php
	session_start();
	function __autoload($class) {
		include_once '../classes/'.$class.'.class.php';
	}

	$itemid = substr($_SERVER['QUERY_STRING'], 5);
	$curr_item = Item::fromDb($itemid);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" type="image/png" href="../images/layout/favicon.png">
		<link rel="stylesheet" type="text/css" href="../css/slick-theme.css" />
		<link rel="stylesheet" type="text/css" href="../css/slick.css" />
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="../css/jquery-ui.min.css" />
		<link rel="stylesheet" type="text/css" href="../css/mCustomScrollbar.min.css" />
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
		<link rel="stylesheet" type="text/css" href="../css/responsive.css" />
		<script type="text/javascript" src="../js/jquery-1.12.4.min.js"></script>
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
	<!-- End modals -->
		<div class="main_wrap">
			<header class="header clearfix">
				<div class="header_wrap">
					<a href="../index.php" class="logo">Shop</a>
					<div class="navigation_wrap">
						<nav class="main_navigation">
							<a href="#" class="mob_close_btn"></a>
							<ul>
								<li><a href="../index.php?menu=1">Catalog</a></li>
								<?php if(isset($_SESSION['regadmin'])) : ?>
									<li><a href="../index.php?menu=4">Archive</a></li>
									<li><a href="../index.php?menu=5">Admin Area</a></li>
								<?php endif; ?>
							</ul>
						</nav>
					</div>
					<a href="../index.php?menu=2" class="cart">
						<span>
							<?php
								if (isset($_SESSION['orderid'])) {
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
										echo '<img src="../images/layout/avatar_placeholder.png">';
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
										<a href="../index.php?menu=3">Profile</a>
									</li>
									<li>
										<?php
											if(!isset($_POST['logout'])) {
										?>
												<form method="post" action="../index.php">
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
							<a href="../inc/signin.php" class="signin modal-ajax" data-toggle="modal" data-target="#modal">Sign In</a>
							<span>OR</span>
							<a href="../inc/signup.php" class="signup modal-ajax" data-toggle="modal" data-target="#modal">Sing Up</a>
						</div>

					<?php endif; ?>
					<a href="#" class="mob_btn"></a>
				</div>
			</header>
			<main>
				<section class="inner_content">
					<div class="container">
					<!-- Start single item content -->
						<div class="item_block clearfix">
							<div class="col-sm-6">
								<h2 class="text-center"><?php echo $curr_item->item; ?></h2>
								<p><?php echo $curr_item->info; ?></p>
								<h3 class="text-danger">$<?php echo $curr_item->pricesale; ?></h3>
							</div>
							<div class="col-sm-6">

								<?php
									$db = new managerDb();
									$pdo = $db->connect();

									$sel = 'SELECT imagepath FROM images WHERE itemid ='.$itemid;
									$res = $pdo->query($sel);
									$rowcount = $res->rowCount();
									if($rowcount) {
										echo '<ul class="item_slider">';
										while($row = $res->fetch()) {
											echo '<li><img src="'.$row['imagepath'].'" alt="Image"></li>';
										}
										echo '</ul>';
									}
									else {
										echo '<img src="../images/layout/item_placeholder.png">';
									}
								?>

							</div>
						</div>
						<div class="comment_block all">
							<h3>Reviews</h3>
							<?php $show_comment = Comment::showComm($itemid); ?>

						</div>
						<?php if(isset($login)) : ?>

							<div class="comment_block add">
								<h3>Bought goods? Leave a review below!</h3>
								<form method="post" action="../inc/comment_insert.php" class="form-horizontal" role="form" data-toggle="validator">
									<div class="form-group">
										<div class="col-xs-8">
											<input type="hidden" id="itemid" name="itemid" value="<?php echo $itemid ?>">
											<input type="text" id="comm_title" name="comm_title" class="form-control" placeholder="Title">
										</div>
										<div class="col-xs-4">
											<label class="control-label">Rating:</label>
											<span id="rating_in" class="rating" data-rating="5"></span>
										</div>
									</div>
									<div class="form-group has-feedback">
										<div class="col-sm-12">
											<textarea name="comm" id="comm" rows="7" class="form-control" placeholder="Comment..." data-error="Please, enter your comment." required></textarea>
											<div class="help-block with-errors"></div>
										</div>
									</div>
									<button type="submit" id="add_comm" class="btn btn-primary">
										Add comment
										<span class="glyphicon glyphicon-send"></span>
									</button>
								</form>
							</div>

						<?php endif; ?>
					<!-- End single item content -->

					</div>
				</section>
			</main>
		</div>
		<footer class="footer">
			<div class="container text-center">
				<span>Internet Shop Project. Kirichenko &copy; 2017. All Rights Reserved.</span>
			</div>
		</footer>
		<script type="text/javascript" src="../js/ckeditor.js"></script>
		<script type="text/javascript" src="../js/slick.js"></script>
		<script type="text/javascript" src="../js/jquery.raty.min.js"></script>
		<script type="text/javascript" src="../js/validator.js"></script>
		<script type="text/javascript" src="../js/mCustomScrollbar.min.js"></script>
		<script type="text/javascript" src="../js/jquery.md5.js"></script>
		<script type="text/javascript" src="../js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/script.js"></script>
	</body>
</html>