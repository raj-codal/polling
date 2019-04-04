<?php

session_start();
    if(!isset($_SESSION['user'])){
        header('location: login.html');
        die();
    }
?>

<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./css/add.css">
    </head>
    <body>
        
        <form action="addmembers.php" method="post">
            <div class="addbox">
                <h1>Add Members</h1>
            <p>Poll Id</p>
            <input type="text" name="poll_id" placeholder="Enter your poll id"/>
            <p>Email</p>
            <input type="email" name="email" placeholder="Enter your regestered email">
            <p>Password</p>
            <input type="password" name="password" placeholder="Enter your account password">
            <p>No of Voters</p>
            <input id ="number" type ="text" onchange="insert_input()" placeholder="no. of voters"/>
            <br><br>
            <input type="submit" value="SUBMIT"/>
            </div>
            <div class="list">
            <div id="voters_list">
                
            </div>
            </div>
        </form>

        <script type="text/javascript">
        
            function insert_input(){
                var x = document.getElementById('voters_list');
                var n = document.getElementById('number').value;
                x.innerHTML = "";
                for(i=0;i<n;i++){
                    x.innerHTML +='member'+i+':<input type="text" placeholder="enter email" name="voters[]"><br>'; 
                }
            }
        
        </script>
    </body>
</html>
