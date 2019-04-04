<?php

    session_start();
    if(!isset($_SESSION['user'])){
        header('location: login.html');
        die();
    }

?>


<?php
    // session_start();
    include 'db.php';
    $opinion = $_POST['opinion']; 
    if(isset($_SESSION['poll_id'])){
        $query = "INSERT INTO p".$_SESSION['poll_id']." VALUES (".$_SESSION['user_id'].",$opinion)";
        mysqli_query($con, $query);
        var_dump($_SESSION);
        echo 'DONE!';
    }
    else {
        die('INVALID ACCESS');
    }
    

?>
