<html>
	<head>
		<!--Страница регистрации-->
		<meta charset="utf-8" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="styles/style.css" rel="stylesheet" type="text/css">
    </head>
		<body>
    <?php
        if (isset($_REQUEST["user"])) {
            $user = $_REQUEST["user"];
            $pwd_1 = $_REQUEST["pwd_1"];
			$pwd_2 = $_REQUEST["pwd_2"];
            $hash = hash('sha256',$pwd_1);
            $sql = "INSERT INTO USERS(UserName, PwdHash)
                    VALUES(?,?)
            ";

			//include("./include/params.php");
			//include($_ENV["MYAPP_CONFIG"]); - не сработало
			include(getenv()["MYAPP_CONFIG"]);
			
			if ($pwd_1 != $pwd_2) {
				echo "The two passwords do not match";
			  }
            $conn = mysqli_connect($DB_URL,$DB_USER,$DB_PWD,$DB_NAME);
            // Нудная, но необходимая процедура передачи параметров 
            // в sql выражение, что гарантирует защиту от инжекции sql
            $statement = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($statement,"ss",$user,$hash);
            // Часто применяемая в PHP конструкции "... or die..." 
            // позволяет прекратить исполнение кода, если первая часть 
            // выражения вернула что-то "нехорошее":
            mysqli_stmt_execute($statement) or die(mysqli_error($conn));
            mysqli_close($conn);
            echo('<meta http-equiv="refresh" content="2; URL=login.php">');
            die("Новый пользователь $user зарегистрирован");
        }
        
    ?>
    	<div class="register">
			<h1>Registration</h1>
			<form action="register.php" method="post" autocomplete="off">
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