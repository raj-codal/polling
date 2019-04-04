<?php

session_start();
    if(!isset($_SESSION['user'])){
        header('location: login.html');
        die();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>submitpoll</title>
        <link rel="stylesheet" type="text/css" href="./css/reg.css">
    </head>
    <body>
        <div class="registerbox">
        <h1>Submit poll</h1>
        <form action="addpoll.php" method="post">
            <p>Email</p>
            <input type="email" name="email"  placeholder="email"/>
            <p>Password</p>
            <input type="password" name="password" placeholder="password"/>
            <p>Number</p>
            <input type="number" name="poll_id" placeholder="Poll ID">
            <br><br>
            <input type="submit" value="Proceed">
        </form>
        </div>
    </body>
</html>
