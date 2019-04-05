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

        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>
    <body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header"><a class="navbar-brand navbar-link" href="#">C.M.S</a>
                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav navbar-right">
                    <li role="presentation"><a href="#">Dashboard</a></li>
                    <li class="active" role="presentation"><a href="createpoll.php">Create Poll</a></li>
                    <li role="presentation"><a href="addnewmembers.php">Add members</a></li>
                    <li role="presentation"><a href="yourpolls.php">View Your Polls</a></li>
                </ul>
            </div>
        </div>
    </nav>    

            <form action="create.php" method="post">
             <div class="formbox">
               
                <p class = "new">POLL END DATE</p> 
                <input name="year" type="number" maxlength="4" minlength="4" placeholder="year"/> <input name="month" type="number" maxlength="2" minlength="2" placeholder="month"/><input name="day" type="number" maxlength="2" minlength="2" placeholder="days"/><br><br>
                <p class = "new">POLL END TIME</p> 
                <input name="hour" type="number" maxlength="2" minlength="2" placeholder="Hour"/> <input name="minutes" type="number" maxlength="2" minlength="2" placeholder="Minutes"/>
                <br><br><br>
               <center> <input type="submit" value="SUBMIT"/></center>
            </div>
            
                <div class="formbox1" id="box" style="height: 510px;">
                        <p class = "new">Poll Data</p>
                        <p>Enter poll question<p>
                        <input type="text" accesskey="t" style="width:74%" id="pollQ" name="pollQ" placeholder="Enter poll question"><br><br>
                        <p>Enter poll options</p>
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
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

    </body>
</html>
