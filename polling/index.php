<?php

session_start();
    if(isset($_SESSION['user'])){
        header('location: dash.php');
        die();
    }
?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="assetsv4/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assetsv4/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assetsv4/css/styles.min.css">
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand bg-dark">
        <div class="container-fluid"><a class="navbar-brand" href="#">C.M.S</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse"
                id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link bg-primary active" href="login.php" id="log_in">Log in</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link bg-success active" href="register.php">Sign up</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="justify-content-center align-items-center align-content-center align-self-center" id="banner_background">
        <div class="jumbotron justify-content-center align-items-center align-content-center" id="banner">
            <h1>THE CONSENSUS MANAGEMENT SYSTEM</h1>
            <p><strong>Do you have any conflict of interest?</strong></p>
            <p>we got the solution</p>
            <p><a class="btn btn-primary" role="button" href="dash.php">Hop in</a></p>
        </div>
    </div>
    <div class="features-clean">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Our Features</h2>
            </div>
            <div class="row justify-content-center features">
                <div class="col-sm-6 col-lg-4 item"><i class="fa fa-map-marker icon"></i>
                    <h3 class="name">Works everywhere</h3>
                    <p class="description">this web services works anytime anywhere.</p>
                </div>
                <div class="col-sm-6 col-lg-4 item"><i class="fa fa-leaf icon"></i>
                    <h3 class="name">Easy to use</h3>
                    <p class="description">No prerequiste knowledge of information technology is required, very easy to use.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-basic" style="background-color:rgb(0,0,0);">
        <footer style="background-color:#000000;">
            <div class="social"></div>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="https://www.github.com/Raj-Dhanani/polling" target="blank">Source Code<i class="fa fa-github" style="width:43px;height:11px;"></i></a></li>
                <li class="list-inline-item"><a href="#">Services</a></li>
                <li class="list-inline-item"><a href="#">About</a></li>
            </ul>
            <p class="copyright">IT<sup>3rd</sup> © 2019</p>
        </footer>
    </div>
    <script src="assetsv4/js/jquery.min.js"></script>
    <script src="assetsv4/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>