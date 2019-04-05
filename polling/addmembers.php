<?php

    session_start();
    if(!isset($_SESSION['user'])){
        header('location: login.html');
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
                    <li role="presentation"><a href="#">Dashboard</a></li>
                    <li role="presentation"><a href="createpoll.php">Create Poll</a></li>
                    <li class="active" role="presentation"><a href="addnewmembers.php">Add members</a></li>
                    <li role="presentation"><a href="yourpolls.php">View Your Polls</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <section>

        <div class = "main">
            <!-- <div class="dashbox">
                <hr>
                    <a href="home.html">Home </a><hr>
                    <a href="dash.php">Dashboard </a><hr>
            <a href="createpoll.php">Create Polls </a><hr>
            <a href="logout.php">Log out </a><hr>
            <a href="">About Us </a><hr>
            
            </div> -->
            
            <div class="dashbox1">

            <?php

                include 'db.php';
            //    var_dump($_POST);
                
                $poll_id = $_POST['poll_id'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $voters = $_POST['voters'];
                
                
                $query = "SELECT * FROM polls WHERE poll_id ='$poll_id' AND poll_creator_id IN (SELECT id FROM user WHERE email = '$email')";
                $res = mysqli_query($con, $query);
                // var_dump($res);
                if($res->num_rows>0){
                    $temp = mysqli_fetch_array($res);
                    $user_id = $temp['poll_creator_id'];
                    $query = "SELECT name FROM user WHERE id = $user_id AND password = '$password'";
                    $res = mysqli_query($con, $query);
                    if($res->num_rows>0){
                        $temp = mysqli_fetch_array($res);
                        
                        foreach ($voters as $value) {
                            
                                $query = "SELECT id FROM user WHERE email='$value'";
                                $res = mysqli_query($con, $query);

                                if($res->num_rows == 0 ){
                                    echo($value."is not a registered user");
                                }
                                else {
                                    $res_set = mysqli_fetch_array($res);

                                    $que = "SELECT poll_giver_id FROM p$poll_id"."_users WHERE poll_giver_id = ".$res_set['id'];
                                    $res0 = mysqli_query($con, $que);
                                    if($res0->num_rows > 0){
                                        echo "$value is already registered";
                                    }
                                    else{

                                        $query = "INSERT INTO p$poll_id"."_users values(".$res_set['id'].")";
                                        $res = mysqli_query($con, $query);
                                        
                                        // $query = "INSERT INTO p$poll_id"."_users values(".$res_set['id'].")";
                                        $select_query = "SELECT enroll FROM user WHERE email='$value'";
                                        $rx= mysqli_query($con, $select_query);
                                        $r = mysqli_fetch_array($rx);
                                        $tem = $r['enroll'];
                                        if($tem == "" || $tem == null){
                                            $tem = $poll_id;
                                            $select_query = "UPDATE user SET enroll = '$tem' WHERE email='$value'";
                                            $rx= mysqli_query($con, $select_query);
                                        }
                                        else{
                                            $tem = $tem."/$poll_id";
                                            $select_query = "UPDATE user SET enroll = '$tem' WHERE email='$value'";
                                            $rx= mysqli_query($con, $select_query);
                                        }
                                    }
                                }
                                
                        }
                        
                        echo "<br><br>DONE!!";
                    }
                    else {
                        echo "invalid password!";
                    }
                }
                else echo "U ARE NOT THIS OWNER OF THE POLL YOUR CAN'T ADD MEMBERS";
            ?>

</div>
    
    </section>
    
    <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    </body>
    </html>