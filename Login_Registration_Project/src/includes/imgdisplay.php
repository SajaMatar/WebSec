<?php
require_once "./sessionMang.inc.php";
if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_SESSION['authed'] )){
    require_once "./DBconn.inc.php";
    require_once "./imageuploadMVC/imageuploadM.inc.php";
    if(getImage($PDO)!=NULL){
$_SESSION['display_image']=1;
}
else{
    $_SESSION['errors']['notFound_img']="this user doesnt have an image. ";
}
header("Location: ./welcome.inc.php");
die();
}


else {
    header("Location: ../index.php");
    die();
}
