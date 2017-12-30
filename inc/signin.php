<?php
	header ("Refresh: 0; url = ../index.php");
	session_start();
	function __autoload($class) {
		include '../classes/'.$class.'.class.php';
	}

	// display authorization form for non authorized Users
	if(!isset($_POST['signin']) && !isset($_POST['login_in']) && !isset($_POST['pass_in'])) {
		$referer = $_SERVER['HTTP_REFERER'];
		$dir = '/pages';
		if(stristr($referer, $dir)) {
			$action = "../inc/signin.php";
			$forgot = "../inc/forgot_pass.php";
		}
		else {
			$action = "inc/signin.php";
			$forgot = "inc/forgot_pass.php";
		}
?>
	<form method="post" action="<?php echo $action; ?>" id="signin" class="form-horizontal ajax-form" role="form" data-toggle="validator">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Sign In</h4>
		</div>
		<div class="modal-body clearfix">
			<div class="form-group has-feedback">
				<label for="login_in" class="control-label col-sm-4">Login</label>
				<div class="col-sm-8">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input type="text" name="login_in" id="login_in" class="form-control" minlength="3" maxlength="64" 
						data-error="Please, required this field. Minimum 3 characters." required>
					</div>
					<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					<div class="help-block with-errors"></div>
				</div>
			</div>

			<div class="form-group has-feedback">
				<label for="pass_in" class="control-label col-sm-4">Password</label>
				<div class="col-sm-8">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-cog"></i></span>
						<input type="password" name="pass_in" id="pass_in" class="form-control" minlength="4" maxlength="64"
						data-error="Please, required this field." required>
					</div>
					<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					<div class="help-block with-errors"></div>
					<a href="<?php echo $forgot; ?>" id="forgot_pass" class="modal-ajax" data-target="#modal">
						<em>Forgot Password?</em>
					</a>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">
				Cancel
				<span class="glyphicon glyphicon-remove"></span>
			</button>
			<button type="submit" name="signin" class="btn btn-primary">
				Sign In
				<span class="glyphicon glyphicon-send"></span>
			</button>
		</div>
	</form>
<?php
	}
	// validation: if password does not coincide with login
	elseif(!isset($_POST['signin']) && isset($_POST['login_in']) && isset($_POST['pass_in'])) {
		$valid = User::signIn($_POST['login_in'], $_POST['pass_in']);
		if($valid) {
			echo $_POST['login_in'];
			echo $_POST['pass_in'];
		}
		else {
			return false;
		}
	}
	// User authorization
	elseif(isset($_POST['signin'])) {
		$valid = User::signIn($_POST['login_in'], md5($_POST['pass_in']));
	}
	else {
		exit();
	}
?>