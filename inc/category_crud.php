<?php
	session_start();
	function __autoload($class) {
		include '../classes/'.$class.'.class.php';
	}
	$output = '';
    $message = '';
    if(empty($_POST['cat_id'])) {
    	$catname = trim($_POST['category']);
    	$cat = new Category($catname);
		$cat->intoDb();
		$message = 'Category "'.$catname.'" Added';
    }
    else {
    	$cat_id = $_POST['cat_id'];
    	$cat = Category::fromDb($cat_id);
		$cat->delCat($cat_id);
		$message = 'Category "'.$cat->category.'" Deleted';
    }
    if($cat) {
    	$output .= '<label class="text-success">' .$message. '</label>
    				<div class="error">
						<div class="alert alert-danger fade in"></div>
					</div>
    				<table class="table table-bordered table-striped table_scrolling">
						<thead>
							<tr>
								<th>Category name</th>
								<th>#</th>
							</tr>
						</thead>
						<tbody>
    	';
    	// show all categories
		$db = new ManagerDb();
		$pdo = $db->connect();

		$sel = 'SELECT * FROM categories';
		$res = $pdo->query($sel);
		while($row = $res->fetch()) {
			$output .= '
				<tr>
				<td>'.$row['category'].'</td>
				<td><button type="button" id="delcat'.$row['id'].'" class="btn btn-xs btn-warning del_cat">Delete</button></td>
				</tr>
			';
		}
		$output .= '</tbody></table>';
    }
    echo $output;