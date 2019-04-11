<?php
session_start();
    include 'db.php';
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $query = "SELECT * FROM user WHERE email = '$email'";
    if($res = mysqli_query($con,$query)){
        if($res->num_rows > 0){
            echo 'user already registered';
            $_SESSION['abc'] = "abc";
            header('location: register.php');
            die();

        }

    }

    $query = "INSERT INTO `user`(`name`, `email`, `password`) VALUES ('$name','$email','$password')";
    if(mysqli_query($con,$query)){
        echo 'REGISTERED';
        $_SESSION['reg'] = 'done';
        header('location: login.php');
        die();
    }
    else {
        echo 'REGISTER AGAIN';
        $_SESSION['reg'] = 'not done';
        header('location: register.php');
        die();
    }
    
?>