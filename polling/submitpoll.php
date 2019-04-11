<?php

session_start();
    if(!isset($_SESSION['user'])){
        header('location: login.php');
        die();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>submitpoll</title>
        <link rel="stylesheet" type="text/css" href="./css/reg.css">

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
                        <li class="active" role="presentation"><a href="dash.php">Dashboard</a></li>
                        <li role="presentation"><a href="createpoll.php">Create Poll</a></li>
                        <li role="presentation"><a href="addnewmembers.php">Add members</a></li>
                        <li role="presentation"><a href="yourpolls.php">View Your Polls</a></li>
                        <li role="presentation"><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="registerbox">
        <h1>Submit poll</h1>
        <form action="addpoll.php" method="post" name="submitpoll">
            <p>Email</p>
            <input type="email" name="email"  placeholder="email" required>
            <p>Password</p>
            <input type="password" name="password" placeholder="password" minlength="6" required>
            <p>Poll id</p>
            <input type="number" name="poll_id" placeholder="Poll ID" value="<?php echo $_GET['pid']?>" required>
            <br><br>
            <center><input style="width:40%" type="submit" value="Proceed"></center>
        </form>
        </div>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
