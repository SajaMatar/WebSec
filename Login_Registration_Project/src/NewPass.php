<?php
require_once "./includes/sessionMang.inc.php";

if(!$_SESSION['AuthedForNewPass']){ 
    header("Location: ./index.php");
    die();
}
$_SESSION['beenInNewPass']=1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <link rel="stylesheet" href="./css/reset.css">
</head>
<body>
    <div class="container">
        <h2>Password Reset</h2>
        <form action="./includes/newPass.inc.php" method="post">
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm New Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <p align="center">
            <button type="submit">Reset Password</button>
            </p>
        </form>
        <?php

require_once "./includes/passResetMVC/passResetV.inc.php";
showErrors();
?>
    </div>
</body>
</html>


