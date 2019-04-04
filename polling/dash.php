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
</head>
<body>
    <div class="dashbox">
        <hr>
       <a href="home.html">Home </a><hr>
       <a href="dash.php">Dashboard </a><hr>
       <a href="createpoll.php">Create Polls </a><hr>
       <a href="logout.php">Log out </a><hr>
       <a href="">About Us </a><hr>

    </div>
    <div class="dashbox1">
        <table>
            <tr>
                <td>
                    POLL ID &nbsp&nbsp
                </td>
                <td>
                    POLL QUESTION
                </td>
            </tr>
                <?php

                    include 'db.php';
                    $query = "SELECT enroll FROM user WHERE id = ".$_SESSION['user_id'];
                    $rs = mysqli_query($con , $query);
                    $str = mysqli_fetch_array($rs);
                    if($rs->num_rows == 0 || $str == null || $str == ""){
                        echo "CURRENTLY YOU ARE NOT ENROLLED IN ANY POLLS";
                    }
                    else{
                        $poll_ids = explode('/',$str['enroll']);
                        foreach($poll_ids as $id){
                            echo "<tr><td>$id</td>";
                                $q = "SELECT poll_q FROM polls WHERE poll_id = $id";
                                $rs1 = mysqli_query($con , $q);
                                $tem_q = mysqli_fetch_array($rs1);
                            echo "<td>".$tem_q['poll_q']."</td></tr>";
                        }
                    }

                ?>
        </table>
    </div>

</body>
</html>