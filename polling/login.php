<?php
    session_start();
    $err = 0;
    if(isset($_SESSION['res'])){
        if($_SESSION['res'] == 'fail'){
            $err = 909;
        }
    }
?>


<!DOCTYPE html>
<html>
<head>
<title>Login Form</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<script>
    function validclick()
    {
        if(document.f1.email.value.length==0){
            alert("Please Enter email ID");
            return false;
        }
        else if(document.f1.password.value.length==0){
            alert("Please Enter Password"); 
            return false;
        }
        else{
            return check();
        }
    }
    function check(){
        if(document.f1.password.value.length<6)
        {
            alert("Please Enter Valid Password");
            return false;
        }
        var reg= /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/
        if(reg.test(document.f1.email.value)){
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
    <div class="loginbox">
        <img src="./img/logox.png" class="logo">
        <h1>Login</h1>
        <?php
            if(isset($_SESSION['reg'])){
                if($_SESSION['reg']=='done'){
                    echo '<center><p style="color:green">Registered Sucessfully!!</p></center>';
                    unset($_SESSION['reg']);
                }
                else if($_SESSION['reg']=='not done'){
                    echo '<center><p style="color:Red">someting went wrong try again later!!</p></center>';
                    unset($_SESSION['reg']);
                }
                
            }
        ?>
        <form action = "login_validate.php" method="POST" name="f1">
            <p>Email</p>
            <input type="text" name="email" placeholder="Enter Email">
            <p>Password</p>
            <input type="password" name="password" placeholder="Enter Password">
            <br><br>
            <?php
                if($err == 909){
                    echo '<p style="color: red">Invalid Credentials</p>';
                }
            ?>
            <input type="submit" value="Login" onclick="return validclick()">
            <a href="register.php">Register Here</a>
        </form>  
    </div>
</body>
</html>