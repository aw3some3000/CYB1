<?php
    include(".\include\params.php");

    // initializing variables
   
    $user = '';
    $errors = array();

    // connect to the database
    $conn = mysqli_connect("$DB_URL","$DB_USER","$DB_PWD","$DB_NAME");
    echo(mysqli_error($conn));
    // REGISTER USER
    if (isset($_POST['Register'])) {
      // receive all input values from the form
      $user = mysqli_real_escape_string($conn, $_POST['user']);
      $pwd_1 = mysqli_real_escape_string($conn, $_POST['pwd_1']);
      $pwd_2 = mysqli_real_escape_string($conn, $_POST['pwd_2']);

      // form validation: ensure that the form is correctly filled ...
      // by adding (array_push()) corresponding error unto $errors array
      //if (empty($user)) { array_push($errors, "Username is required"); }
      //if (empty($pwd_1)) { array_push($errors, "Password is required"); }
      if ($pwd_1 != $pwd_2) {
        array_push($errors, "The two passwords do not match");
      }
      
      // first check the database to make sure 
      // a user does not already exist with the same username and/or email
      $user_check_query = "SELECT * FROM users WHERE UserName='$user' LIMIT 1";
      $result = mysqli_query($conn, $user_check_query);
      $user = mysqli_fetch_assoc($result);
      
      if ($user) { // if user exists
        if ($user['user'] === $user) {
          array_push($errors, "Username already exists");
        }
      }

      // Finally, register user if there are no errors in the form
      if (count($errors) == 0) {
         $hash = hash('sha256',$pwd_1);;//encrypt the password before saving in the database
        
          $sql = "INSERT INTO users (UserName,PwdHash) VALUES ('$user', '$hash')";
          mysqli_query($conn, $sql);
          $_SESSION['user'] = $user;
          $_SESSION['success'] = "You are now logged in";
          header('location: index_.html');
      }
    }
?>

