<?php

    include 'db.php';
    if( !isset($_POST['pollQ']) || !isset($_POST['pollA']) ){
        die('INVALID DATA ENTERED');
    }
    $question = $_POST['pollQ'];
    $options = $_POST['pollA'];
    echo $question . '<br>';
    $len = count($options);
    echo $len;
    $opt = "";
    if($len>0){
        $opt = $options[0];
        for($i = 1 ; $i < $len ; $i++){
            $opt = $opt."/over/".$options[$i];
        }
        $id = 1;
        $query = "INSERT INTO `polls`(`poll_creator_id`, `poll_q`, `poll_options`, `result`) VALUES ('$id','$question','$opt','')";
        $res = mysqli_query($con, $query);
        $query = "SELECT poll_id from `polls` WHERE poll_creator_id='$id' ORDER BY poll_id DESC";
        $res = mysqli_query($con, $query);
        $p_id = mysqli_fetch_array($res);
        $query = "CREATE TABLE `polldb`.`p$p_id[0]` ( `poll_giver_id` INT(255) NOT NULL , `opinion` INT(255) NOT NULL , FOREIGN KEY user(poll_giver_id) REFERENCES user(id) ON UPDATE CASCADE ON DELETE CASCADE ) ENGINE = InnoDB;";
        $res = mysqli_query($con, $query);
        $query = "CREATE TABLE `polldb`.`p$p_id[0]_users` ( `poll_giver_id` INT(255) NOT NULL , FOREIGN KEY user(poll_giver_id) REFERENCES user(id) ON UPDATE CASCADE ON DELETE CASCADE ) ENGINE = InnoDB;";
        $res = mysqli_query($con, $query);
        var_dump($res);
        header('location: addmember.html');
    }
    else echo 'Enter options';
?>
