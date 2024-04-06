<?php
require_once "./sessionMang.inc.php";

if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_SESSION['authed'] )){
    require_once "./DBconn.inc.php";
    HandleID();
    unset($_SESSION['authed']);
    require_once "homeMVC/homeM.inc.php";
    require_once "homeMVC/homeV.inc.php";
    homePage($PDO,$_SESSION['usr']);
   
}

else {
    header("Location: ../index.php");
    die();
}
