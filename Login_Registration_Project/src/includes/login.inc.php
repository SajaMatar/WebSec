<?php
session_start();
require_once "./sessionMang.inc.php"; 

if ($_SERVER['REQUEST_METHOD'] === "POST"&& isset($_SESSION['LoginNo'])) {
    $recaptcha = $_POST['g-recaptcha-response'];
    $secret_key='6LequagpAAAAAD9jbtINyMkDJDHGh2w9IA7XC_00';
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret='. $secret_key . '&response=' . $recaptcha; 
    $response = file_get_contents($url); 
    $response = json_decode($response); 
    if ($response->success != true){
       $_SESSION['errors']['invaali reCaptcha'] = "Check the reCaptcha";
        header("Location: ../index.php");
        die();
    } 

    $_SESSION['LoginNo']+=1;
    HandleID();
    require_once "./DBconn.inc.php";
    require_once "./loginMVC/loginM.inc.php";
    require_once "./loginMVC/loginC.inc.php";

    $username = $_POST['username'];
    $passwd = $_POST['password'];

    // make input checks ... 
    $ERRORS = [];
    if (IsAnyEmpty($username, $passwd)) {
        $ERRORS["empty_field"] = "Fill in all Fields!";
    }
    // send back any errors
    if ($ERRORS) {
        $_SESSION["errors"] = $ERRORS;
        header("Location: ../index.php");
        die();
    }

    if (checkCreds($PDO, $username, $passwd)) {
        $_SESSION['authed'] = "1";
        $_SESSION['usr']=$username;
        header("Location: ./welcome.inc.php");
        die();
    } 
    else {
        $ERRORS["login"] = "Username or password is invaild.";
        $_SESSION["errors"] = $ERRORS;
        header("Location: ../index.php");
        die();
    }
    
}
else {
    header("Location: ../index.php");
    die();
}


