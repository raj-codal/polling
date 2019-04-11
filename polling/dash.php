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
                    <li role="presentation"><a href="logout.php">Log out</a></li>
                </ul>
            </div>
        </div>
    </nav>
        <section>

        <div class = "main">
            <!-- <div class="dashbox">
                <hr>
                    <a href="home.html">Home </a><hr>
                    <a href="dash.php">Dashboard </a><hr>
            <a href="createpoll.php">Create Polls </a><hr>
            <a href="logout.php">Log out </a><hr>
            <a href="">About Us </a><hr>
            
            </div> -->
            
            <div class="dashbox1">
                <table>
                    <tr>
                        <td>
                            POLL ID &nbsp&nbsp
                        </td>
                        <td>
                            POLL QUESTION
                        </td>
                        <td></td>
                    </tr>
                        <?php

        include 'db.php';
                            $query = "SELECT enroll FROM user WHERE id = ".$_SESSION['user_id'];
                            $rs = mysqli_query($con , $query);
                            $str['enroll'] = null;
                            // var_dump($rs);
                            if($rs->num_rows > 0){
                                $str = mysqli_fetch_array($rs);    
                            }
                            if($rs->num_rows == 0 || $str['enroll'] == null || $str['enroll'] == ""){
                                echo "<tr><td colspan=\"2\">CURRENTLY YOU ARE NOT ENROLLED IN ANY POLL</td></tr>";
                            }
                            else{
                                // var_dump($str);
                                $poll_ids = explode('/',$str['enroll']);
                                foreach($poll_ids as $id){
                                    echo "<tr><td>$id</td>";
                                    $q = "SELECT poll_q FROM polls WHERE poll_id = $id";
                                        $rs1 = mysqli_query($con , $q);
                                        $tem_q = mysqli_fetch_array($rs1);
                                    echo "<td>".$tem_q['poll_q']."</td>";
                                    echo '<td><a class="btn btn-primary" style="border-radius:25px;margin:5px" href="submitpoll.php?pid='.$id.'">give opinion</a></td>';
                                    echo '<td><a class="btn btn-primary" style="border-radius:25px;margin:5px" href="checkresult.php?pid='.$id.'">check result</a></td></tr>';
                                }
                            }

                            ?>
                </table>
            </div>
    </div>
    
</section>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>