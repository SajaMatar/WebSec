<?php
require_once "./sessionMang.inc.php";

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_SESSION['authed'] ) && isset($_SESSION['2fa'])){
    require_once "./DBconn.inc.php";
    require_once "./signupMVC/singupM.inc.php";
    require_once("./vendor/autoload.php");

    $sec_key=get2FAkey($PDO,$_SESSION['usr']);
    $googleAuth = new PragmaRX\Google2FA\Google2FA();

    if($googleAuth->verify($_POST['code'],$sec_key)){
        header("Location: ./welcome.inc.php");
        die(); 
    } else {
        $_SESSION['errors']['invalid_2fa']="incorrect code";
        header("Location: ../2faCode.php");

    }

}

else {
    header("Location: ../index.php");
    die();
}
