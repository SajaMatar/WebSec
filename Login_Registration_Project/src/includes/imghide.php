<?php
require_once "./sessionMang.inc.php";
if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_SESSION['authed'] )){
unset($_SESSION['display_image']);
header("Location: ./welcome.inc.php");

}


else {
    header("Location: ../index.php");
    die();
}
