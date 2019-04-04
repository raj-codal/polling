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
            
            echo "<br>NO ERROR!";
        }
        else {
            echo "invalid password!";
        }
    }
    else echo "U ARE NOT THE OWNER OF THE POLL YOUR CAN'T ADD MEMBERS";
?>