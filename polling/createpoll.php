<?php

session_start();
if(!isset($_SESSION['user'])){
    header('location: login.php');
    die();
}
$valid_time = 1;
if(isset($_SESSION['time'])){
    if($_SESSION['time']=='invalid'){
        $valid_time = 0;
    }
    if($_SESSION['time']=='Null'){
        $valid_time = 2;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        
        <title>CREATE POLL</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./css/create.css">
        <script>
            function validcheck(){
                
                if(document.getElementById("pollQ").value.length==0){
                    alert("Enter Question");
                    return false;
                }
                else{     
                    return true;
                }

            }
            var options_count = 2;
            function add(){
                if(options_count > 4){
                    var x = document.getElementById("box");
                    var height = parseInt(x.style.height);
                    var newHeight = height + 43;
                    x.style.height = newHeight + 'px';
                    console.log(">"+height);
                }
                document.getElementById('options').innerHTML +=
                        '<input type = "text" name="pollA[]" id="'+'op'+options_count.toString()+'" placeholder="enter a option" required>';
                options_count++;
                return false;
            }

        </script>
        
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
                    <li role="presentation"><a href="dash.php">Dashboard</a></li>
                    <li class="active" role="presentation"><a href="createpoll.php">Create Poll</a></li>
                    <li role="presentation"><a href="addnewmembers.php">Add members</a></li>
                    <li role="presentation"><a href="yourpolls.php">View Your Polls</a></li>
                    <li role="presentation"><a href="logout.php">Log out</a></li>
                </ul>
            </div>
        </div>
    </nav>    

            <form action="create.php" onsubmit="return validcheck()" method="post" form="f3">
             <div class="formbox">
               
                <p class = "new"><b>POLL END DATE</b></p> 
                <input name="year" type="number" maxlength="4" minlength="4" placeholder="year" required> <input name="month" type="number" maxlength="2" minlength="2" placeholder="month" required><input name="day" type="number" maxlength="2" minlength="2" placeholder="days" required><br><br>
                <p class = "new"><b>POLL END TIME</b></p> 
                <input name="hour" type="number" maxlength="2" minlength="2" placeholder="Hour" required> <input name="minutes" type="number" maxlength="2" minlength="2" placeholder="Minutes" required>
                <br><br><br>
               <center>
                   <?php
                        if($valid_time == 0){
                            echo '<p style="color: red">Entered time is alredy passed</p>';
                            unset($_SESSION['time']);
                        }
                        if($valid_time == 2){
                            echo '<p style="color: red">Enter valid date and time</p>';
                            unset($_SESSION['time']);
                        }
                   ?> 
                   <input type="submit" value="SUBMIT" onclick="return validcheck()"/></center>
            </div>
            
                <div class="formbox1" id="box" style="height: 510px;">
                        <p class = "new"><b>Poll Data</b></p>
                        <p>Enter poll question<p>
                        <input type="text" accesskey="t" style="width:74%" id="pollQ" name="pollQ" placeholder="Enter poll question"><br><br>
                        <p>Enter poll options</p>
                <div id="options">
                        <input type = "text" name="pollA[]" placeholder="enter a option" required>
                </div>
                
        
            </form>
            <br><br>
            <!-- <input type="submit" value="add_option"  onclick="return add()"/> -->
            
            <button class="blue" accesskey="a" onclick="return add()">Add&nbspoption</button>
        </div>
        </div>
    <!-- <script type="text/javascript" src="js/main.js"></script> -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
