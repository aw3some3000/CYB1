<html>
    <head>
        <!--Страница логина-->
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="styles/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
    <div class="login">
            <h1>Login, please!</h1>
		    <form action="check_login.php" method="post" autocomplete="off">
				<label for="user">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="user" placeholder="Username" id="username" required>
				<label for="pwd">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="pwd" placeholder="Password" id="password" required>
				<input type="submit" value="Login">
			</form>
		</div>
    </body>
</html>
<!--
    Предыдущий код
    <h1>Login, please!</h1>
        <form method="post" action="check_login.php">
            <input name="user" /><br />
            <input name="pwd" type="password" /><br />
            <button id="btn1">Go!</button>
        </form>
        
-->
        