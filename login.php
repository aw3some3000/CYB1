<html>
    <head>
        <!--Страница логина-->
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="styles/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="login">
        <h4 style = text-align:center;><a href="index_.html">На главную</a></h4>
                <h1>Пожалуйста, авторизуйтесь!</h1>
                <form action="check_login.php" method="post" autocomplete="off">
				    <label for="user">
					    <i class="fas fa-user"></i>
				    </label>
				    <input type="text" name="user" placeholder="Имя пользователя" id="username" required>
				    <label for="pwd">
					    <i class="fas fa-lock"></i>
				    </label>
				    <input type="password" name="pwd" placeholder="Пароль" id="password" required>
				    <input type="submit" value="Login">
                    <p>
  		                Ещё не с нами? <a href="register.php">Загеристрируйтесь</a>
  	                </p>
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
        