<?php
require_once "./includes/sessionMang.inc.php";
$_SESSION['LoginNo']=0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="./css/login.css">
    <script src= 
        "https://www.google.com/recaptcha/api.js" async defer> 
    </script> 
</head>
</script>

<body>
    <div class="form-container">
        <h2>Login</h2>
        <form id="login-form" action="./includes/login.inc.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="g-recaptcha" data-sitekey="6LequagpAAAAAGAbCfHV41hQs8mZ_9wjxDJOCBJZ"></div>     
            <p align="center">
                 <button  class = "buttonC" type="submit" >Login</button>
            </p>

         <p align="center"> Not registered? <a href="./signup.php" > Create an account</a> </p>
         <p align="center"> Forgot Password? <a href="./PassReset.php" > Password Recovery </a> </p>

        </form>
       
        <?php

require_once "./includes/loginMVC/loginV.inc.php";
showErrors();
Update();
?>

    </div>
</body>

</html>



