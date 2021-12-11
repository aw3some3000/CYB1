<?php

$x = $_REQUEST["x"];
$y = $_REQUEST["y"];
$z = $x - $y;

//include("D:\\AppParams\\params.php");
include(".\include\params.php");
$conn = mysqli_connect("$DB_URL","$DB_USER","$DB_PWD","$DB_NAME");
// Убрали уязвимости - 1. Принцип наименьших привилегий (соблюли) 2. Слабый пароль 3. Секрет в коде

$sql = "INSERT INTO log(Number1,Number2,Result,UserID) VALUES($x,$y,$z,'anonym')";
mysqli_query($conn,$sql);
//echo(mysqli_error($conn));
mysqli_close($conn);
echo($z);

echo($z);
