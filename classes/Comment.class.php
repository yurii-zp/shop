<?php
	/**
	* Comment
	*
	* @method intoDb - adds comment into database
	* @method showComm - draws html with comment
	*/
	class Comment
	{
		
		private $id;
		private $username;
		private $itemid;
		private $title;
		private $comment;
		private $rating;
		private $curdate;

		function __construct($username, $itemid, $title, $comment, $rating, $curdate, $id = 0) {
			$this->username = $username;
			$this->itemid = $itemid;
			$this->title = $title;
			$this->comment = $comment;
			$this->rating = $rating;
			$this->curdate = $curdate;
			$this->id = $id;
		}

		/**
		* Add comment into database
		*/
		function intoDb() {
			$db = new ManagerDb();
			$pdo = $db->connect();

			$ins = 'INSERT INTO comments (username, itemid, title, comment, rating, curdate) VALUES (?, ?, ?, ?, ?, ?)';
			$ps = $pdo->prepare($ins);
			$ps->execute(array(
				$this->username,
				$this->itemid,
				$this->title,
				$this->comment,
				$this->rating,
				$this->curdate
			));
		}

		/**
		* draw comment in the page
		*
		* @parameter int itemid - item ID
		*/
		static function showComm($itemid) {
			$db = new ManagerDb();
			$pdo = $db->connect();

			$sel = 'SELECT * FROM comments WHERE itemid = ? ORDER BY id DESC';
			$ps = $pdo->prepare($sel);
			$ps->execute(array($itemid));

			if ($ps->rowCount() > 0) {
			   	foreach ($ps as $row) {
					$datetime = new DateTime($row['curdate']);
					$date_format = $datetime->format("F d, Y");

					echo '<div class="comment">';
					echo '<span class="rating rating_out" data-rating="'.$row['rating'].'"></span>';
					echo '<h4>'.$row['title'].'</h4>';
					echo '<div>'.$date_format.'</div>';
					echo '<h5>'.$row['username'].'</h5>';
					echo '<p>'.$row['comment'].'</p>';
					echo '</div>';
				}
			}
			else {
			   echo '<h4>There are no reviews for this product</h4>';
			   echo '<p>Be the first to write a review<p>';
			}
		}
	}