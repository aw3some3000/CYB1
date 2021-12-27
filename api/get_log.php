<?php
    session_start();    
    include (getenv('MYAPP_CONFIG'));
    
    if (!isset($_SESSION["user"])){
        echo('<meta http-equiv="refresh" content="2; URL=../login.php">');
        die("Need to LOGIN");        
    }
    $user = $_SESSION["user"];
           
    $sql = "SELECT ID, Number1, Number2, Result, UserID, Timestamp
            FROM log
            WHERE UserID='$user'     
    ";

    $conn = mysqli_connect("$DB_URL","$DB_USER","$DB_PWD","$DB_NAME");            
    $statement = mysqli_prepare($conn, $sql);           
    mysqli_stmt_execute($statement);
    $cursor = mysqli_stmt_get_result($statement);

    while ($row = mysqli_fetch_array($cursor, MYSQLI_NUM)){
        foreach($row as $r){
           print("$r ");
        }
        print("\n");
     }		
          
    // $result = mysqli_fetch_all($cursor);
    
    // echo(mysqli_error($conn));
    // var_dump($result);
    mysqli_stmt_close($statement);
    mysqli_close($conn);

   // echo (json_encode($result));