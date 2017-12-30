<div class="profile_block">
	<h3>Edit Profile:</h3>
	<form method="post" action="index.php?menu=3" enctype="multipart/form-data" class="profile_form form-horizontal nth_padding clearfix" role="form" data-toggle="validator">
		<div class="col-sm-3 text-center">
		
			<?php
				//$user = User::fromDb($login);
				if($user->avatar) {
					$avatar = base64_encode($user->avatar);
					echo '<img src="data:image/jpg; base64,'.$avatar.'" alt="avatar" />';
				}
				else {
					echo '<img src="images/layout/avatar_placeholder.png">';
				}
				switch ($user->roleid) {
					case 2:
						$roleid = 'Administrator';
						break;
					default:
						$roleid = 'Customer';
						break;
				}
			?>

			<div class="uploader_wrap">
				<input type="hidden" name="MAX_FILE_SIZE" value="1048576">
				<input type="file" name="avatar_prof" accept="image/*">
				<a href="#" class="btn btn-default pseudo_uploader">
					<span class="glyphicon glyphicon-star"></span>
					Change Avatar
				</a>
			</div>
		</div>
		<div class="col-sm-9">
			<div class="form-group">
				<label class="control-label col-sm-2">Login</label>
				<div class="col-sm-10">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input type="text" value="<?php echo $user->login; ?>" class="form-control" readonly disabled>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label for="email_prof" class="control-label col-sm-2">Email</label>
				<div class="col-sm-10">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
						<input type="email" name="email_prof" value="<?php echo $user->email; ?>" id="email_prof" class="form-control" data-error="Please, write the correct email address" required>
					</div>
					<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					<div class="help-block with-errors"></div>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2">Role</label>
				<div class="col-sm-10">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-star-empty"></i></span>
						<input type="text" value="<?php echo $roleid; ?>" class="form-control" readonly disabled>
					</div>
				</div>
			</div>

			<div class="col-sm-offset-2">
				<button type="reset" class="btn btn-info">
					Reset
					<span class="glyphicon glyphicon-remove"></span>
				</button>
				<button type="submit" name="edit_prof" id="edit_prof" class="btn btn-primary">
					Send
					<span class="glyphicon glyphicon-send"></span>
				</button>
			</div>
		</div>
	</form>
	<h3>My stats:</h3>
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Total purchases</th>
					<th>Total amount spent</th>
					<th>Discount</th>
					<th>Rating</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<?php
							$count = Purchase::counter($login);
							echo $count;
						?>
					</td>
					<td>
						<?php
							$amount = Purchase::totalAmount($login);
							if($amount) {
								echo '$'.$amount;
							}
							else {
								echo '$0';
							}
						?>
					</td>
					<td>
						<?php echo $user->discount.'%'; ?>
					</td>
					<td>
						<div class="progress progress-striped">
							<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $user->rating; ?>" 
								aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $user->rating.'%'; ?>">
								<span><?php echo $user->rating.'%'; ?></span>
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<?php
	if(isset($_POST['edit_prof'])) {
		$new_email = trim($_POST['email_prof']);
		$new_avatar = $_FILES['avatar_prof'];
		$user->editProfile($new_email, $new_avatar, $login);
		echo "<script>window.location.href = 'index.php?menu=3';</script>";
	}
?>