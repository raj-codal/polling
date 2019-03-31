<?php

    session_start();
    if(!isset($_SESSION['user'])){
        header('location: login.html');
        die();
    }

?>

<?php

include 'db.php';
//$poll_id = $_POST['poll_id'];
//$id = $_SESSION['user_id'];
$poll_id = 8;
$id = 1;

$query = "SELECT * FROM `polls` WHERE `poll_id` = '" . $poll_id . "'";
$res1 = mysqli_query($con, $query);
$row1 = mysqli_fetch_array($res1);
if (isset($row1['poll_creator_id'])) {
    calculate(8,$con);
} else {
    $query = "SELECT * FROM `p" . $poll_id . "_user` WHERE `poll_id` = '" . $poll_id . "'";
    $res1 = mysqli_query($con, $query);
    $row1 = mysqli_fetch_array($res1);
    if (isset($row1['poll_creator_id'])) {
        calculate(8,$con);
    } else {
        die('YOU ARE NOT A ENROLLED IN THE POLL');
    }
}

function calculate($poll_id,$con) {

    $query = "SELECT * FROM `polls` WHERE `poll_id` = '" . $poll_id . "'";
    $res2 = mysqli_query($con, $query);
    $row2 = mysqli_fetch_array($res2);

    $query = "SELECT SYSDATE() AS `end`";
    $res3 = mysqli_query($con, $query);
    $row3 = mysqli_fetch_array($res3);

//time validation

    $db_time = $row2['end'];
    $curr_time = $row3['end'];
    var_dump($db_time);
    if ($db_time < $curr_time) {

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
        echo 'Winners:';
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