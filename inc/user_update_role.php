<?php
	session_start();
	function __autoload($class) {
		include '../classes/'.$class.'.class.php';
	}
	$output = '';
	$message = '';
	if(isset($_POST['user_id'])) {
		$login = $_SESSION['regadmin'];
		$user_id = $_POST['user_id'];
		$user = User::fromDbID($user_id);
		if($user->roleid == 1) {
			$user->changeRole(2, $user_id);
		}
		elseif($user->roleid == 2) {
			$user->changeRole(1, $user_id);
		}
		$message = 'User '.$user->login.' role updated.';
	}
	if($user) {
		$output .= '<label class="text-success">' .$message. '</label>
					<div class="error">
						<div class="alert alert-danger fade in"></div>
					</div>
					<div class="response_table">
						<table class="table table-bordered table-striped table_scrolling">
							<thead>
								<tr>
									<th>Username</th>
									<th>Email</th>
									<th>Role</th>
								</tr>
							</thead>
							<tbody>
		';
		$db = new managerDb();
		$pdo = $db->connect();
		$sel1 = 'SELECT id, login, email, roleid FROM users WHERE login NOT IN ("'.$login.'")';
		$res = $pdo->query($sel1);
		while($row = $res->fetch()) {
			if($row['roleid'] == 1) {
				$role = 'Customer';
				$text = 'Make admin';
				$btn = 'success';
			}
			elseif($row['roleid'] == 2) {
				$role = 'Administrator';
				$text = 'Change to user';
				$btn = 'info';
			}
			$output .= '<tr>
							<td>'.$row['login'].'</td>
							<td>'.$row['email'].'</td>
							<td>'.$role.'
								<div class="btn_wrap">
									<button type="button" value="inc/user_update_role.php" id="ad'.$row['id'].'" class="btn btn-xs btn-'.$btn.' user_action">'.$text.'</button>
									<button type="button" value="inc/user_delete.php" id="de'.$row['id'].'" class="btn btn-xs btn-warning user_action">Delete</button>
								</div>
							</td>
						</tr>
			';
		}
		$output .= '</tbody></table></div>';
	}
	echo $output;