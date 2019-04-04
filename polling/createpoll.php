<?php

session_start();
    if(!isset($_SESSION['user'])){
        header('location: login.html');
        die();
    }
?>





<!DOCTYPE html>
<html>
    <head>
        
        <title>CREATE POLL</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./css/create.css">
    </head>
    <body>
        
            <form action="create.php" method="post">
             <div class="formbox">
               
                <h1>POLL END DATE</h1> 
                <input name="year" type="number" maxlength="4" minlength="4" placeholder="year"/> <input name="month" type="number" maxlength="2" minlength="2" placeholder="month"/><input name="day" type="number" maxlength="2" minlength="2" placeholder="days"/><br><br>
                <h1>POLL END TIME</h1> 
                <input name="hour" type="number" maxlength="2" minlength="2" placeholder="Hour"/> <input name="minutes" type="number" maxlength="2" minlength="2" placeholder="Minutes"/>
                <br><br><br>
               <center> <input type="submit" value="SUBMIT"/></center>
            </div>
            
                <div class="formbox1" id="box" style="height: 510px;">
                        <h1>Poll Data</h1>
                        <p>Enter poll question<p>
                        <input type="text" accesskey="t" style="width:74%" id="pollQ" name="pollQ" placeholder="Enter poll question"><br><br>
                        <p>Enter poll question</p>
                <div id="options">
                        <input type = "text" name="pollA[]" placeholder="enter a option"/>
                </div>
                
        
            </form>
            <br><br>
            <!-- <input type="submit" value="add_option"  onclick="return add()"/> -->
            
            <button class="blue" accesskey="a" onclick="return add()">Add&nbspoption</button>
        </div>
        </div>
    <script type="text/javascript" src="js/main.js"></script>
    </body>
</html>
