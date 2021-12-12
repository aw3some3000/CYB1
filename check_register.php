<?php
    session_start();
    include(".\include\params.php");
?>

<html>
    <head>
    <title></title>
    </head>
    <body>
<?php
    // initializing variables
    $user = "";
    $errors = array(); 
    
    // connect to the database
    $conn = mysqli_connect("$DB_URL","$DB_USER","$DB_PWD","$DB_NAME");
    
    // REGISTER USER
    if (isset($_POST['Register'])) {
      // receive all input values from the form
      $user = mysqli_real_escape_string($conn, $_POST['user']);
      $pwd_1 = mysqli_real_escape_string($conn, $_POST['pwd_1']);
      $pwd_2 = mysqli_real_escape_string($conn, $_POST['pwd_2']);

      // form validation: ensure that the form is correctly filled ...
      // by adding (array_push()) corresponding error unto $errors array
      if (empty($user)) { array_push($errors, "Username is required"); }
      if (empty($pwd_1)) { array_push($errors, "Password is required"); }
      if ($pwd_1 != $pwd_2) {
        array_push($errors, "The two passwords do not match");
      }
    
      // first check the database to make sure 
      // a user does not already exist with the same username and/or email
      $user_check_query = "SELECT * FROM users WHERE UserName='$user' LIMIT 1";
      $result = mysqli_query($conn, $user_check_query);
      $user = mysqli_fetch_assoc($result);
      
      if ($user) { // if user exists
        if ($user['username'] === $user) {
          array_push($errors, "Username already exists");
        }
      }
    
      // Finally, register user if there are no errors in the form
      if (count($errors) == 0) {
         $hash = hash('sha256',$pwd_1);;//encrypt the password before saving in the database
    
          $query = "INSERT INTO users (UserName, PwdHash) 
                    VALUES('$user','$hash')";
          mysqli_query($conn, $query);
          $_SESSION['user'] = $user;
          $_SESSION['success'] = "You are now logged in";
          header('location: index_.html');
      }
    }
?>

</body>

</html>

<!--
    Пока не понял можно ли что-то из этого приспособить

            $user = $_POST["user"];
            $pwd  = $_POST["pwd"];
            $hash = hash('sha256',$pwd);
            $sql  = "INSERT INTO users (UserName,PwdHash) 
            VALUES ('$user','$hash')
            ";
            
            $conn = mysqli_connect("$DB_URL","$DB_USER","$DB_PWD","$DB_NAME");
            $statement = mysqli_prepare($conn, "INSERT INTO users (UserName,PwdHash) VALUES ('$user','$hash')");
            mysqli_stmt_bind_param($statement,"ss",$user,$hash);
            mysqli_stmt_execute($statement);
            echo(mysqli_error($conn));
            $cursor = mysqli_stmt_get_result($statement);           
            $result = mysqli_fetch_all($cursor);
            //var_dump($cursor);
            echo(mysqli_error($conn));
            //var_dump($result);
            mysqli_close($conn);
            
            if(count($result) > 0) {
                echo ("<h2>Hello, $user! Your account successfully registered!</h2>");
                $_SESSION["user"] = $user;
                echo('<meta http-equiv="refresh" content="2; URL = index_.html">');
            }
            else {
                echo("User already exists!");
                echo('<meta http-equiv="refresh" content="2;URL = register.php">');
            }
        ?>
    </body>

</html>
-->
