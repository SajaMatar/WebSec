<?php
require_once "./includes/sessionMang.inc.php";

if(!isset($_SESSION['authed'])){ 
    header("Location: ./index.php");
    die();
}
$_SESSION['2fa']=1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two-Factor Authentication</title>
    <link rel="stylesheet" href="/css/2fa.css">
</head>
<body>

<div class="container">
    <h2>Two-Factor Authentication</h2>
    <form action="./includes/2FA.php" method="post">
        <input type="text" name="code" placeholder="Authentication Code" required><br>
        <input type="submit" value="Submit">
    </form>
    <?php
require_once "./includes/loginMVC/loginV.inc.php";
showErrors();
?>
</div>

</body>
</html
