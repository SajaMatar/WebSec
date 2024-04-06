<?php
require_once "./sessionMang.inc.php";

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_SESSION["Subs"]) && isset($_SESSION["beenInValToken"])) {
    unset($_SESSION["beenInValToken"]);
    require_once "./DBconn.inc.php";
    require_once "./passResetMVC/passResetM.inc.php";
    require_once "./passResetMVC/passResetC.inc.php";
    isTokenValid($PDO,$_POST['token']);
} else {
    header("Location: ../index.php");
    die();
}
