<?php
require_once "./includes/sessionMang.inc.php";
$_SESSION["beenInsignup"]="1"; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="./css/login.css">
</head>
</script>

<body>
    <div class="form-container">
        <h2>Signup</h2>
        <form id="sign-form" action="./includes/signup.inc.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="usersame" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="Email">Email:</label>
                <input type="Email" id="email" name="email" required>
            </div>
            <p align="center">
                <button type="submit">Signup</button>
            </p>
            <p align="center" class="message"> Already registered? <a href="./index.php"> Login </a> </p>

        </form>
        <?php

require_once "./includes/signupMVC/singupV.inc.php";
showErrors();
?>
    </div>

</body>



</html>
