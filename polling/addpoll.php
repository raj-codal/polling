<?php

    session_start();
    if(!isset($_SESSION['user'])){
        header('location: login.php');
        die();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="./css/dash.css">
    <title>Document</title>
    
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
                    <li role="presentation"><a href="logout.php">Log out</a></li>
                    
                </ul>
            </div>
        </div>
    </nav>
        <section>
        <div class="dashbox1">
        <FORM action="submit.php" method="post">
                <?php
                include 'db.php';
                //    var_dump($_POST);
                $email = $_POST['email'];
                $password = $_POST['password'];
                $poll_id = $_POST['poll_id'];

                $query = "SELECT * FROM `user` WHERE `email` = '$email'";
                $v = mysqli_query($con, $query);
                if($email != $_SESSION['email']){
                    die('<br><br><center><h2 style="color:RED"><b>Enter your own email</b></h2></center>');
                }
                if($v->num_rows == 0){
                    die('<br><br><center><h2 style="color:RED"><b>INVALID CREDENTIALS ENTERED</b></h2></center>');
                }
                else if($v->num_rows > 0){
                    $row = mysqli_fetch_array($v);
                    if($password != $row['password']){
                        die('<br><br><center><h2 style="color:RED"><b>WRONG PASSWORD</b></h2></center>');
                        
                    }
                }

                $query = "SELECT * FROM `polls` WHERE `poll_id` = '$poll_id'";
                $res = mysqli_query($con, $query);
                if ($res->num_rows == 0) {
                    die('<br><br><center><h2 style="color:RED"><b>No such Poll created yet</b></h2></center>');
                }

                $query = "SELECT * FROM `user` WHERE `email` = '$email'";
                $res = mysqli_query($con, $query);
                if ($res->num_rows > 0) {
                    $row = mysqli_fetch_array($res);

                    $query = "SELECT * FROM `p$poll_id` WHERE `poll_giver_id` = '" . $row['id'] . "'";
                    $poll_set = mysqli_query($con, $query);
                    if ($poll_set->num_rows > 0) {
                        echo '<br><br><center><h2 style="color:green"><b>Vote Already Given</b></h2></center>';
                        die();
                    } else {

                        if ($row['password'] == $password) {
                            //<<>><<<>>>
                            $query = "SELECT * FROM `p$poll_id" . "_users` WHERE `poll_giver_id` = '" . $row['id'] . "'";
                            $res1 = mysqli_query($con, $query);
                            if ($res1->num_rows > 0) {
                                $query = "SELECT * FROM `polls` WHERE `poll_id` = '" . $poll_id . "'";
                                $res2 = mysqli_query($con, $query);
                                $row2 = mysqli_fetch_array($res2);
                                
                                // $query = "SELECT SYSDATE() AS `end`";
                                // $res3 = mysqli_query($con, $query);
                                // $row3 = mysqli_fetch_array($res3);
                                
                                //time validation
                                
                                // $db_time = new DateTime($row2['end']);
                                $curr_time = new DateTime("now");
                                $tz=new DateTimeZone('Asia/Kolkata');
                                $curr_time->setTimezone($tz);
                                $db_time =new DateTime($row2['end'],$tz);
                                // var_dump($db_time);
                                // var_dump($curr_time);
                                if ($db_time <= $curr_time){
                                    die('TIME OVER FOR POLL SUBMISSION');
                                }
                                //
                                // echo $row['name'] . ' SELECT FROM THE FOLLOWING OPTIONS:';
                                unset($_SESSION['poll_id']);
                                unset($_SESSION['id']);
                                $_SESSION['poll_id'] = $poll_id;
                                $_SESSION['id'] = $row['id'];
                                $question = $row2['poll_q'];
                                $string = $row2['poll_options'];
                                $options = explode('/over/', $string);
                                echo "QUESTION:".$question."<br>";
                                $i = 0;
                                foreach ($options as $x) {
                                    echo '<br>' . '<input class="" type="radio" name = "opinion" value=' . $i . '> ' . $x;
                                    $i++;
                                }
                                $_SESSION['validity'] = "yes";
                                echo '<br><br><INPUT style="border-radius:20px" class = "btn btn-success" type="submit" value="Submit"/>';
                            } else {
                                echo ' you are not enrolled in the poll...';
                            }
                        } else {
                            echo 'invalid password';
                        }
                    }
                } else {
                    echo 'Invalid Email';
                }
                ?>
            </FORM>
            </div>
            </section>

<script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>