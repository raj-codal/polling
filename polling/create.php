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
                    <li role="presentation"><a href="dash.php">Dashboard</a></li>
                    <li class="active" role="presentation"><a href="createpoll.php">Create Poll</a></li>
                    <li role="presentation"><a href="addnewmembers.php">Add members</a></li>
                    <li role="presentation"><a href="yourpolls.php">View Your Polls</a></li>
                    <li role="presentation"><a href="logout.php">Log out</a></li>

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
    
    if( !isset($_POST['pollQ']) || !isset($_POST['pollA']) ){
        die('INVALID DATA ENTERED');
    }
    $question = $_POST['pollQ'];
    $options = $_POST['pollA'];
    $year = $_POST['year'];
    $month = $_POST['month'];
    $day = $_POST['day'];
    $hour = $_POST['hour'];
    $minutes = $_POST['minutes'];
    $date_time = "$year-$month-$day $hour:$minutes:00";
    // var_dump($date_time);
    if($date_time == "-- ::00"){
        $_SESSION['time'] = "Null";
        header('location: createpoll.php');
        die();
    }
    $tz=new DateTimeZone('Asia/Kolkata');
    $db_time =new DateTime($date_time,$tz);
    $curr_time_obj =new DateTime("NOW");
    $curr_time_obj->setTimezone($tz);
    $db_time->setTimezone($tz);

    if($curr_time_obj > $db_time){
        $_SESSION['time'] = "invalid";
        header('location: createpoll.php');
        die();
    }
    else{
        unset($_SESSION['time']);
    }

    echo 'Question: '. $question . '<hr>';
    $len = count($options);
    echo 'No. of options :'.$len.'<br>';
    $opt = "";
    if($len>0){
        $opt = $options[0];
        for($i = 1 ; $i < $len ; $i++){
            $opt = $opt."/over/".$options[$i];
        }
        $id = $_SESSION['user_id'];
        $query = "INSERT INTO `polls`(`poll_creator_id`, `poll_q`, `poll_options`, `result`, `end`) VALUES ('$id','$question','$opt','','$date_time')";
        if($res = mysqli_query($con, $query)){

        }
        else{
            echo "Something went wrong plz try again later";
        }
        $query = "SELECT poll_id from `polls` WHERE poll_creator_id='$id' ORDER BY poll_id DESC";
        $res = mysqli_query($con, $query);
        $p_id = mysqli_fetch_array($res);
        $query = "CREATE TABLE `polldb`.`p$p_id[0]` ( `poll_giver_id` INT(255) NOT NULL , `opinion` INT(255) NOT NULL , FOREIGN KEY user(poll_giver_id) REFERENCES user(id) ON UPDATE CASCADE ON DELETE CASCADE ) ENGINE = InnoDB;";
        $res = mysqli_query($con, $query);
        $query = "CREATE TABLE `polldb`.`p$p_id[0]_users` ( `poll_giver_id` INT(255) NOT NULL , FOREIGN KEY user(poll_giver_id) REFERENCES user(id) ON UPDATE CASCADE ON DELETE CASCADE ) ENGINE = InnoDB;";
        $res = mysqli_query($con, $query);
        // var_dump($res);
        echo '<hr>your poll id is :'.$p_id[0];
        echo '<hr>to add members <a style="border-radius:20px" class="btn btn-danger" href="addnewmembers.php?pid='.$p_id[0].'">Click Here</a>';
        //header('location: addnewmembers.html');
    }
    else echo 'Enter options';
?>

</section>
    
    <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    </body>
    </html>