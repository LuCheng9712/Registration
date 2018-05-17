<?php

session_start();

if (isset($_POST['submit'])) {

	include_once 'dbh.inc.php';
 
	$userId = $_POST['userId'];
	$password = $_POST['password'];

	// Check if there exists a user with the UserId
	$sqlUserId = "SELECT * FROM users WHERE user_userId='$userId' OR user_email='$userId'";
	$UserIdResult = mysqli_query($conn, $sqlUserId);
	$UserIdResultCheck = mysqli_num_rows($UserIdResult);

	// Error handling

	if (empty($userId)) {
		// Check empty UserId
		header("Location: ../index.php?login=userIdEmpty");
		exit();
	} else if (empty($password)) {
		// Check empty Password
		header("Location: ../index.php?login=passwordEmpty");
		exit();
	} else if ($UserIdResultCheck < 1) {
		// Check if user exists
		header("Location: ../index.php?login=noSuchUser");
		exit();
	} else if ($row = mysqli_fetch_assoc($UserIdResult)) {
		// Check if the password is the same
		// De-hash the password
		$passwordCheck = password_verify($password, $row['user_password']);
		if ($passwordCheck == false) {
			header("Location: ../index.php?login=PasswordNoMatch");
			exit();
		} else if ($passwordCheck == true){
			// Log in
			$_SESSION['u_id'] = $row['user_id'];
			$_SESSION['u_firstName'] = $row['user_firstName'];
			$_SESSION['u_lastName'] = $row['user_lastName'];
			$_SESSION['u_email'] = $row['user_email'];
			$_SESSION['u_userid'] = $row['user_userId'];

			header("Location: ../index.php?login=success");
			exit();
		}
	}

} else {
	header("Location: ../index.php?login=error");
	exit();
}