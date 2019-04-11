<?php
session_start();
    $flag=0;
    if(isset($_SESSION['abc']))
    {
        if($_SESSION['abc']=="abc"){
            $flag=1;
            unset($_SESSION['abc']);
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./css/reg.css">
    </head>
    <script>
    function validcheck()
    {
        if (document.f2.name.value.length==0) {
            alert("Please Enter Name");
            return false;
        }
        else if(document.f2.email.value.length==0){
            alert("Please Enter email ID");
            return false;
        }
        else if(document.f2.password.value.length==0){
            alert("Please Enter Password"); 
            return false;
        }
        else{
            return check();
        }
    }
    function check(){
        if(document.f2.password.value.length<6)
        {
            alert("Password should contain minimum 6 characters");
            return false;
        }
        var reg= /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/
        if(reg.test(document.f2.email.value)){
            return true;
        }
        else
        {
            alert("Enter valid email ID");
            return false;
        }
        
    }
    </script>
    <body>
        <div class="registerbox">
                <img src="./img/logo5.png" class="logo">
                <h1>Register Here</h1>
            <form action="registeration.php" method="post" name="f2">
                <p>Name</p>
                <input type = "text" name="name" placeholder = "enter your name">
                <p>Email</p>
                <input type = "email" name="email" placeholder = "enter your email">
                <p>Password</p>
                <input type="password" name="password" placeholder="password">
                <br><center>
                <?php
                    if($flag == 1){
                        echo '<p style="color: red">User Already Registered<p>';
                    }
                ?>
                <br>
                <input type="submit" style ="width: 40% !important;" value="Sign Up" onclick="return validcheck()"></center>
            </form>
        </div>
    </body>
</html>
