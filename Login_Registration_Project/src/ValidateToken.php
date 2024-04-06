<?php
require_once "./includes/sessionMang.inc.php";
$_SESSION["beenInValToken"]="1"; 
if(!isset($_SESSION["Subs"])){
    header("Location: ../index.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validate Token</title>
    <link rel="stylesheet" href="./css/valToken.css">
</head>
<body>
    <div class="container">
        <h2>Validate Token</h2>
        <form action="./includes/ValidateToken.inc.php" method="post">
            <div class="form-group">
                <label for="token">Token:</label>
                <input type="text" id="token" name="token" placeholder="Enter your token" required>
            </div>
            <p align="center"> 
            <input type="submit" value="Validate">
            </p>
        </form>
        <p class="info-message">Enter the token you received to validate your account.</p>
        
<?php        
require_once "./includes/passResetMVC/passResetV.inc.php";
showErrors();
?>
</div>
</body>
</html>
