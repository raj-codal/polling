<?php

    include 'db.php';
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $query = "INSERT INTO `user`(`name`, `email`, `password`) VALUES ('$name','$email','$password')";
    if(mysqli_query($con,$query)){
        echo 'REGISTERED';
    }
    else {
        echo 'REGISTER AGAIN';
    }

?>