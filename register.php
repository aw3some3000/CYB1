<html>
	<head>
		<!--Страница регистрации-->
		<meta charset="utf-8" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="styles/style.css" rel="stylesheet" type="text/css">
    </head>
	<body>
    	<div class="register">
			<h1>Registration($user попадает в базу с пустым значением)</h1>
			<form action="check_register.php" method="post" autocomplete="off">
            	<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="user" placeholder="Username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="pwd_1" placeholder="Password" required>
            	<label for="confirm_password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="pwd_2" placeholder="Confirm_Password" required>
				<input type="submit" name="Register" value="Register">
                <p>
  		            Already a member? <a href="login.php">Sign in</a>
  	            </p>
            </form>
    	</div>
	</body>
</html>