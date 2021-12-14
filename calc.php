<?php
    session_start();
    
    //Если жетона безопасности (т.е. в нашем случае, 
    //сессионной переменной с названием user) нет, "не пущаем"
    if (!isset($_SESSION["user"])) {
        echo('<meta http-equiv="refresh" content="2; URL=login.php">');
            die("Требуется логин!");
    }
?>

<html>
    <head>
        
        <!-- Это комментарий HTML -->
        <meta charset="utf-8" />
        <style>
            input,button {
                width: 140; 
                margin: 5px;
                text-align: center;
            }
        
            button {
                    width: 63px;
            }
        </style>

        <script>
            // Это комментарий JS
            function plus() {
                var x = document.getElementById("x").value;
                var y = document.getElementById("y").value;
                
                var url = "api/plus.php?x=" + x + "&y=" + y;
                var xhr = new XMLHttpRequest();
                xhr.open("GET",url,false);
                xhr.send();
                var z =xhr.responseText;

                document.getElementById("z").value = z;
                document.getElementById("btn1").className = "pressed";
                document.getElementById("btn2").className = "";
            }
        
            function minus() {
                var x = document.getElementById("x").value;
                var y = document.getElementById("y").value;

                var url = "api/minus.php?x=" + x + "&y=" + y;
                var xhr = new XMLHttpRequest();
                xhr.open("POST",url,false);
                xhr.send();
                var z =xhr.responseText;

                document.getElementById("z").value = z;
                document.getElementById("btn1").className = "";
                document.getElementById("btn2").className = "pressed";
            }
        </script>
    </head>
    <body>
        <h1>Калькулятор</h1>
        <input id="x" /><br />
        <input id="y" /><br />
        <button id="btn1" onclick="plus();">+</button>
        <button id="btn2" onclick="minus();">-</button><br />
        <input id="z" />      
    </body>
</html>