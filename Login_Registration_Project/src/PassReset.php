<?php
require_once "./includes/sessionMang.inc.php";
$_SESSION["beenInPassReset"]="1"; 
if(isset($_SESSION['csrfToken'])){
    unset($_SESSION['csrfToken']);
}
$_SESSION['csrfToken']=bin2hex(random_bytes(30))
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="./css/forgotPass.css">
</head>
<body>
    <div class="container">
        <h2>Forgot Password</h2>
        <form action="./includes/passReset.inc.php" method="post">
        
            <div class="form-group">
            <label for="email">Email:</label>
            <p align="center">
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </p>
            </div>
            
            <p align="center">   
            <input type="submit" value="Reset Password">
            </p>
        </form>
        
<?php
require_once "./includes/passResetMVC/passResetV.inc.php";
showErrors();
operationStatus();
?>
    </div>
</body>
</html>
