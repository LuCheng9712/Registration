<?php

if (isset($_POST['submit'])) {

	include_once 'dbh.inc.php';

	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$email = $_POST['email'];
	$userId = $_POST['userId'];
	$password = $_POST['password'];

	// Check if there exists a user with the input from UserId
	$sqlUserId = "SELECT * FROM users WHERE user_userId='$userId'";
	$UserIdResult = mysqli_query($conn, $sqlUserId);
	$UserIdResultCheck = mysqli_num_rows($UserIdResult);

	// Error handling

	if (empty($firstName)) {
		// Check empty fields
		header("Location: ../register.php?register=firstNameEmpty");
		exit();
	} else if (empty($lastName)) {
		header("Location: ../register.php?register=lastNameEmpty");
		exit();
	} else if (empty($email)) {
		header("Location: ../register.php?register=emailEmpty");
		exit();
	} else if (empty($userId)) {
		header("Location: ../register.php?register=userIdEmpty");
		exit();
	} else if (empty($password)) {
		header("Location: ../register.php?register=passwordEmpty");
		exit();
	} else if (!preg_match("/^[a-zA-Z]*$/", $firstName) || !preg_match("/^[a-zA-Z]*$/", $lastName)) {
		// Check if names are valid
		header("Location: ../register.php?register=invalid");
		exit();
	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		// Check if email is valid
		header("Location: ../register.php?register=email");
		exit();
	} else if ($UserIdResultCheck > 0) {
		// Check if userId is taken
		header("Location: ../register.php?register=exist");
		exit();
	} else if (strlen($password) < 8) {
		// Check if the password is long enough
		header("Location: ../register.php?register=password");
		exit();
	} else {
		// Hashing password
		$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
		// Insert the user into the database
		$sql = "INSERT INTO users (user_firstName, user_lastName, user_userId, user_email, user_password) VALUES ('$firstName', '$lastName', '$userId', '$email', '$hashedPwd');";
		$result = mysqli_query($conn, $sql);

		header("Location: ../register.php?register=success");
		exit();
	}

} else {
	header("Location: ../register.php");
	exit();
}