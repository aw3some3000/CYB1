<?php
    session_start();
?>
<html>
    <head>
        <meta charset="utf-8" />
        <link href="styles/main.css" rel="stylesheet" />
        <link href="styles/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <a href="index_.html">На главную</a> 
        <h1>Считаем щелчки</h1>
        <form>
            <button id="btn1">Щёлкни здесь</button>
        </form>
        <?php
            $i = 0;
            
            //Вспомним переменную счётчика
            //(если она существует):
            //if (isset($_SESSION["clicks"]))
            //$i = $_SESSION["clicks"];

            //$i += 1;
            // Запомним текущее значение счётчика щелчков в сессии
            // в сессионной переменной clicks
            //$_SESSION["clicks"] = $i;
            if (isset($_COOKIE['clicks']))
                $i = $_COOKIE['clicks'];

            $i += 1;
            setcookie("clicks",$i,time() + 20);
                
            echo("Всего щелчков: $i");
        ?>
    </body>
</html>