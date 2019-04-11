<?php

session_start();
    if(!isset($_SESSION['user'])){
        header('location: login.php');
        die();
    }
?>

<html>
    <head>
        <title>ADD MEMBERS</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./css/add.css">

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
                    <li role="presentation"><a href="createpoll.php">Create Poll</a></li>
                    <li class="active" role="presentation"><a href="addnewmembers.php">Add members</a></li>
                    <li role="presentation"><a href="yourpolls.php">View Your Polls</a></li>
                    <li role="presentation"><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>    
        
        <form action="addmembers.php" method="post">
            <div class="addbox">
                <h1>Add Members</h1>
            <p>Poll Id</p>
            <input type="text" name="poll_id" placeholder="Enter your poll id" value = "<?php if(isset($_GET['pid'])){echo $_GET['pid'];} ?>" required>
            <p>Email</p>
            <input type="email" name="email" placeholder="Enter your regestered email" required>
            <p>Password</p>
            <input type="password" name="password" placeholder="Enter your account password" minlength="6" required>
            <p>No of Voters</p>
            <input id ="number" type ="text" onkeyup="insert_input()" placeholder="no. of voters" required>
            <br><br>
            <input type="submit" value="SUBMIT"/>
            </div>
            <div class="list" id="listbox" style="height:600px">
            <div id="voters_list">
                
            </div>
            </div>
        </form>

        <script type="text/javascript">
        
            function insert_input(){
                var y = document.getElementById('voters_list');
                var n = document.getElementById('number').value;
                if(n > 17){
                    extra = n-17;
                    var x = document.getElementById("listbox");
                    var height = parseInt(x.style.height);
                    var newHeight = height + extra*23;
                    x.style.height = newHeight + 'px';
                }
                if(n < 19){
                    var x = document.getElementById("listbox");
                    x.style.height = 600 + 'px';
                }
                y.innerHTML = "";
                for(i=0;i<n;i++){
                    y.innerHTML += '<input class = "vlist" type="email" placeholder="email of member '+(i+1)+'" name="voters[]" required><br>'; 
                }
            }
        
        </script>
        <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
