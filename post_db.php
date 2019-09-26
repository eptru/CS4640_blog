<?php
	function makeThePostTable() {
		global $db;
		$query = "CREATE TABLE omega.posts (
		postid INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		username VARCHAR(12) NOT NULL,
		viewcount INT NOT NULL DEFAULT '0',
		title TEXT NOT NULL,
		content TEXT NOT NULL)";
		$statement = $db->prepare($query);
		$statement->execute();
		$statement->closecursor();
	}

	function andFillWithRandomInformation() {

	}
	
	function retriveUsernameByEmail($email) {
		global $db;
		$query = "SELECT * FROM users where email = :email";
		$statement = $db->prepare($query);
		$statement->bindValue(':email', $email);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closecursor();
		return $result[0]['username'];
	}

	function getPostsSortedByView() {
		global $db;
		$query = "SELECT * From posts ORDER BY viewcount DESC";
		$statement = $db->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closecursor();
		return $result;
	}

	function getAllPosts() {
		global $db;
		$query = "SELECT * From posts";
		$statement = $db->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closecursor();
		return $result;
	}

	function getPostsByusernameSortedByView($username) {
		global $db;
		$query = "SELECT * From posts where username = :username ORDER BY viewcount DESC";
		$statement = $db->prepare($query);
		$statement->bindValue(':username', $username);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closecursor();
		return $result;
	}

	function getPostsByusernameSortedById($username) {
		global $db;
		$query = "SELECT * From posts where username = :username ORDER BY postid DESC";
		$statement = $db->prepare($query);
		$statement->bindValue(':username', $username);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closecursor();
		return $result;
	}

	function getPostBypostid($postid) {
		global $db;
		$query = "SELECT * From posts where postid = :postid";
		$statement = $db->prepare($query);
		$statement->bindValue(':postid', $postid);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closecursor();
		return $result;
	}


	function postPosts($username, $title, $content) {
		global $db;
		$query = "INSERT INTO posts (username, title, content) VALUES(:username, :title, :content)";
		$statement = $db->prepare($query);
		$statement->bindValue(':username', $username);
		$statement->bindValue(':title', $title);
		$statement->bindValue(':content', $content);
		$statement->execute();
		$statement->closeCursor();
	}
	
	//add one new function for post update
	function updatePostById($postid, $title, $content) {
		global $db;
		$query = "UPDATE posts SET title = :title, content = :content WHERE postid = :postid";
		$statement = $db->prepare($query);
		$statement->bindValue(':postid', $postid);
		$statement->bindValue(':title', $title);
		$statement->bindValue(':content', $content);
		$statement->execute();
		$statement->closeCursor();
	}

	function incView($postid) {
		global $db;
		$query = "UPDATE posts SET viewcount = viewcount+1 WHERE postid = :postid";
		$statement = $db->prepare($query);
		$statement->bindValue(':postid', $postid);
		$statement->execute();
		$statement->closeCursor();
	}

	?>
