<?php

    session_start();
    if(!isset($_SESSION['user'])){
        header('location: login.html');
        die();
    }

?>


<?php

    include 'db.php';
//    var_dump($_POST);
    
    if( !isset($_POST['pollQ']) || !isset($_POST['pollA']) || !isset($_POST['date_time']) ){
        die('INVALID DATA ENTERED');
    }
    $question = $_POST['pollQ'];
    $options = $_POST['pollA'];
    $date_time = $_POST['date_time'];
    echo $question . '<br>';
    $len = count($options);
    echo $len;
    $opt = "";
    if($len>0){
        $opt = $options[0];
        for($i = 1 ; $i < $len ; $i++){
            $opt = $opt."/over/".$options[$i];
        }
        $id = $_SESSION['user_id'];
        $query = "INSERT INTO `polls`(`poll_creator_id`, `poll_q`, `poll_options`, `result`, `end`) VALUES ('$id','$question','$opt','','$date_time')";
        $res = mysqli_query($con, $query);
        $query = "SELECT poll_id from `polls` WHERE poll_creator_id='$id' ORDER BY poll_id DESC";
        $res = mysqli_query($con, $query);
        $p_id = mysqli_fetch_array($res);
        $query = "CREATE TABLE `polldb`.`p$p_id[0]` ( `poll_giver_id` INT(255) NOT NULL , `opinion` INT(255) NOT NULL , FOREIGN KEY user(poll_giver_id) REFERENCES user(id) ON UPDATE CASCADE ON DELETE CASCADE ) ENGINE = InnoDB;";
        $res = mysqli_query($con, $query);
        $query = "CREATE TABLE `polldb`.`p$p_id[0]_users` ( `poll_giver_id` INT(255) NOT NULL , FOREIGN KEY user(poll_giver_id) REFERENCES user(id) ON UPDATE CASCADE ON DELETE CASCADE ) ENGINE = InnoDB;";
        $res = mysqli_query($con, $query);
        var_dump($res);
        echo 'your poll id is :'.$p_id[0];
        echo '<br>to add members <a href="addnewmembers.html">click_here</a>';
        //header('location: addnewmembers.html');
    }
    else echo 'Enter options';
?>
