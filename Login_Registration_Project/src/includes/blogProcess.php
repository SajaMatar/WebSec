<?php
require_once "./sessionMang.inc.php";

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_SESSION['authed'] )){
    require_once "./DBconn.inc.php";
    require_once "./blog/blogM.inc.php";

    if(empty($_POST['title']) || empty($_POST['content'])){
   $_SESSION['errors']['empty fileds']="Fill all the fields ...";
}

    else{
         insertPost($PDO,$_POST['title'],$_POST['content']);}
    
    header("Location: ./blog.php");
}
else{
    header("Location: ../index.php");
    die();
}
