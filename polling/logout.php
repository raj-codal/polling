<?php

    session_start();
    unset($_SESSION['user']);
    header('locaion: login.html');
    
?>

