<html>
	<head>
		<meta charset="utf-8">
		<title>Register</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="styles/style.css" rel="stylesheet" type="text/css">
    </head>
	<body>
		<div class="register">
			<h1>Register</h1>
			<form action="register.php" method="post" autocomplete="off">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="submit" value="Register">
			</form>
		</div>
	</body>
</html>


<?php

include("./include/params.php");
// Try and connect using the info above.
$conn = mysqli_connect("$DB_URL","$DB_USER","$DB_PWD","$DB_NAME");
if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// Check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['user'], $_POST['pwd'])) {
	// Could not get the data that should have been sent.
	exit('Please complete the registration form!');
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['user']) || empty($_POST['pwd'])) {
	// One or more values are empty.
	exit('Please complete the registration form');
}
// We need to check if the account with that username exists.
if ($stmt = $con->prepare('SELECT ID, UserName FROM users WHERE UserName = ?')) {
	if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['user']) == 0) {
        exit('Username is not valid!');
    }
    if (strlen($_POST['pwd']) > 20 || strlen($_POST['pwd']) < 5) {
        exit('Password must be between 5 and 20 characters long!');
    }
    // Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_POST['user']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		// Username already exists
		echo 'Username exists, please choose another!';
	} else {
		// Username doesnt exists, insert new account
if ($stmt = $con->prepare('INSERT INTO users (UserName, PwdHash) VALUES (?, ?)')) {
	// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
	$pwd = password_hash($_POST['pwd'], MHASH_SHA256);
	$stmt->bind_param("ss", $_POST['user'], '$pwd');
	$stmt->execute();
	echo 'You have successfully registered, you can now login!';
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}
	}
	$stmt->close();
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}
$conn->close();
?>