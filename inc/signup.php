<?php
	header ("Refresh: 0; url = ../index.php");
	session_start();
	function __autoload($class) {
		include '../classes/'.$class.'.class.php';
	}

	// display registration form for non registered Users
	if(!isset($_POST['signup']) && !isset($_POST['login'])) {
		$referer = $_SERVER['HTTP_REFERER'];
		$dir = '/pages';
		if(stristr($referer, $dir)) {
			$action = "../inc/signup.php";
		}
		else {
			$action = "inc/signup.php";
		}
?>
	<form method="post" action="<?php echo $action; ?>" enctype="multipart/form-data" class="form-horizontal ajax-form" role="form" data-toggle="validator">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Sign Up</h4>
		</div>
		<div class="modal-body clearfix">
			<div class="form-group has-feedback">
				<label for="login" class="control-label col-sm-4">Login *</label>
				<div class="col-sm-8">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input type="text" name="login" id="login" class="form-control" minlength="3" maxlength="64" 
						data-error="Please, required this field. Minimum 3 characters." required>
					</div>
					<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					<div class="help-block with-errors"></div>
				</div>
			</div>

			<div class="form-group has-feedback">
				<label for="email" class="control-label col-sm-4">Email *</label>
				<div class="col-sm-8">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
						<input type="email" name="email" id="email" class="form-control" data-error="Please, write the correct email address" required>
					</div>
					<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					<div class="help-block with-errors"></div>
				</div>
			</div>

			<div class="form-group has-feedback">
				<label for="pass" class="control-label col-sm-4">Password *</label>
				<div class="col-sm-8">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-cog"></i></span>
						<input type="password" name="pass" id="pass" class="form-control" minlength="4" maxlength="64"
						data-error="Please, required this field." required>
					</div>
					<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					<div class="help-block">Minimum of 4 characters</div>
				</div>
			</div>

			<div class="form-group has-feedback">
				<label for="confpass" class="control-label col-sm-4">Confirm Password *</label>
				<div class="col-sm-8">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-cog"></i></span>
						<input type="password" name="confpass" id="confpass" class="form-control" data-match="#pass" data-match-error="Passwords do not match" required>
					</div>
					<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					<div class="help-block with-errors"></div>
				</div>
			</div>

			<label class="control-label col-sm-4">Avatar</label>
			<div class="col-sm-8">
				<div class="uploader_wrap">
					<input type="hidden" name="MAX_FILE_SIZE" value="1048576">
					<input type="file" name="avatar" accept="image/*">
					<a href="#" class="btn btn-default pseudo_uploader">
						<span class="glyphicon glyphicon-star"></span>
						Select Avatar
					</a>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">
				Cancel
				<span class="glyphicon glyphicon-remove"></span>
			</button>
			<button type="submit" name="signup" class="btn btn-primary">
				Sign Up
				<span class="glyphicon glyphicon-send"></span>
			</button>
		</div>
	</form>
<?php
	}
	// validation: if login exists - create block of validation
	elseif(!isset($_POST['signup']) && isset($_POST['login'])) {
		$log = trim($_POST['login']);
		$valid = User::fromDb($log);
		if($valid) {
			return false;
		}
		else {
			echo $_POST['login'];
		}
	}
	// Add new user to DB (used method intoDb)
	else {
		$log = trim($_POST['login']);
		$pass = trim(md5($_POST['pass']));
		$em = trim($_POST['email']);
		$newuser = new User($log, $pass, $em, $_FILES['avatar'], 1);
		$newuser->intoDb();

		// open session for new user
		$_SESSION['reguser'] = $log;
		// remove unregistered user cart order
		if (isset($_SESSION['orderid'])) {
			unset($_SESSION['orderid']);
		}
	}
?>