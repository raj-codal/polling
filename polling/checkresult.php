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
                    <li class="active" role="presentation"><a href="#">Dashboard</a></li>
                    <li role="presentation"><a href="createpoll.php">Create Poll</a></li>
                    <li role="presentation"><a href="addnewmembers.php">Add members</a></li>
                    <li role="presentation"><a href="yourpolls.php">View Your Polls</a></li>
                </ul>
            </div>
        </div>
    </nav>
        <section>

        <div class = "dashbox1">


<?php

include 'db.php';
//$poll_id = $_POST['poll_id'];
//$id = $_SESSION['user_id'];
$poll_id = $_GET['pid'];
$id = $_SESSION['user_id'];

$query = "SELECT * FROM `polls` WHERE `poll_id` = '" . $poll_id . "'";
$res1 = mysqli_query($con, $query);
$row1 = mysqli_fetch_array($res1);
if(!isset($row1['poll_id'])){
    die("NO SUCH POLL EXIST!");
}

if (isset($row1['poll_creator_id'])) {
    calculate($poll_id,$con);
} else {
    $query = "SELECT * FROM `p" . $poll_id . "_user` WHERE `poll_giver_id` = '" . $id . "'";
    if($res1 = mysqli_query($con, $query)){
        $row1 = mysqli_fetch_array($res1);
    }
    if (isset($row1['poll_giver_id'])) {
        calculate($poll_id,$con);
    } else {
        die('YOU ARE NOT A ENROLLED IN THE POLL');
    }
}

function calculate($poll_id,$con) {

    // var_dump($poll_id);
    $query = "SELECT * FROM `polls` WHERE `poll_id` = '" . $poll_id . "'";
    $res2 = mysqli_query($con, $query);
    $row2 = mysqli_fetch_array($res2);

    // $query = "SELECT SYSDATE() AS `end`";
    // $res3 = mysqli_query($con, $query);
    // $row3 = mysqli_fetch_array($res3);

//time validation

    $tz=new DateTimeZone('Asia/Kolkata');
    $db_time =new DateTime($row2['end'],$tz);
    $curr_time_obj =new DateTime("NOW");
    $curr_time_obj->setTimezone($tz);
    $db_time->setTimezone($tz);
    // var_dump($db_time);
    // var_dump($curr_time_obj);
    // $curr_time = $curr_time_obj->date;
    // echo '1'. ($db_time <= $curr_time_obj ). '<br>';
    // echo '2'. ($db_time >= $curr_time_obj ). '<br>';

    if ($db_time < $curr_time_obj) {

        $query = "SELECT `poll_options` FROM `polls` WHERE poll_id='$poll_id'";
        $option_result_set = mysqli_query($con, $query);
        $option_row = mysqli_fetch_array($option_result_set);
        $option_string = $option_row['poll_options'];
        $options = explode('/over/', $option_string);
        
        $len = count($options);
        $x = array();
        for($i=0;$i<$len;$i++){
            $query = "SELECT * FROM `p".$poll_id."` WHERE `opinion` = '$i'";
            $res4 = mysqli_query($con, $query);
            array_push($x, $res4->num_rows);
        }
        $max_index = array_keys($x, max($x));
        echo 'Winner list:<BR>';
        $result = '';
        foreach($max_index as $index){
            echo $options[$index];
            $result = $result." ".$options[$index];
        }
        $r=trim($result);
            $query = "UPDATE `polls` SET `result` = '$r' WHERE `polls`.`poll_id` = $poll_id; ";
            $res4 = mysqli_query($con, $query);
    } else
        die('POLL NOT OVER YET!!');
}
?>

</div>
    
    </section>
    
    <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    </body>
    </html>