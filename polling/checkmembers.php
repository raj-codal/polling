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
    <script src="./js/Chart.min.js"></script>
    <script src="./js/utils.js"></script>
    <style>
	canvas {
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
	</style>
    
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
                    <li role="presentation"><a href="addnewmembers.php">Add members</a></li>
                    <li role="presentation"><a href="yourpolls.php">View Your Polls</a></li>
                    <li role="presentation"><a href="logout.php">Log out</a></li>
                </ul>
            </div>
        </div>
    </nav>
        <section>



        <?php

include 'db.php';
$q = "SELECT * FROM polls WHERE poll_id =".$_GET['pid'];
$res = mysqli_query($con, $q);
$row = mysqli_fetch_array($res);
if($_SESSION['user_id'] == $row['poll_creator_id']){
    $q = "SELECT * FROM p".$_GET['pid']."_users";
    $res1 = mysqli_query($con, $q);
    if($res1 -> num_rows > 0){
                    $n = $res1 -> num_rows;
                    echo '
                    <div class = "dashbox1" style="height:'.(($n * 18) +150).'px">
                    
                    ';
                    for($i = 0 ; $i < $n ; $i++){
                        $row1 = mysqli_fetch_array($res1);
                        $r = mysqli_query($con,"SELECT email FROM user WHERE id =".$row1['poll_giver_id']);
                        $x = mysqli_fetch_array($r);
                        echo "<b>".($i+1).". ".$x['email']."</b><br>";
                    }
                    
                }
                else{
                        echo '<div class = "dashbox1">';
                        echo '<cenetr><h2>NO MEMBERS YET !</h2></center>';
                }
                
            }

        ?>

</div>
    
    </section>



    <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    </body>
    </html>