<?php

    session_start();
    if(!isset($_SESSION['user'])){
        header('location: login.html');
        die();
    }

?>
<DOCTYPE html>
    <HTML>
        <HEAD>
        </HEAD>
        <BODY>
            <FORM action="submit.php" method="post">
                <?php
                include 'db.php';
                //    var_dump($_POST);
                $email = $_POST['email'];
                $password = $_POST['password'];
                $poll_id = $_POST['poll_id'];

                $query = "SELECT * FROM `polls` WHERE `poll_id` = '$poll_id'";
                $res = mysqli_query($con, $query);
                if ($res->num_rows == 0) {
                    die('No such Poll created yet');
                }

                $query = "SELECT * FROM `user` WHERE `email` = '$email'";
                $res = mysqli_query($con, $query);
                if ($res->num_rows > 0) {
                    $row = mysqli_fetch_array($res);

                    $query = "SELECT * FROM `p$poll_id` WHERE `poll_giver_id` = '" . $row['id'] . "'";
                    $poll_set = mysqli_query($con, $query);
                    if ($poll_set->num_rows > 0) {
                        echo 'Vote Already Given';
                        unset($_SESSION['poll_id']);
                        unset($_SESSION['user_id']);
                    } else {

                        if ($row['password'] == $password) {
                            //<<>><<<>>>
                            $query = "SELECT * FROM `p$poll_id" . "_users` WHERE `poll_giver_id` = '" . $row['id'] . "'";
                            $res1 = mysqli_query($con, $query);
                            if ($res1->num_rows > 0) {
                                $query = "SELECT * FROM `polls` WHERE `poll_id` = '" . $poll_id . "'";
                                $res2 = mysqli_query($con, $query);
                                $row2 = mysqli_fetch_array($res2);
                                
                                // $query = "SELECT SYSDATE() AS `end`";
                                // $res3 = mysqli_query($con, $query);
                                // $row3 = mysqli_fetch_array($res3);
                                
                                //time validation
                                
                                $db_time = new DateTime($row2['end']);
                                $curr_time = new DateTime("now");
                                var_dump($db_time);
                                var_dump($curr_time);
                                if ($db_time <= $curr_time){
                                    die('TIME OVER FOR POLL SUBMISSION');
                                }
                                //
                                
                                echo $row['name'] . ' SELECT FROM THE FOLLOWING OPTIONS:';
                                unset($_SESSION['poll_id']);
                                unset($_SESSION['id']);
                                $_SESSION['poll_id'] = $poll_id;
                                $_SESSION['id'] = $row['id'];
                                $question = $row2['poll_q'];
                                $string = $row2['poll_options'];
                                $options = explode('/over/', $string);
                                $i = 0;
                                foreach ($options as $x) {
                                    echo '<br>' . $x . ':<input type="radio" name = "opinion" value=' . $i . '>';
                                    $i++;
                                }
                                echo '<INPUT type="submit" value="Submit"/>';
                            } else {
                                echo ' you are not enrolled in the poll...';
                            }
                        } else {
                            echo 'invalid password';
                        }
                    }
                } else {
                    echo 'Invalid Email';
                }
                ?>
            </FORM>
        </BODY>
    </HTML>