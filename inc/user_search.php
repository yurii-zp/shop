<?php
	session_start();
	function __autoload($class) {
		include '../classes/'.$class.'.class.php';
	}
	$db = new ManagerDb();
	$pdo = $db->connect();

	$output = '';
	$login = $_SESSION['regadmin'];
	if(isset($_POST['search'])) {
		$search = trim($_POST['search']);

		$sel = 'SELECT id, login, email, roleid 
				FROM users 
				WHERE login LIKE "%'.$search.'%"
				AND login NOT IN("'.$login.'")';
	}
	else {
		$sel = 'SELECT id, login, email, roleid 
				FROM users 
				WHERE login 
				NOT IN ("'.$login.'")';
	}
	$res = $pdo->query($sel);
	if($res->rowCount() > 0) {
		$output .= '<div class="error">
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
		echo $output;
	}
	else {
		echo 'User Not Found';
	}