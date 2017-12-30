<?php
	header ("Refresh: 0; url = ../index.php");
	session_start();
	function __autoload($class) {
		include '../classes/'.$class.'.class.php';
	}

	// display forgot pass form for non authorized Users
	if(!isset($_POST['change_pass']) && !isset($_POST['login_ch'])) {
		$referer = $_SERVER['HTTP_REFERER'];
		$dir = '/pages';
		if(stristr($referer, $dir)) {
			$action = "../inc/forgot_pass.php";
		}
		else {
			$action = "inc/forgot_pass.php";
		}
?>
	<form method="post" action="<?php echo $action; ?>" id="forgot" class="form-horizontal ajax-form" role="form" data-toggle="validator">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Change Password</h4>
		</div>
		<div class="modal-body clearfix">
			<div class="form-group has-feedback">
				<label for="login_ch" class="control-label col-sm-4">Login</label>
				<div class="col-sm-8">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input type="text" name="login_ch" id="login_ch" class="form-control" minlength="3" maxlength="64" 
						data-error="Please, required this field. Minimum 3 characters." required>
					</div>
					<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					<div class="help-block with-errors"></div>
				</div>
			</div>

			<div class="form-group has-feedback">
				<label for="pass_ch" class="control-label col-sm-4">New Password</label>
				<div class="col-sm-8">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-cog"></i></span>
						<input type="password" name="pass_ch" id="pass_ch" class="form-control" minlength="4" maxlength="64"
						data-error="Please, required this field." required>
					</div>
					<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					<div class="help-block">Minimum of 4 characters</div>
				</div>
			</div>

			<div class="form-group has-feedback">
				<label for="conf_pass_ch" class="control-label col-sm-4">Confirm New Password</label>
				<div class="col-sm-8">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-cog"></i></span>
						<input type="password" name="conf_pass_ch" id="conf_pass_ch" class="form-control" data-match="#pass_ch" data-error="Please, required this field." 
						data-match-error="Passwords do not match" required>
					</div>
					<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					<div class="help-block with-errors"></div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">
				Cancel
				<span class="glyphicon glyphicon-remove"></span>
			</button>
			<button type="submit" name="change_pass" class="btn btn-primary">
				Change Password
				<span class="glyphicon glyphicon-send"></span>
			</button>
		</div>
	</form>
<?php
	}	
	// validation: if login does not exists - create block of validation
	elseif(!isset($_POST['change_pass']) && isset($_POST['login_ch'])) {
		$valid = User::fromDb($_POST['login_ch']);
		if($valid) {
			echo $_POST['login_ch'];
		}
		else {
			return false;
		}
	}
	// change User password
	elseif(isset($_POST['change_pass'])) {
		$conf_pass = trim(md5($_POST['conf_pass_ch']));
		$user_login = $_POST['login_ch'];
		$newpass = User::changePass($conf_pass, $user_login);
	}
	else {
		exit();
	}
?>