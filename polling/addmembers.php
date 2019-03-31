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
    
    $poll_id = $_POST['poll_id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $voters = $_POST['voters'];
    
    
    $query = "SELECT * FROM polls WHERE poll_id ='$poll_id' AND poll_creator_id IN (SELECT id FROM user WHERE email = '$email')";
    $res = mysqli_query($con, $query);
    var_dump($res);
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
                    $res_set = mysqli_fetch_array($res);
                    $query = "INSERT INTO p$poll_id"."_users values(".$res_set['id'].")";
                    $res = mysqli_query($con, $query);
                    
            }
            
            echo "yo ".$temp['name']."! Job's done!";
        }
        else {
            echo "invalid password!";
        }
    }
    else echo 'U DON OWN IT MAN FUCK OFF!';
?>